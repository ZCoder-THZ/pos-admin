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
                        <th scope="row">{{ $category->category_id }}</th>
                        <th scope="row">{{ $category->category_name }}</th>

                        <th>
                            {{ $category->created_at }}
                        </th>
                        <th>
                            <a href="{{ route('category#deleteCategory', $category->category_id) }}"
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i>Delete</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $categories->links() }}
        </div>
    @endsection
