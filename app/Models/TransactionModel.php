<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_uuid';
    protected $table = 'transactions';
    public $incrementing = false;
    protected $fillable = [
        'transaction_uuid',
        'transaction_user_uuid',
        'transaction_totalprice',
        'transaction_isPaid',
    ];

    public function user () {
        return $this->belongsTo(User::class, 'transaction_user_uuid', 'user_uuid');
    }

    public function transaction_detail () {
        return $this->hasMany(TransactionDetailModel::class, 'transaction_detail_transaction_uuid', 'transaction_uuid');
    }

    public function transaction_delivery () {
        return $this->hasOne(TransactionDeliveryModel::class, 'transaction_delivery_transaction_uuid', 'transaction_uuid');
    }

    public function transaction_payment () {
        return $this->hasOne(TransactionPayment::class, 'transaction_payment_transaction_uuid', 'transaction_uuid');
    }
}
