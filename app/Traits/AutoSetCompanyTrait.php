<?php

declare(strict_types=1);

namespace App\Traits;

trait AutoSetCompanyTrait
{
    public static function bootAutoSetCompanyTrait(): void
    {
        if (!auth()->check()) {
            return;
        }

        static::creating(function ($model) {
            $model->company_id = auth()->user()->current_company_id;
        });

        static::addGlobalScope(function ($builder) {
            $prefix = self::getModel()->getTable();
            $builder->where($prefix . '.company_id', auth()->user()->current_company_id);
        });
    }
}
