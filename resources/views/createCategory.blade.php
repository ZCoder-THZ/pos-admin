@extends ('template.master')

@section('content')
<form class="col-4 offset-4 shadow p-4 rounded" method="post" action="{{route('category#createCategory')}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="" class="form-label">Category Name</label>
      <input type="text" name="categoryName" class="form-control" placeholder="enter categoryName">
        @error('catgoryName')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>



    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection
