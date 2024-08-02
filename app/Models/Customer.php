<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;


/**
 * @mixin IdeHelperCustomer
 */
class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'is_active'];

    /**
     * Define a one-to-many relationship with the Order model.
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Concatenates the first name and last name to form the full name.
     *
     * @return string The full name
     */
    public function fullName() : string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
