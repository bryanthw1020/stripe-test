<?php

namespace App\Actions\Api;

use App\Http\Dto\PaymentIntentCreateData;
use App\Http\Resources\PaymentIntent as ResourcesPaymentIntent;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PaymentIntentCreateAction
{
    public function execute(PaymentIntentCreateData $createData)
    {
        $refNo = Str::uuid();
        $stripeSetting = $this->getStripeSetting($createData->token);
        $paymentIntent = $this->generatePaymentIntent($stripeSetting, $refNo, $createData->amount, $createData->currency, $createData->meta);
        $transaction = $this->saveTransaction($createData, $refNo, $stripeSetting->id, $paymentIntent);

        return new ResourcesPaymentIntent($transaction);
    }

    private function getStripeSetting(string $token): StripeSetting
    {
        $stripeSetting = StripeSetting::where('token', $token)->first();

        if (!$stripeSetting) {
            throw new BadRequestException(__('responder.invalid_stripe_token'));
        }

        return $stripeSetting;
    }

    private function generatePaymentIntent(StripeSetting $stripeSetting, string $refNo, float $amount, string $currency, array $meta = [])
    {
        try {
            Stripe::setApiKey($stripeSetting->secret_key);

            $paymentIntent = PaymentIntent::create([
                'amount' => $this->convertToAmountInCent($amount),
                'currency' => $currency,
                'metadata' => $meta
            ]);

            return $paymentIntent->toArray();
        } catch (\Exception $ex) {
            throw new BadRequestException($ex->getMessage());
        }
    }

    private function convertToAmountInCent(float $amount)
    {
        return $amount * 100;
    }

    private function saveTransaction(PaymentIntentCreateData $createData, string $refNo, int $stripeSettingId, array $paymentIntent)
    {
        return Transaction::create([
            'user_id' => Auth::id(),
            'stripe_setting_id' => $stripeSettingId,
            'ref_no' => $refNo,
            'amount' => $createData->amount,
            'currency' => $createData->currency,
            'return_url' => $createData->return_url,
            'callback_url' => $createData->callback_url,
            'meta' => $createData->meta,
            'payment_response' => $paymentIntent,
            'ip_address' => $createData->ip_address,
            'user_agent' => $createData->user_agent,
        ]);
    }
}
