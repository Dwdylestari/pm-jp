<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'bank_uuid';
    protected $table = 'banks';
    public $incrementing = false;
    protected $fillable = [
        'bank_uuid',
        'bank_name',
    ];

    public function payment_method () {
        return $this->hasMany(PaymentMethodModel::class, 'paymentmethod_bank_uuid', 'bank_uuid');
    }
}
