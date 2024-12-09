<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    public static function getStatesLabelValue(): array
    {
        return cache()->remember('states', now()->addDays(15), function () {
            return self::query()
                ->select('uf', 'state')
                ->orderBy('state')
                ->distinct()
                ->get()
                ->map(fn ($state) => [
                    'label' => $state->state,
                    'value' => $state->uf,
                ])
                ->toArray();
        });
    }

    public static function getCitiesLabelValue(): array
    {
        return cache()->remember('cities', now()->addDays(15), function () {
            return self::query()
                ->select('id', 'name')
                ->orderBy('name')
                ->distinct()
                ->get()
                ->map(fn ($city) => [
                    'label' => $city->name,
                    'value' => $city->id,
                ])
                ->toArray();
        });
    }

    public function scopeHaversine(Builder $query, float $latitude, float $longitude, ?int $radius = null): Builder
    {
        $query
            ->addSelect([
                'distance' => function ($query) use ($latitude, $longitude): void {
                    $query->selectRaw('REPLACE(FORMAT((6371 * acos(cos(radians(?))
                    * cos(radians(latitude))
                    * cos(radians(longitude)
                    - radians(?))
                    + sin(radians(?))
                    * sin(radians(latitude)))), 2), ",", "")', [$latitude, $longitude, $latitude]);
                },
            ]);

        if (! $radius) {
            return $query;
        }

        return $query->having('distance', '<=', $radius);
    }
}
