@extends ('template.master')

@section('content')
    <h1 class="text-center">Detail & Edit</h1>
    <form class="col-8 offset-2 shadow p-4 rounded" method="post" action="{{ route('product#edit') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            @foreach ($product->images as $image)
                <div class="d-inline-block position-relative">
                    <img class="img-thumbnail shadow mb-2 mr-2" style="width: 150px; height: 150px;"
                        src="{{ preg_match('/^https:\/\/images.unsplash.com\//', $image->url) ? $image->url : asset('storage/' . $image->url) }}"
                        alt="Product Image">
                    <span class="delete-button" onclick="removeImage(this)">X</span>
                    <input type="hidden" name="deletedImages[]" value="{{ $image->url }}">
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <input type="hidden" name="productId" value="{{ $product->id }}">
            <label for="exampleInputPassword1" class="form-label">Add More Images</label>
            <input type="file" name="productImage[]" class="form-control-file" id="images" multiple required>
            <small class="form-text text-muted">You can select multiple images</small>
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
            <label for="">Product Description</label>
            <textarea name="productDescription" class="form-control" id="productDescription">{{ $product->product_description }}</textarea>
            @error('productDescription')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Product Category</label>
            <select name="categoryId" id="categoryId" class="form-control">
                <option value="">Select The Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                        {{ $category->category_name }}</option>
                @endforeach
            </select>
            @error('categoryId')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <style>
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            border-radius: 5px;
            padding: 20px;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            flex-wrap: wrap;
            box-sizing: border-box;
        }

        .preview-images-zone .preview-image {
            width: 150px;
            height: 150px;
            position: relative;
            margin: 10px;
        }

        .preview-images-zone .preview-image .delete-button {
            position: absolute;
            top: -10px;
            right: -10px;
            cursor: pointer;
            width: 25px;
            height: 25px;
            background-color: #333;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 25px;
        }
    </style>

    <script>
        document.getElementById('images').addEventListener('change', function() {
            var files = document.getElementById('images').files;
            for (var i = 0; i < files.length; i++) {
                previewImage(this.files[i]);
            }
        });

        function previewImage(file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var html = `
            <div class="preview-image">
                <img src="${event.target.result}" alt="${file.name}" style="width:100%;height:100%;">
                <span class="delete-button" onclick="removeImage(this)">X</span>
            </div>`;
                document.querySelector('.preview-images-zone').insertAdjacentHTML('beforeend', html);
            }
            reader.readAsDataURL(file);
        }

        function removeImage(element) {
            element.parentElement.remove();
        }
    </script>
@endsection
