@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class="page" id="create-user">
        <div class="d-flex">
            <div>
                <div class="foto">
                    <img class="img-fluid mt-4 user" src="/default-user-image.png" width="400" height="510" >
                </div>
                <!--Upload image-->

                <div class="input-group"  >

                    <div class="input-box" id="upload-image">
                        <label class ="mt-2" for="firstname">Upload Image:</label>
                        <input type="file" name="file" id="file" class="inputfile" hidden onchange=""/>
                        <div class="upload-btn-wrapper">
                            <label for="file" class="btn btn-outline-secondary mt-2">Choose a file</label>
                        </div>


                    </div>

                </div>
            </div>
            <div class="outside ms-5 me-5 p-3" id="container-newUser">
                <div class="spec d-flex flex-column ps-3 pe-3" >
                    <div class="stuf ms-3 mt-4 mb-4">
                        <p class="h2 fw-bold"> Create a new User <i class="h3 fa-solid fa-user-plus"></i></p>
                        <p class="h4"> Specify your details right below! </p>
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
                    <form method="POST" action="">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="forms d-flex">
                            <div>
                                <div class="input-box ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">First Name:</label>
                                    <input type="text" class="" name="firstname" value="">
                                </div>
                                <div class="input-box ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Last Name:</label>
                                    <input type="text" class="" name="lastname" value="">
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Email:</label>
                                    <input type="text" class="" name="email" value="">
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Password:</label>
                                    <input type="password" class="" name="password" value="">
                                </div>
                            </div>
                            <div class="ms-5">
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Username:</label>
                                    <input type="text" class="" name="username" value="">
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Address:</label>
                                    <input type="text" class="" name="address" value="">
                                </div>
                                <div class="input-box  ms-3 mb-4">
                                    <label for="html" class="fw-bold ms-0">Phone Number:</label>
                                    <input type="text" class="" name="phonenumber" value="">
                                </div>
                                <div class="input-box  ms-3 mb-3">
                                    <label for="html" class="fw-bold ms-0">Confirm Password:</label>
                                    <input type="password" class="" name="password_confirmation" value="">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="continue-button botao ps-0 ms-3 mb-2">
                                <input type="submit" class="continue-button" value="Save Changes"/>
                            </div>
                        </div>
                    </form>
                    <hr>


                    </form>
                </div>
            </div>
        </div>
        </div>
@endsection
