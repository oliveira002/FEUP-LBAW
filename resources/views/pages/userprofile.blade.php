@extends('layouts.app')

@section('content')
    <link href="{{asset('css/profile.css')}}" rel="stylesheet">
    <div class = "cover out1">
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
                        <img src= "{{$path}}" width="120" height="120" alt='User Image'>
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
                    @if(Auth::guard('admin')->check())
                    <li>
                        <a href="{{route('editusers',['username' => $user->username])}}"><button class = "fw-bold">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit User</button>
                        </a>
                    </li>
                    @endif
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
                        <p class ="h2 fw-bold"> Overview </p>
                        <p class ="h4"> Check information on the user! </p>
                    </div>
                    <div class = "ms-3">
                        @if($errors->has('error'))
                            <div class="alert alert-danger mb-4 mt-2">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class = "d-flex">
                            <div class="mb-4 lg">
                                <img src= "{{$path}}" width="200" height="200" alt='User Image'>
                            </div>
                            <div class = "ms-4 mt-3">
                                <p class = "mt-3 mb-2 ms-3 h4 fw-bold">{{$user->firstname}} {{$user->lastname}}</p>
                                <p class = "mb-2 ms-3 h5 mt-4">Rating</p>
                                <?php
                                    $own = \App\Models\AuctionOwner::find($user->idclient);
                                    if(!is_null($own)) {
                                        if((string) $own->rating === "") {
                                            $rating = "0";
                                        }
                                        else {
                                            $rating = $own->rating;
                                        }
                                    }
                                    else {
                                        $rating = "0";
                                    }
                                ?>
                                <p class = "mb-3 ms-3 h3 cor ">{{$rating}}</p>
                                <a class = "text-center rep ms-3">
                                    <button class="open-modal fw-bold" data-target="modal-1">
                                        Review User
                                    </button>
                                </a>
                                <a class = "text-center rep ms-3">
                                    <button class="open-modal fw-bold" data-target="modal-2">
                                        Report User <i class="fa-regular fa-thumbs-down"> </i>
                                    </button>
                                </a>
                                <div id="modal-1" class="modal-window bab">
                                    <form id="myform" method="post" action="{{route('createReview',['id' => $user->username])}}">
                                        {{ csrf_field() }}
                                        <div class = "d-flex">
                                            <h4>How would you rate your experience?</h4>
                                            <button class = "close modal-hide mt-2 xau"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <div class>
                                            <div class = "rates d-flex">
                                                <fieldset class="rating">
                                                    <input type="radio" id="star5" name="rating" value="5"/><label for="star5" class="full" title="Very Good"></label>
                                                    <input type="radio" id="star4" name="rating" value="4"/><label for="star4" class="full" title="Good"> </label>
                                                    <input type="radio" id="star3" name="rating" value="3" checked/><label for="star3" class="full" title="Average"></label>
                                                    <input type="radio" id="star2" name="rating" value="2"/><label for="star2" class="full" title="Bad"> </label>
                                                    <input type="radio" id="star1" name="rating" value="1"/><label for="star1" class="full" title="Awful"></label>
                                                </fieldset>
                                            </div>
                                            <div class = "subt d-flex">
                                                <p class = "h5 mb-3" id="rating-value">Average Experience 😑</p>
                                            </div>
                                            <div>
                                                <div class="input-box">
                                                    <textarea class = "txtt2" id="desc" name="desc" placeholder="Describe your experience or just simple rate the seller!" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
                                            <input type="submit" form="myform" class="modal-btn cf ms-3"  value="Submit"/>
                                        </div>
                                    </form>
                                </div>
                                <div id="modal-2" class="modal-window bab">
                                    <form id="myform2" method="post" action="{{route('createSellerReport',['id' => $user->username])}}">
                                        {{ csrf_field() }}
                                        <div class = "d-flex">
                                            <h4>Why do you want to report this user?</h4>
                                            <button class = "close modal-hide mt-2 xau"><i class="fa-solid fa-x "></i></button>
                                        </div>
                                        <div>
                                            <div class = "mt-3">
                                                <div class="input-box">
                                                    <textarea class = "txtt2" id="desc" name="desc" placeholder="Write the motive for reporting this user..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "d-flex">
                                            <button class="modal-btn modal-hide cl">Close</button>
                                            <input type="submit" form="myform2" class="modal-btn cf ms-3"  value="Submit"/>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-fader"></div>
                            </div>
                        </div>
                        <div class = "d-flex">
                            <div class = "d-flex fii high">
                                <i class="fa-solid fa-user h5"></i>
                                <button class = "mb-2 ms-2 h5" onclick="alo();">About</button>
                            </div>
                            <div class = "d-flex ms-5 fii">
                                <i class=" fa-solid fa-house-user h5"></i>
                                <button class = "mb-2 ms-2 h5" onclick="alo();">Auctions</button>
                            </div>
                        </div>
                        <hr class = "mt-0 mb-3">
                        <div class = "about">
                            <span class = "cor2 h4"> Contact Information </span>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Name: </span>
                                <span class = "h5 ms-2"> {{$user->firstname}} {{$user->lastname}} </span>
                            </div>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Address: </span>
                                <span class = "h5  ms-2"> {{$user->address}}</span>
                            </div>
                            <div class = "d-flex mt-3">
                                <span class = "h5 fw-bold"> Email: </span>
                                <span class = "h5  ms-2"> {{$user->email}}</span>
                            </div>
                            <div class = "d-flex mt-3 mb-5">
                                <span class = "h5 fw-bold"> Phone Number: </span>
                                <span class = "h5 ms-2"> {{$user->phonenumber}}</span>
                            </div>
                        </div>
                        <div class = "auctions mb-4">
                            <span class = "cor2 h4 mb-5"> Owned Auctions </span>
                            @if(count($auctions)==0)
                                <div>This user has no active auctions.</div>
                            @else
                                @foreach($auctions as $auct)
                                    <div class = "d-flex mt-2 mb-5 centro">
                                        <a href = "{{route('auction',['id' => $auct->idauction])}}"> <img class ="endimg img-fluid" width="193" height="230" src= "/images/{{$auct->idauction}}/1.jpg" alt='Auction Image'> </a>
                                        <div class ="mb-4">
                                            <div>
                                                <p class = "h5 ms-4 mt-2 cor2 fw-bold mb-0"> Auction Name:</p>
                                                <p class = "h5 ms-4 mt-0"> {{$auct->name}}</p>
                                            </div>
                                            <div>
                                                <p class = "h5 ms-4 mt-3 cor2 fw-bold"> Price:</p>
                                                <p class = "h5 ms-4 mt-0"> {{$auct->currentprice}}€</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

