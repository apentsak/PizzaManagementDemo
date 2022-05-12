<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property integer id
 * @property string city
 * @property string street
 * @property string building
 * @property string apartment
 * @property string status
 * @property string paidInAdvance
 * @property float totalPrice
 * @property Carbon date
 * @property User user
 */
class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userId',
        'city',
        'street',
        'building',
        'apartment',
        'status',
        'paidInAdvance',
        'totalPrice',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
