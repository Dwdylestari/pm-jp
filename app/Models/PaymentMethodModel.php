<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'paymentmethod_uuid';
    protected $table = 'paymentmethods';
    public $incrementing = false;
    protected $fillable = [
        'paymentmethod_uuid',
        'paymentmethod_user_uuid',
        'paymentmethod_bank_uuid',
        'paymentmethod_accountnumber',
    ];

    public function bank () {
        return $this->belongsTo(BankModel::class, 'paymentmethod_bank_uuid', 'bank_uuid');
    }

    public function transaction_payment () {
        return $this->hasMany(TransactionPayment::class, 'transaction_payment_paymentmethod_uuid', 'paymentmethod_uuid');
    }
}
