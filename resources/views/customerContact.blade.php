@extends ('template.master')

@section('content')
    <h1 class="text-center">Customer Contacts</h1>
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
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>

                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">SUBJECT</th>
                    <th scope="col">MESSAGE</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>

                        <td>{{ $contact->contact_id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        <td> <a href="{{ route('contact#getMessage', $contact->contact_id) }}"
                                class="btn btn-primary px-4 ">view</a> <a
                                href="{{ route('contact#deleteMessage', $contact->contact_id) }}"
                                class="btn btn-danger px-4 ">Delete</a> </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
