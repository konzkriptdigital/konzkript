<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Paddle\Billable;

class Company extends Model
{
    use HasFactory, Billable, HasUuids;

    protected $guarded = ['id'];

    protected $hidden = [
        'access_token',
        'refresh_token',
        'token_type',
        'expires_in',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    /**
     * Get all of the users for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the accounts for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
