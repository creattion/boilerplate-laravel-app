<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'city_id',
        'user_id',
        'name',
        'document',
        'email',
        'street',
        'number',
        'neighborhood',
        'complement',
        'zipcode',
        'phone',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }

    public function professionals(): HasMany
    {
        return $this->hasMany(Professional::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps()
            ->as('membership');
    }

    public function hasUser(User $user): bool
    {
        return $this->users->contains($user);
    }

    public function hasUserWithEmail(string $email)
    {
        return $this->users()->contains(function (User $user) use ($email) {
            return $user->email === $email;
        });
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(CompanyInvitation::class);
    }

    public function removeUser(User $user): void
    {
        if ($user->current_company_id === $this->id) {
            $user->forceFill([
                'current_company_id' => null,
            ])->save();
        }

        $this->users()->detach($user);
    }

    public function purge(): void
    {
        $this->owner()->where('current_company_id', $this->id)
            ->update(['current_company_id' => null]);

        $this->users()->where('current_company_id', $this->id)
            ->update(['current_company_id' => null]);

        $this->users()->detach();

        $this->delete();
    }
}
