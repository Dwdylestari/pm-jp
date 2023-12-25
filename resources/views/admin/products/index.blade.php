@extends('layouts.admin')

@section('title', 'PM. Jaya Perkasa - Admin Products')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 fs-2">Products</h1>
        <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item active">Products Page</li>
        </ol>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="fs-6 my-0">Products Table</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-plus"></i>
                        Add Product
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="#" method="GET" class="w-25 mb-4">
                    @csrf
                    <input type="text" class="form-control" placeholder="Search product...." name="search" id="search" autocomplete="off">
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product</th>
                                <th scope="col">Product Weight</th>
                                <th scope="col">Product Stock</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="results">
                            @foreach ($data['products'] as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('images/products/' . $product->product_img) }}" alt="Product Image" style="width: 72px;">
                                        {{ $product->product_name }}
                                    </td>
                                    <td>{{ $product->product_weight }} kg</td>
                                    <td>{{ $product->product_stock }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td class="d-flex align-items-center gap-2">
                                        <a href="{{ route('admin.product.update_page', ['product_uuid' => $product->product_uuid]) }}" class="btn btn-warning">
                                            <i class="fas fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.product.delete', ['product_uuid' => $product->product_uuid]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="product_name" class="form-label">Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Plavon PVC" value="{{ old('product_name') }}">
                                    @if ($errors->has('product_name'))                                        
                                        @foreach ($errors->get('product_name') as $error)
                                            <div class="text-danger mt-1">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="product_weight" class="form-label">Weight (kg)</label>
                                    <input type="number" step="any" name="product_weight" id="product_weight" class="form-control" placeholder="24" value="{{ old('product_size') }}">
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
                                    <input type="number" name="product_price" id="product_price" class="form-control" placeholder="24000" value="{{ old('product_price') }}">
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
                                    <input type="number" name="product_stock" id="product_stock" class="form-control" placeholder="20" value="{{ old('product_stock') }}">
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
                                            <option value="{{ $category->product_category_uuid }}">{{ $category->product_category_name }}</option>
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
                                    <input type="file" name="product_img" id="product_img" class="form-control" value="{{ old('product_img') }}">
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
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var originalContent = $('#results').html();

        $('#search').on('keyup', function() {
            $value = $(this).val();

            if ($value === '') {
                $('#results').html(originalContent);
            } else {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.product.search') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('#results').html(data);
                    }
                });
            }
        });
    </script>
@endpush