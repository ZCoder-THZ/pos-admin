@extends('template.master')

@section('content')
    <div class="container-fluid">

        <h1 class="text-center mb-4">Dashboard</h1>

        <div class="d-flex flex-wrap justify-content-center justify-content-sm-between mx-2">
            <div class="bg-primary text-white rounded mx-2 mb-2"
                style="flex-basis: 120px; flex-grow: 1; display: flex; align-items: center; justify-content: center;">
                <div class="py-4 d-flex flex-column">
                    <h3 class="text-center">Products</h3>
                    <h4 class="text-center"><i class="fa-solid fa-boxes-stacked"></i></h4>
                    <a href="{{ route('product#homePage') }}"
                        class="text-lg text-center text-white text-decoration-none">{{ count($products) }}</a>
                </div>
            </div>
            <div class="bg-primary text-white rounded mx-2 mb-2"
                style="flex-basis: 120px; flex-grow: 1; display: flex; align-items: center; justify-content: center;">
                <div class="py-4 d-flex flex-column">
                    <h3 class="text-center">Orders</h3>
                    <h4 class="text-center"><i class="fa-solid fa-cart-arrow-down"></i></h4>
                    <a href="{{ route('order#getOrders') }}"
                        class="text-lg text-center text-white text-decoration-none">{{ count($orders) }}</a>
                </div>
            </div>
            <div class="bg-primary text-white rounded mx-2 mb-2"
                style="flex-basis: 120px; flex-grow: 1; display: flex; align-items: center; justify-content: center;">
                <div class="py-4 d-flex flex-column">
                    <h3 class="text-center">Users</h3>
                    <h4 class="text-center"><i class="fa-solid fa-users"></i></h4>
                    <a href="{{ route('admin#list') }}"
                        class="text-lg text-center text-white text-decoration-none">{{ count($users) }}</a>
                </div>
            </div>
            <div class="bg-primary text-white rounded mx-2 mb-2"
                style="flex-basis: 120px; flex-grow: 1; display: flex; align-items: center; justify-content: center;">
                <div class="py-4 d-flex flex-column">
                    <h3 class="text-center">Categories</h3>
                    <h4 class="text-center"><i class="fa-solid fa-table-cells-large"></i></h4>
                    <a href="{{ route('category#categoryList') }}"
                        class="text-lg text-center text-white text-decoration-none">{{ count($categories) }}</a>
                </div>
            </div>
        </div>


    </div>
@endsection
