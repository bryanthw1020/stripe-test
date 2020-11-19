<?php

namespace App\Actions\Api;

use App\Http\Resources\StripeSetting as ResourcesStripeSetting;
use App\Models\StripeSetting;
use Illuminate\Support\Facades\Gate;

class StripeSettingGetOneAction
{
    public function execute($id)
    {
        $stripeSetting = StripeSetting::findOrFail($id);

        Gate::authorize('view', $stripeSetting);

        return new ResourcesStripeSetting($stripeSetting);
    }
}
