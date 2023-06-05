@extends ('template.master')

@section('content')
    <h1 class="text-center">Detail & Edit</h1>
    <form class="col-4 offset-4 shadow p-4 rounded" method="post" action="{{ route('product#edit') }}"
        enctype="multipart/form-data">
        @csrf
        @if ($product->product_image)
            <img class="img-thumbnail shadow" style="width: 500px"
                src="{{ preg_match('/^https:\/\/images.unsplash.com\//', $product->product_image) ? $product->product_image : asset('storage/' . $product->product_image) }}"
                alt="">
        @else
            <h3 class="text-center">NO image exist</h3>
        @endif
        <div class="mb-3">
            <input type="hidden" name="productId" value="{{ $product->product_id }}">
            <br>
            <label for="exampleInputPassword1" class="form-label">Product Picture</label>
            <input type="file" name="productImage" class="form-control" id="">
            @error('productImage')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Product Name</label>
            <input type="text" name="productName" value="{{ $product->product_name }}" class="form-control"
                id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('productName')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Product Price</label>
            <input type="text" value="{{ $product->product_price }}" name="productPrice" class="form-control"
                id="exampleInputPassword1">
            @error('productPrice')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Product Brand</label>
            <input type="text" value="{{ $product->product_brand }}" name="productBrand" class="form-control"
                id="exampleInputPassword1">
            @error('productPrice')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Product Descriopiton</label>
            <textarea name="productDescription" class="form-control" id="">{{ $product->product_description }}</textarea>
            @error('productDescription')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Product Category</label>
            <select name="categoryId" id="" class="form-control">
                <option value="">Select The Catgegory</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" @if ($product->category_id == $category->category_id) selected @endif>
                        {{ $category->category_name }}</option>
                    {{-- <option value="2">Funiture</option> --}}
                @endforeach
            </select>
            @error('categoryId')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
