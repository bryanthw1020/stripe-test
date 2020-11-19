<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentIntent extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'checkout_url' => config('app.payment_url') . "/{$this->ref_no}?client_secret={$this->payment_response['client_secret']}",
            'return_url' => $this->return_url,
        ];
    }
}
