@extends ('template.master')

@section('content')
    <div class="d-flex justify-content-center">
        @foreach ($message as $mess)
            <div class=" border p-4" style="width: 40%" role="alert">
                <h4 class="alert-heading text-center">From: {{ $mess->email }}</h4>
                <div class="d-flex justify-content-between">
                    <h4 class="alert-heading text-left">Name: {{ $mess->name }}</h4>
                    <h4 class="alert-heading text-right">Phone: {{ $mess->phone }}</h4>
                </div>
                <h5 class="">About : {{ $mess->subject }}</h5>
                <p>{{ $mess->message }}</p>
                <hr>
                <a href="{{ route('contact#getContacts') }}" class="btn btn-primary">Back</a>
            </div>
        @endforeach
    </div>
@endsection
