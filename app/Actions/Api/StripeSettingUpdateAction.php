<?php

namespace App\Actions\Api;

use App\Http\Resources\StripeSetting as ResourcesStripeSetting;
use App\Models\StripeSetting;
use Illuminate\Support\Facades\Gate;

class StripeSettingUpdateAction
{
    public function execute($id, string $publicKey, string $secretKey)
    {
        $stripeSetting = StripeSetting::findOrFail($id);

        Gate::authorize('update', $stripeSetting);

        $stripeSetting->update(['token' => md5($publicKey), 'public_key' => $publicKey, 'secret_key' => $secretKey]);

        return new ResourcesStripeSetting($stripeSetting);
    }
}
