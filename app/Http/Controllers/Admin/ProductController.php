<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductCategoriesModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index ()
    {
        $data['product_categories'] = ProductCategoriesModel::all();
        $data['products'] = ProductModel::with('product_category')->get();

        return view('admin.products.index', ['data' => $data]);
    }

    public function update_page (string $product_uuid)
    {
        $data['product_categories'] = ProductCategoriesModel::all();
        $data['product'] = ProductModel::where('product_uuid', $product_uuid)->first();

        return view('admin.products.update', ['data' => $data]);
    }

    public function store (ProductRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            if ($request->hasFile('product_img')) {
                $file = $request->file('product_img');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('images/products', $filename);
                $data = $request->validated();
                $data['product_img'] = $filename;
                $action = ProductModel::create($data);

                return redirect()->route('admin.product.index')->with('success', 'Successfully add product!');
            }
        }
    }

    public function delete(string $product_uuid)
    {
        $product = ProductModel::where('product_uuid', $product_uuid)->first();
        $imagePath = public_path('images/products/' . $product->product_img);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            $product->delete();
        }

        return redirect()->route('admin.product.index')->with('success', 'Successfully delete product!');
    }

    public function update (ProductRequest $request, string $product_uuid)
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $product = ProductModel::where('product_uuid', $product_uuid)->first();
            $data = $request->validated();

            if ($request->hasFile('product_img')) {
                $imagePath = public_path('images/products/' . $product->product_img);

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }

                $file = $request->file('product_img');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('images/products', $filename);
                $data['product_img'] = $filename;
            }

            $product->update($data);

            return redirect()->route('admin.product.index')->with('success', 'Successfully update product!');
        }
    }
}
