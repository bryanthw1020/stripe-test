<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StripeSettingCreateRequest;
use App\Http\Requests\Api\StripeSettingUpdateRequest;
use App\Support\Facades\Executor;
use App\Support\Facades\Responder;

class StripeSettingController extends Controller
{
    public function index()
    {
        $stripeSettings = Executor::run('Api', 'StripeSettingGetAllAction', $this->pageSize);

        return Responder::success($stripeSettings, __('message.success_retrieve'));
    }

    public function store(StripeSettingCreateRequest $request)
    {
        $stripeSetting = Executor::run('Api', 'StripeSettingCreateAction', $request->public_key, $request->secret_key);

        return Responder::success($stripeSetting, __('message.success_create'));
    }

    public function show($id)
    {
        $stripeSetting = Executor::run('Api', 'StripeSettingGetOneAction', $id);

        return Responder::success($stripeSetting, __('message.success_retrieve'));
    }

    public function update(StripeSettingUpdateRequest $request, $id)
    {
        $stripeSetting = Executor::run('Api', 'StripeSettingUpdateAction', $id, $request->public_key, $request->secret_key);

        return Responder::success($stripeSetting, __('message.success_update'));
    }

    public function destroy($id)
    {
        Executor::run('Api', 'StripeSettingDeleteAction', $id);

        return Responder::success([], __('message.success_delete'));
    }
}
