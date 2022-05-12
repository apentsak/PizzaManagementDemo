<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'user'          => [
                'id'        => $this->id,
                'firstName' => $this->user->firstName,
                'lastName'  => $this->user->lastName,
            ],
            'city'          => $this->city,
            'building'      => $this->building,
            'street'        => $this->street,
            'apartment'     => $this->apartment,
            'status'        => $this->status,
            'paidInAdvance' => $this->paidInAdvance,
            'totalPrice'    => $this->totalPrice,
            'date'          => $this->date->format('Y-m-d H:i:s'),
        ];
    }
}
