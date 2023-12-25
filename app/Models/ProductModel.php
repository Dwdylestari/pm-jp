<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_uuid';
    protected $table = 'products';
    public $incrementing = false;
    protected $fillable = [
        'product_uuid',
        'product_product_category_uuid',
        'product_name',
        'product_weight',
        'product_price',
        'product_stock',
        'product_img',
    ];

    public function product_category () {
        return $this->belongsTo(ProductCategoriesModel::class, 'product_product_category_uuid', 'product_category_uuid');
    }

    public function transaction_detail () {
        return $this->hasMany(TransactionDetailModel::class, 'transaction_detail_product_uuid', 'product_uuid');
    }

    public static function get_product_papan () {
        $data = DB::table('products')
            ->join('product_categories', 'products.product_product_category_uuid', '=', 'product_categories.product_category_uuid')
            ->where('product_categories.product_category_name', '=', 'Papan')
            ->get();
    
        return $data;
    }

    public static function get_product_perlengkapan () {
        $data = DB::table('products')
            ->join('product_categories', 'products.product_product_category_uuid', '=', 'product_categories.product_category_uuid')
            ->where('product_categories.product_category_name', '=', 'Perlengkapan')
            ->get();
    
        return $data;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->product_uuid = (string) Str::uuid();
        });
    }
}
