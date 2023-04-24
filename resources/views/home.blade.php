@extends('template.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Created Products</h1>
            <div class="">


                <form
                    class="d-none float-end d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                    action="{{ route('product#homePage') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="key" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>



        </div>
        @if (session('updateSuccess'))
            <div class="offset-8 col-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateSuccess') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if (session('deleteSuccess'))
            <div class="offset-8 col-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('deleteSuccess') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if (session('createSuccess'))
            <div class="offset-8 col-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('createSuccess') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">product image</th>
                    <th scope="col">product category</th>
                    <th scope="col">produc Name</th>
                    <th scope="col">product price</th>
                    <th scope="col">created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->product_id }}</th>
                        <th scope="row"><img
                                src="{{ preg_match('/^https:\/\/images.unsplash.com\//', $product->product_image) ? $product->product_image : asset('storage/' . $product->product_image) }}"
                                class="card-img-top img-thumbnail" style="width: 100px" alt="..."></th>


                        <th scope="row">{{ $product->category_name }}</th>
                        <th scope="row">{{ $product->product_name }}</th>
                        <th scope="row">{{ $product->product_price }}</th>
                        <th scope="row">{{ $product->created_at }}</th>
                        <th> <a href="{{ route('product#editProductPage', $product->product_id) }}"
                                class="btn btn-warning"><i class="fa-solid fa-file-pen"></i>Detail</a>
                            <a href="{{ route('product#deleteProduct', $product->product_id) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i>Delete</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $products->links() }}
        </div>
    @endsection
