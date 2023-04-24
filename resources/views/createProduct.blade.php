@extends ('template.master')

@section('content')
    <form class="col-4 offset-4 shadow p-4 rounded" method="post" action="{{ route('product#createProduct') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="productName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('productName')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Product Brand</label>
            <input type="text" name="productBrand" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            @error('productBrand')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Product Price</label>
            <input type="text" name="productPrice" class="form-control" id="exampleInputPassword1">
            @error('productPrice')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Product Picture</label>
            <input type="file" name="productImage" class="form-control" id="">
            @error('productImage')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Product Descriopiton</label>
            <textarea name="productDescription" class="form-control" id="">Enter Description</textarea>
            @error('productDescription')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Product Category</label>
            <select name="categoryId" id="" class="form-control">
                <option value="">Select The Catgegory</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    {{-- <option value="2">Funiture</option> --}}
                @endforeach
            </select>
            @error('categoryId')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
