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
                <form method="POST" action="{{ route('product#updateCountry') }}">
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
@endsection
@section('scriptSource')
    <script type="text/javascript">
        $(function() {
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('product#getCountryList') !!}',
                    data: function(d) {
                        d.lang = $('#lang').val();
                        d.country = $('input[name=country]').val();
                        d.is_active = $('#is_active').val();
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



        });
    </script>
@endsection
var countryName = $(this).closest('tr').find('td:eq(1)').text();
