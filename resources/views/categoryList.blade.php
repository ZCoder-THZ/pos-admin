@extends('template.master')

@section('content')
    <div class="container-fluid">
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
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Created Categories</h1>
            <div class="">



            </div>



        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">created_at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->created_at->format('d-M-y') }}</td>

                        <td>
                            <a href="{{ route('category#deleteCategory', $category->id) }}" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i>Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $categories->links() }}
        </div>
    @endsection
