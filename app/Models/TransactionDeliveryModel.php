<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransactionDeliveryModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_delivery_uuid';
    protected $table = 'transaction_deliveries';
    public $incrementing = false;
    protected $fillable = [
        'transcation_delivery_uuid',
        'transaction_delivery_transaction_uuid',
        'transaction_delivery_province',
        'transaction_delivery_city',
        'transaction_delivery_address',
        'transaction_delivery_weight',
        'transaction_delivery_service',
        'transaction_delivery_shippingcost',
    ];

    public function transaction () {
        return $this->belongsTo(TransactionModel::class, 'transaction_delivery_transaction_uuid', 'transaction_uuid');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->transaction_delivery_uuid = (string) Str::uuid();
        });
    }
}
