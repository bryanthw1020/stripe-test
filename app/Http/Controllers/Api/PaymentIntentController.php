<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Dto\PaymentIntentCreateData;
use App\Http\Requests\Api\PaymentIntentCreateRequest;
use App\Support\Facades\Executor;
use App\Support\Facades\Responder;

class PaymentIntentController extends Controller
{
    public function store(PaymentIntentCreateRequest $request)
    {
        $createData = PaymentIntentCreateData::fromRequest($request);
        $paymentIntent = Executor::run('Api', 'PaymentIntentCreateAction', $createData);

        return Responder::success($paymentIntent, __('message.success_create'));
    }
}
