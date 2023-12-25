<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransactionPayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_payment_uuid';
    protected $table = 'transaction_payments';
    public $incrementing = false;
    protected $fillable = [
        'transaction_payment_uuid',
        'transaction_payment_transaction_uuid',
        'transaction_payment_payment_method_uuid',
        'transaction_payment_status',
    ];

    public function transaction () {
        return $this->belongsTo(TransactionModel::class, 'transaction_payment_transaction_uuid', 'transaction_uuid');
    }

    public function paymentmethod () {
        return $this->belongsTo(PaymentMethodModel::class, 'transaction_payment_payment_method_uuid', 'paymentmethod_uuid');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->transaction_payment_uuid = (string) Str::uuid();
        });
    }
}
