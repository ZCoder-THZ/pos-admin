@extends ('template.master')

@section('content')
    <form class="col-4 offset-4 shadow p-4 rounded" method="post" action="{{ route('product#createProduct') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="productName" class="form-control" id="productName" aria-describedby="emailHelp">
            @error('productName')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Product Brand</label>
            <input type="text" name="productBrand" class="form-control" id="productBrand" aria-describedby="emailHelp">
            @error('productBrand')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Product Price</label>
            <input type="text" name="productPrice" class="form-control" id="productPrice">
            @error('productPrice')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Product Picture</label>
            <input type="file" name="productImage" class="form-control" id="productImage" onchange="previewImage(this)">
            <img id="preview" class="mt-2" style="max-width: 100%; display: none;">
            @error('productImage')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Product Description</label>
            <textarea name="productDescription" class="form-control" id="productDescription">Enter Description</textarea>
            @error('productDescription')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Product Category</label>
            <select name="categoryId" id="categoryId" class="form-control">
                <option value="">Select The Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    {{-- <option value="2">Furniture</option> --}}
                @endforeach
            </select>
            @error('categoryId')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                    $('#preview').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
