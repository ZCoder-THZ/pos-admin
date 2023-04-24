@extends('template.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Orders</h1>
            <div class="">


            </div>



        </div>
        @if (session('updateSuccess'))
            <div class="offset-8 col-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateSuccess') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
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
        @if (session('createSuccess'))
            <div class="offset-8 col-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('createSuccess') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">UserName</th>
                    <th scope="col"> image</th>
                    <th scope="col">Order id</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Ordered at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>

                        <input type="hidden" name="" value="{{ $order->order_id }}" class="orderId">
                        <th scope="row">{{ $order->name }}</th>

                        <th scope="row">
                            @if ($order->image)
                                <img src="{{ asset('storage/users/' . $order->image) }}" class="card-img-top img-thumbnail"
                                    style="width: 100px" alt="...">
                        </th>
                    @else
                        <img src="http://bootdey.com/img/Content/avatar/avatar1.png" class="card-img-top img-thumbnail"
                            style="width: 100px" alt="...">
                @endif

                <th scope="row">{{ $order->order_code }}</th>
                <th scope="row">{{ $order->total_price }}</th>
                <th scope="row">{{ $order->created_at }}</th>

                <td class="row">
                    <select name="status" class="form-control statusChange" id="">
                        <option class="" value="0" @if ($order->status == 0) selected @endif>Pending
                        </option>
                        <option class="" value="1" @if ($order->status == 1) selected @endif>Success
                        </option>
                        <option class="" value="2" @if ($order->status == 2) selected @endif>Failed
                        </option>

                    </select>
                </td>
                <th scope="row"><a class="btn btn-success"
                        href="{{ route('order#getOrderItems', ['order_code' => $order->order_code]) }}">Detail</a>
                </th>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="">
            {{ $orders->links() }}
        </div>
    @endsection
    @section('scriptSource')
        <script>
            $(document).ready(function() {
                $('.statusChange').change(function() {
                    $currentStatus = $(this).val();
                    $parentNode = $(this).parents('tr');
                    $orderId = $parentNode.find('.orderId').val();

                    console.log($currentStatus);
                    $data = {
                        'status': $currentStatus,
                        'orderId': $orderId
                    }
                    $.ajax({
                        method: 'get',
                        url: 'http://127.0.0.1:8000/ajax/change/status',
                        data: $data,
                        dataType: 'json',
                        success: function() {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>
    @endsection
