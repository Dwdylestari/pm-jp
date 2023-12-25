<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\TransactionDetailModel;
use App\Models\TransactionModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function customerSearchProduct (Request $request) {
        $query = $request->search;
        if ($request->ajax()) {
            if (empty($query)) {
                $output = '';
            } else {
                $output = '';
                $products = ProductModel::where('product_name', 'LIKE', '%' . $query . '%')->get();
                $transaction = TransactionModel::where('transaction_user_uuid', auth()->user()->user_uuid)
                ->where('transaction_isPaid', false)
                ->first();
                $data = ['transaction_details' => null];
                if ($transaction) {
                    $data['transaction_details'] = TransactionDetailModel::where('transaction_detail_transaction_uuid', $transaction->transaction_uuid)
                    ->join('products', 'products.product_uuid', '=', 'transaction_details.transaction_detail_product_uuid')
                    ->get();
                }
        
                if ($products) {
                    foreach ($products as $key => $product) {
                        $output .= '<div class="col-12 col-md-4 col-lg-3">
                        <div class="card">
                            <img src="'.asset('images/products/' . $product->product_img).'" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <p class="my-2 card-text"><strong>Product Name</strong>: '.$product->product_name.'</p>
                                <p class="my-2 card-text"><strong>Product Weight</strong>: '.$product->product_weight.' kg</p>
                                <p class="my-2 card-text"><strong>Product Price</strong>: Rp '.$product->product_price.'</p>';
        
                        $isInCart = $data['transaction_details'] != null ? $data['transaction_details']->contains('transaction_detail_product_uuid', $product->product_uuid) : false;
        
                        if ($isInCart) {
                            $output .= '<p class="my-2 text-secondary">Product is exist in cart!</p>';
                        } else {
                            $output .= '<form action="'.route('customer.product.store', ['product_uuid' => $product->product_uuid]).'" method="POST">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <button class="btn btn-warning mt-4" type="submit">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                            </form>';
                        }
        
                        $output .= '</div>
                        </div>
                    </div>';
                    }
                }
            }
        }
    
        return $output;
    }

    public function adminSearchProduct (Request $request) {
        $query = $request->search;
        if ($request->ajax()) {
            if (empty($query)) {
                $output = '';
            } else {
                $output = '';
                $products = ProductModel::where('product_name', 'LIKE', '%' . $query . '%')->get();
        
                if ($products) {
                    foreach ($products as $key => $product) {
                        $output .= '<tr>
                        <td>' . ($key + 1) . '</td>
                        <td class="d-flex align-items-center gap-2">
                            <img src="' . asset('images/products/' . $product->product_img) . '" alt="Product Image" style="width: 72px;">
                            ' . $product->product_name . '
                        </td>
                        <td>' . $product->product_weight . ' kg</td>
                        <td>' . $product->product_stock . '</td>
                        <td>' . $product->product_price . '</td>
                        <td class="d-flex align-items-center gap-2">
                            <a href="' . route('admin.product.update_page', ['product_uuid' => $product->product_uuid]) . '" class="btn btn-warning">
                                <i class="fas fa-pencil"></i>
                            </a>
                            <form action="' . route('admin.product.delete', ['product_uuid' => $product->product_uuid]) . '" method="POST">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>                                  
                        </td>
                    </tr>';
                    }
                }
            }
        }
    
        return $output;
    }
}
