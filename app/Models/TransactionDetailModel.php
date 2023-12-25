<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetailModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_detail_uuid';
    protected $table = 'transaction_details';
    public $incrementing = false;
    protected $fillable = [
        'transaction_detail_uuid',
        'transaction_detail_transaction_uuid',
        'transaction_detail_product_uuid',
        'transaction_detail_quantity',
        'transaction_detail_totalprice',
    ];

    public function transaction () {
        return $this->belongsTo(TransactionModel::class, 'transaction_detail_transaction_uuid', 'transaction_uuid');
    }

    public function product () {
        return $this->belongsTo(ProductModel::class, 'transaction_detail_product_uuid', 'product_uuid');
    }
}
