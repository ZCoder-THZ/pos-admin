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
            <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModalCenter">
                Add Country
            </button>
            <table id="example" class="table table-secondary table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Actions</th>

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
                        <input type="text" name="country" class="form-control" id="country">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary addCountry">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
    <script type="text/javascript">
        $(function() {
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('country#getCountryList') !!}',
                    data: function(d) {
                        // d.lang = $('#lang').val();
                        d.country = $('input[name=country]').val();
                        // d.is_active = $('#is_active').val();
                    }
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
                        data: 'action',
                        name: 'action'
                    },


                ]


            });
            $('#example').on('click', '.editCountry', function() {
                // Get the ID associated with the button
                var countryId = $(this).data('id');

                // Log the countryId to the console
                console.log(countryId);

                // Get the text from the table cell
                var countryName = $(this).closest('tr').find('td:eq(1)').text();

                // Populate the input field in the modal with the country name
                $('#editModal input[type="text"]').val(countryName);

                // Set the value of the input field with class 'countryId' to the country ID
                $('#editModal input.countryId').val(countryId);

                // Show the modal
                $('#editModal').modal('show');
            });

            $('#example').on('click', '.delete', function() {
                // Get the ID associated with the button
                console.log($(this).data('id'));
                id = $(this).data('id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/delete-country/' + id, // Replace with your actual delete route
                    type: 'DELETE',
                    _token: '{{ csrf_token() }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Handle success response, maybe remove the deleted row from the table
                        // $('#row-' + id).remove();
                        alert('Item deleted successfully');
                        // Re-draw the DataTable
                        table.draw();
                    },
                    error: function(xhr, error) {
                        // Handle error response
                        console.error(error);
                        alert('Error deleting item');
                    }
                });


            });
            $('.modal-footer').on('click', '.addCountry', function() {
                // Get the ID associated with the button
                const countryName = $('#country').val();


                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/add-country/',
                    type: 'POST',
                    data: {
                        country_name: countryName
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

            });
        })
    </script>
@endsection
var countryName = $(this).closest('tr').find('td:eq(1)').text();
