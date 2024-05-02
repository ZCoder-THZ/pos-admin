@extends('template.master')
@section('content')
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->

        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        @if ($user->image)
                            <img src="{{ asset('storage/users/' . $user->image) }}" alt="avatar"
                                class="img-account-profile rounded-circle mb-2">
                        @else
                            <img class="img-account-profile rounded-circle mb-2"
                                src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        @endif
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <button class="btn btn-primary" type="button">Upload new image</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('admin#editProfile') }}">
                            @csrf
                            <!-- Form Group (username)-->
                            <input type="hidden" name="userId" value="{{ $user->id }}">
                            <div class="mb-3">
                                <label class="small mb-1"> Upload Image</label>
                                <input type="file" name="userImage" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to other
                                    users on the site)</label>
                                <input class="form-control" id="inputUsername" name="userName" type="text"
                                    placeholder="Enter your username" value="{{ $user->name }}">
                            </div>
                            <!-- Form Row-->
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" type="email"
                                    placeholder="Enter your email address" name="userEmail" value="{{ $user->email }}">
                            </div>

                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->

                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Location</label>
                                    <input class="form-control" id="inputLocation" type="text" name="userAddress"
                                        placeholder="Enter your location" value="{{ $user->address }}">
                                </div>
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" name="userPhone" id="inputPhone" type="tel"
                                        placeholder="Enter your phone number" value="{{ $user->phone }}">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">

                                    <label class="small mb-1" for="inputPhone">Gender</label>
                                    <select name="userGender" id="" class="form-control">

                                        <option value="male" @if ($user->gender == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($user->gender == 'female') selected @endif>FeMale
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
