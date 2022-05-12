<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string firstName
 * @property string lastName
 */
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
    ];
}
