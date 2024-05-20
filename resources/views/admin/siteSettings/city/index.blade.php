@extends('template.master')

@section('content')
    <section class="bg-red-900 ">
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
        <div class="container py-5 h-100">
            <button type="button" class="btn btn-primary mb-4 addCity" data-toggle="modal"
                data-target="#exampleModalCenter">
                Add City
            </button>
            <table id="cityTable" class="table table-secondary table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Country Name</th>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </section>
    <div class="modal" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('country#updateCountry') }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="text" name="country" class="form-control">
                        <input type="number" name="id" class="form-control countryId">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <select class="form-control mb-3" name="country" id="country_id">
                            @foreach ($countries as $item)
                                <option class="" value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="city" class="form-control" id="city_name">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary addCity">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
    <script>
        $(function() {
            var table = $('#cityTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('city#getCityList') !!}',

                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'country_name',
                        name: 'country_name'
                    }
                ]


            });
            $('.modal-footer').on('click', '.addCity', function() {
                const city_name = $('#city_name').val();
                const country_id = $('#country_id').val();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/add-city',
                    type: 'POST',
                    data: {
                        city_name,
                        country_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle success response
                        // alert('Item added successfully');
                        // Re-draw the DataTable
                        table.draw();
                        $('#exampleModalCenter').modal('hide');
                    },
                    error: function(xhr, error) {
                        // Handle error response
                        console.error(error);
                        alert('Error adding item');
                    }
                });

            })
        })
    </script>
@endsection
