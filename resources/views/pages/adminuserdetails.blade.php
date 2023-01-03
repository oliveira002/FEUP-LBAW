@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out2">
        <div class="prof d-flex">
            <div id="aside">
                <div class="hi d-flex pt-4 pb-4">
                    <div class="lg">
                        <?php
                        if(file_exists('images/users/'.$user->idclient.'.jpg')) {
                            $path = '/images/users/'.$user->idclient.'.jpg';
                        }
                        else {
                            $path = "/images/users/def.png";
                        }
                        ?>
                        <img src= "{{$path}}" width="120" height="120" alt="User Image">
                    </div>
                    <div class="nome ms-3 me-2">
                        <p class = "fw-bold mb-0"> {{$user->firstname}} {{$user->lastname}} </p>
                    </div>
                </div>
                <ul class = "ps-0 mt-2">
                    <li>
                        <a href = "{{route('profile',['username' =>$user->username])}}"><button class = "fw-bold">
                                <i class="fa-solid fa-user"></i>
                                Account Overview
                            </button> </a>
                    </li>
                    <li>

                        <a href="{{route('editusers',['username' => $user->username])}}"><button class = "fw-bold">
                                <i class="fa-regular fa-pen-to-square"></i>
                            Edit User</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{url()->previous()}}"><button class = "fw-bold">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Go Back</button>
                        </a>
                    </li>
                </ul>
            </div>
            <div class = "outside">
                <div class="spec d-flex flex-column ps-3 pe-3">
                    <div class = "stuf ms-3 mt-4 mb-4">
                        <p class ="h2 fw-bold"> {{$user->username}} Details </p>
                        <p class ="h4"> Feel free to change any of your details right below! </p>
                    </div>
                    @if($errors->has('error'))
                        <div class="mb-4 alert alert-danger">
                            <ul class = "ps-0">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method = "POST" action = "{{route('updetails',['username' => $user->username])}}">
                        {{ csrf_field() }}
                        @method('PUT')
                    <div class = "forms d-flex">
                        <div>
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">First Name:</label>
                                <input type="text" class="" name = "firstname" value = "{{$user->firstname}}">
                            </div>
                            <div class = "input-box ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Last Name:</label>
                                <input type="text" class="" name = "lastname" value = "{{$user->lastname}}">
                            </div>
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Email:</label>
                                <input type="text" class="" name = "email" value = "{{$user->email}}">
                            </div>
                        </div>
                        <div class = "ms-5">
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Username:</label>
                                <input type="text" class="" name = "username" value = "{{$user->username}}">
                            </div>
                            <div class = "input-box  ms-3 mb-3">
                                <label for="html" class = "fw-bold ms-0">Address:</label>
                                <input type="text" class="" name = "address" value = "{{$user->address}}">
                            </div>
                            <div class = "input-box  ms-3 mb-4">
                                <label for="html" class = "fw-bold ms-0">Phone Number:</label>
                                <input type="text" class="" name = "phonenumber" value = "{{$user->phonenumber}}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="continue-button botao ps-0 ms-3 mb-4">
                            <input type="submit" class = "continue-button" value="Save Changes"/>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
