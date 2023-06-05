@extends('template.master')

@section('content')
    <section class=" gradient-custom-2 ">
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
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-10">

                    <div class="card mask-custom">
                        <div class="card-body p-4 text-white">

                            <div class="text-center pt-3 pb-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp"
                                    alt="Check" width="60">
                                <h2 class="my-4">User List</h2>
                            </div>
                            <div class="table-responsive">

                                <table class="table text-white mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>

                                            <th scope="col">Name</th>
                                            <th scope="col">Priotiy</th>
                                            <th></th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr class="fw-normal">
                                                <input type="hidden" class="userId" value="{{ $user->id }}">
                                                <th>
                                                    @if ($user->image == null)
                                                        @if ($user->gender == 'male')
                                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                                alt="avatar 1" style="width: 45px; height: auto;">
                                                        @else
                                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                                alt="avatar
                                                        1"
                                                                style="width: 45px; height: auto;">
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/' . $user->image) }}" alt=""
                                                            style="width: 45px; height: auto;" class="rounded-circle">
                                                    @endif

                                                </th>
                                                <td class="align-middle">
                                                    <span>{{ $user->name }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>{{ $user->role }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('admin#profileDetail', $user->id) }}"
                                                        style="cursor:pointer" class="mb-0 text-white"><span
                                                            class="badge bg-success "><i
                                                                class="fa-solid fa-eye"></i>Detail</span></a>
                                                </td>
                                                <td class="align-middle">
                                                    @if (Auth::user()->id !== $user->id)
                                                        <select name="role" class="form-control roleChange"
                                                            id="">
                                                            <option class="" value="user"
                                                                @if ($user->role == 'user') selected @endif>User
                                                            </option>
                                                            <option class="" value="admin"
                                                                @if ($user->role == 'admin') selected @endif>Admin
                                                            </option>
                                                    @endif
                                                    </select>
                                                </td>
                                                <td class="align-middle">
                                                    {{-- <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                                                            class="fas fa-check fa-lg text-success me-3"></i></a> --}}
                                                    @if (Auth::user()->id !== $user->id)
                                                        <a href="{{ route('admin#deleteAdmin', $user->id) }}"
                                                            data-mdb-toggle="tooltip" title="Remove"><i
                                                                class="fas fa-trash-alt fa-lg text-danger"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.roleChange').change(function() {
                $currentRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();

                console.log($userId);
                $data = {
                    'role': $currentRole,
                    'userId': $userId
                }
                $.ajax({
                    method: 'get',
                    url: 'http://127.0.0.1:8000/admin/list/changeRole',
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
