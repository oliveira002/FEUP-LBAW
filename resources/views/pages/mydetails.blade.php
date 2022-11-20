@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class="cover out2">
        <div class="prof d-flex">
            @include('partials.sidebar')
            <div class="outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class="stuf ms-3 mt-4 mb-4">
                        <p class="h2 fw-bold"> My Details </p>
                        <p class="h4"> Feel free to change any of your details right below! </p>
                    </div>
                    @if($errors->has('error'))
                        <div class="mb-4 alert alert-danger">
                            <ul class="ps-0">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{route('updetails',['username' => $user->username])}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="forms d-flex">
                            <div>
                                <div class="input-box ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">First Name:</label>
                                    <input type="text" class="" name="firstname" value="{{$user->firstname}}">
                                </div>
                                <div class="input-box ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Last Name:</label>
                                    <input type="text" class="" name="lastname" value="{{$user->lastname}}">
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Email:</label>
                                    <input type="text" class="" name="email" value="{{$user->email}}">
                                </div>
                                <div class ="ms-3 mb-3">
                                    <button class = "uppic" type = "button">
                                        <label for="auc_pic"><i class="fa-solid fa-cloud-arrow-up"></i>Change picture</label>
                                        <input name="auc_pic" id="auc_pic" class="img-fluid" type="file" accept="image/jpeg, image/png" width="400" height="510" style="display: none">
                                    </button>
                                </div>
                            </div>
                            <div class="ms-5">
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Username:</label>
                                    <input type="text" class="" name="username" value="{{$user->username}}">
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Address:</label>
                                    <input type="text" class="" name="address" value="{{$user->address}}">
                                </div>
                                <div class="input-box  ms-3 mb-4">
                                    <label for="html" class="fw-bold ms-0">Phone Number:</label>
                                    <input type="text" class="" name="phonenumber" value="{{$user->phonenumber}}">
                                </div>
                            </div>

                        </div>
                        <div>
                            <div class="continue-button botao ps-0 ms-3 mb-4">
                                <input type="submit" class="continue-button" value="Save Changes"/>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="stuf ms-3 mt-4 mb-4">
                        <p class="h2 fw-bold"> Change Password </p>
                        <p class="h4"> To change your password, please confirm it's you! </p>
                    </div>
                    <form method="POST" action="{{route('updatePassword',['username',$user->username])}}">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="forms">
                            @if ($errors->has('success'))
                                <div class="success alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li class="pass_error">{{ $errors->first('success') }}</li>
                                    </ul>
                                </div>
                            @endif
                            <div class="input-box  ms-3 mb-3">
                                <label for="html" class="fw-bold ms-0">Current Password:</label>
                                <input type="password" class="" name="current_password" value="">
                            </div>
                            @if ($errors->has('errorCurrPass'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li class="pass_error">{{ $errors->first('errorCurrPass') }}</li>
                                    </ul>
                                </div>
                            @endif
                            <div class="input-box ms-3 mb-3">
                                <label for="html" class="fw-bold ms-0">New Password:</label>
                                <input type="password" class="" name="new_password" value="">
                            </div>
                            @if ($errors->has('new_password'))
                                <div class="alert alert-danger mb-1.5 mt-1.5">
                                    <ul>
                                        <li class="pass_error">{{ $errors->first('new_password') }}</li>
                                    </ul>
                                </div>
                            @endif
                            <div class="input-box  ms-3 mb-3">
                                <label for="html" class="fw-bold ms-0">Confirm New Password:</label>
                                <input type="password" class="" name="new_password_confirmation" value="">
                            </div>
                            <div class="continue-button botao ps-0 ms-3 mb-4">
                                <input type="submit" class="continue-button" value="Change Password"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
