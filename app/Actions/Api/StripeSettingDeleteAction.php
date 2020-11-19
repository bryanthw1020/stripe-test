<?php

namespace App\Actions\Api;

use App\Models\StripeSetting;
use Illuminate\Support\Facades\Gate;

class StripeSettingDeleteAction
{
    public function execute($id)
    {
        $stripeSetting = StripeSetting::findOrFail($id);

        Gate::authorize('delete', $stripeSetting);

        $stripeSetting->delete();
    }
}
