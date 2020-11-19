<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use CastsEnums;

    protected $casts = [
        'status' => 'int',
        'meta' => 'json',
        'payment_response' => 'json',
        'callback_response' => 'json'
    ];

    protected $enumCasts = [
        'status' => TransactionStatus::class
    ];

    protected $fillable = ['user_id', 'stripe_setting_id', 'ref_no', 'amount', 'currency', 'return_url', 'callback_url', 'meta', 'payment_response', 'callback_response', 'ip_address', 'user_agent', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function stripeSetting(): BelongsTo
    {
        return $this->belongsTo(StripeSetting::class);
    }
}
