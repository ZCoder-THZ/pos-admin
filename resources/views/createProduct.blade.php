@extends ('template.master')
@section('styleSource')
    <style>
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            border-radius: 5px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            box-sizing: border-box;
        }

        .preview-images-zone .preview-image {
            width: 200px;
            height: 180px;
            position: relative;
            margin: 10px;
        }

        .preview-images-zone .preview-image .delete-button {
            position: absolute;
            top: 0;
            right: 0;
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
@endsection
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
        {{--
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Product Picture</label>
            <input type="file" name="productImage" class="form-control" id="productImage" onchange="previewImage(this)">
            <img id="preview" class="mt-2" style="max-width: 100%; display: none;">
            @error('productImage')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div> --}}

        <div class="form-group">
            <label for="images">Product Images (Max: 2048 KB)</label>
            <input type="file" name="images[]" id="images" class="form-control-file" multiple required>
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

        <div class="preview-images-zone">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
