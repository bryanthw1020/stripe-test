<?php

namespace App\Http\Dto;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class PaymentIntentCreateData extends DataTransferObject
{
    public $token;

    public $amount;

    public $currency;

    public $return_url;

    public $callback_url;

    public $meta;

    public $ip_address;

    public $user_agent;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'token' => $request->token,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'return_url' => $request->return_url,
            'callback_url' => $request->callback_url,
            'meta' => json_decode($request->meta, true),
            'ip_address' => $request->getClientIp(),
            'user_agent' => $request->userAgent()
        ]);
    }
}
