<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StripeSetting extends Model
{
    use Encryptable;

    protected $encryptable = ['public_key', 'secret_key'];

    protected $fillable = ['user_id', 'token', 'public_key', 'secret_key'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
