<?php

namespace App\Actions\Api;

use App\Http\Resources\StripeSettingCollection;
use App\Models\StripeSetting;
use Illuminate\Support\Facades\Auth;

class StripeSettingGetAllAction
{
    public function execute(int $pageSize)
    {
        $stripeSettings = StripeSetting::where('user_id', Auth::id())->latest()->paginate($pageSize);

        return new StripeSettingCollection($stripeSettings);
    }
}
