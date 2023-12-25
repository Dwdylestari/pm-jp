@extends('layouts.admin')

@section('title', 'PM. Jaya Perkasa - Admin Product')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 fs-2">Admin Product</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Admin Product Page</li>
        </ol>
        <div class="card">
            <div class="card-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product Form</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.update', ['product_uuid' => $data['product']->product_uuid]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row gy-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_name" class="form-label">Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Plavon PVC" value="{{ $data['product']->product_name }}">
                                @if ($errors->has('product_name'))                                        
                                    @foreach ($errors->get('product_name') as $error)
                                        <div class="text-danger mt-1">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_weight" class="form-label">Weight</label>
                                <input type="number" step="any" name="product_weight" id="product_weight" class="form-control" placeholder="24" value="{{ $data['product']->product_weight }}">
                                @if ($errors->has('product_weight'))                                        
                                    @foreach ($errors->get('product_weight') as $error)
                                        <div class="text-danger mt-1">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_price" class="form-label">Price</label>
                                <input type="number" name="product_price" id="product_price" class="form-control" placeholder="24000" value="{{ $data['product']->product_price }}">
                                @if ($errors->has('product_price'))                                        
                                    @foreach ($errors->get('product_price') as $error)
                                        <div class="text-danger mt-1">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_stock" class="form-label">Stock</label>
                                <input type="number" name="product_stock" id="product_stock" class="form-control" placeholder="20" value="{{ $data['product']->product_stock }}">
                                @if ($errors->has('product_stock'))                                        
                                    @foreach ($errors->get('product_stock') as $error)
                                        <div class="text-danger mt-1">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_product_category_uuid" class="form-label">Category</label>
                                <select name="product_product_category_uuid" id="product_product_category_uuid" class="form-control">
                                    <option value="">- Select product category -</option>
                                    @foreach ($data['product_categories'] as $category)
                                        <option value="{{ $category->product_category_uuid }}" {{ $category->product_category_id == $data['product']->product_category_id ? 'selected' : '' }}>
                                            {{ $category->product_category_name }}
                                        </option>
                                    @endforeach
                                </select>                                
                                @if ($errors->has('product_product_category_uuid'))                                        
                                    @foreach ($errors->get('product_product_category_uuid') as $error)
                                        <div class="text-danger mt-1">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_img" class="form-label">Image</label>
                                <input type="file" name="product_img" id="product_img" class="form-control">
                                @if ($errors->has('product_img'))                                        
                                    @foreach ($errors->get('product_img') as $error)
                                        <div class="text-danger mt-1">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection