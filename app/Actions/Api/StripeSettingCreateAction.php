<?php

namespace App\Actions\Api;

use App\Http\Resources\StripeSetting as ResourcesStripeSetting;
use App\Models\StripeSetting;
use Illuminate\Support\Facades\Auth;

class StripeSettingCreateAction
{
    public function execute(string $publicKey, string $secretKey)
    {
        $stripeSetting = StripeSetting::create([
            'user_id' => Auth::id(),
            'token' => md5($publicKey),
            'public_key' => $publicKey,
            'secret_key' => $secretKey
        ]);

        return new ResourcesStripeSetting($stripeSetting);
    }
}
