@extends('template.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Orders</h1>
            <div class="">


            </div>



        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Porduct Name</th>
                    <th scope="col">Image</th>
                    <th scope="col"> Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">TotalPrice</th>
                    <th scope="col">Created At</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                    <tr>
                        <th scope="row">{{ $item->product_name }}</th>

                        <th scope="row"><img
                                src="{{ preg_match('/^https:\/\/images.unsplash.com\//', $item->product_image) ? $item->product_image : asset('storage/' . $item->product_image) }}"
                                class="card-img-top img-thumbnail" style="width: 100px" alt="..."></th>
                        <th scope="row">{{ $item->product_price }}</th>
                        <th scope="row">{{ $item->quantity }}</th>
                        <th scope="row">{{ $item->total_price }}</th>
                        <th scope="row">{{ $item->created_at }}</th>


                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            {{-- {{ $orders->links() }} --}}
        </div>
    @endsection
