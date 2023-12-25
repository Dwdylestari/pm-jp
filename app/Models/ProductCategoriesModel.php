<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoriesModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_category_uuid';
    protected $table = 'product_categories';
    public $incrementing = false;
    protected $fillable = [
        'product_category_uuid',
        'product_category_name',
    ];

    public function product () {
        return $this->hasMany(ProductModel::class, 'product_product_category_uuid', 'product_category_uuid');
    }
}
