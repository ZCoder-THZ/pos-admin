@extends ('template.master')

@section('content')




    <button type="button" class="btn btn-primary float-right mr-3 mb-3" data-toggle="modal" data-target="#exampleModal"
        data-whatever="@mdo">Create Category</button>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="categoryForm" class="" method="post" action="{{ route('category#createCategory') }}"
                    enctype="multipart/form-data">
                    <div class="modal-body">


                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" name="categoryName" class="form-control" placeholder="enter categoryName">
                            @error('catgoryName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>

                    </div>
                </form>

            </div>
        </div>
    </div>















    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>

                <th scope="col">Category Name</th>

                <th scope="col">created At</th>

            </tr>
        </thead>
        <tbody>
            @if ($categories->count() > 0)
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>


                        <th scope="row">{{ $category->category_name }}</th>

                        <th scope="row">{{ $category->created_at }}</th>
                        <th class="">

                            {{--
                        <a href="{{ route('product#editProductPage', $product->product_id) }}"
                            class="btn btn-warning"><i class="fa-solid fa-file-pen"></i>Detail</a>

                        <a class="btn btn-danger"href="{{ route('product#deleteProduct', $product->product_id) }}"
                            class=""><i class="fa-solid fa-trash"></i>Delete</a> --}}

                        </th>
                    </tr>
                @endforeach
            @endif
        </tbody>

    </table>
    {{ $categories->links() }}
    <script>
        const showCategoryForm = document.getElementById('showCategoryForm')
        showCategoryForm.addEventListener('click', (event) => {
            const categoryForm = document.getElementById('categoryForm')
            categoryForm.classList.toggle('hide')
        })
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
@endsection
