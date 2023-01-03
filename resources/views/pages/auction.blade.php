@extends('layouts.app')

<?php
    $day = $auction->enddate->format('d');
    $month = $auction->enddate->format('F');
    $hour = $auction->enddate->format('G');
    $mins = $auction->enddate->format('i');
    $monthstr = $auction->enddate->format('M');
    $year = $auction->enddate->format('Y');
    $secs = $auction->enddate->format('s');
    if($hour / 10 < 0) {
        $hour = "0" . $hour;
    }
    $finalStr = $monthstr.  " " .  $day. "," . " "  . $year . " " . $hour.":".$mins.":".$secs;
    $minBid = 0.05 * $auction->startingprice;
    $minBid = " " . ($minBid + $auction->currentprice);
?>



@section('content')
        <div class = "hidden" id = "datat" style = "display: none">{{$finalStr}}</div>
        <div class = "page">
            <div class = "d-flex">
                <div class = "text-center">
                    <!- show Images here ->
                    <?php

                    $directory =  "images/" . $auction->idauction . "/";
                    $images = glob($directory . "/*.jpg");
                    $imagescount = 0;
                    $files= glob($directory . "/*.jpg");
                    if($files){
                        $imagescount = count($files);
                    }
                    ?>
                    <section aria-label="Images" class="foto">
                        <div class="slideshow" data-slideshow>
                            @if($imagescount > 1)
                                <div class="buttons">
                                    <button class="slideshow-button prev" data-slideshow-button="prev">
                                        <i class="fa-solid fa-angles-left"></i>
                                    </button>
                                    <button class="next ms-5 slideshow-button " data-slideshow-button="next">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </button>
                                </div>
                            @endif

                            <ul data-slides>
                                <?php
                                    if($imagescount==1){
                                        echo "<li class='slide'>";

                                        echo "<div class='foto'>";
                                        echo "<img src='../images/{$auction->idauction}/1.jpg' alt='Image 1' class ='fds img-fluid' alt='Auction Image'/>";
                                        echo "</div>";
                                        echo "</li>";

                                    }
                                    else{
                                        for($i = 1; $i <= $imagescount; $i++) {
                                            if($i == 1) {
                                                echo "<li class='slide' data-active>";
                                            } else {
                                                echo "<li class='slide' hidden>";
                                            }
                                            echo "<div class='foto'>";
                                            echo "<img src='../images/{$auction->idauction}/$i.jpg' alt='Image $i' class ='fds img-fluid' alt='Auction Image'/>";
                                            echo "</div>";
                                            echo "</li>";
                                        }
                                    }
                                    ?>

                            </ul>
                        </div>
                    </section>
                    <div>

                    </div>
                </div>
                <div class = "texto ms-5">
                    <div class = "ola d-flex">
                        <p class = "h3 fw-bold me-3"> {{$auction->name}}</p>
                        @if(Auth::id()==$auction->idowner || Auth::guard('admin')->check())
                            <div id="edit-auc"><a href="{{route('edit',['id' => $auction->idauction])}}"><i class="fa-solid fa-pencil"></i><u id="edit-auc-text">Edit auction</u></a></div>
                            <div id="delete-auc"><button class="open-modal" data-target="modal-2"><i class="fa-solid fa-trash"></i><u id="delete-auc-text">Delete auction</u></button></div>
                            <div id="modal-2" class="modal-window">
                                <div class = "d-flex">
                                    <h2>Deletion Confirmation</h2>
                                    <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                                </div>
                                <p class = "rfix">This is a confirmation message to make sure you really want to delete this auction: <span class= "fw-bold h5">{{$auction->name}}</span> </p>
                                <p class = "rfix">If you do not wish to delete, just press close, otherwise, press the confirm button.</p>
                                <div class = "d-flex">
                                    <button class="modal-btn modal-hide cl">Close</button>
                                    <form action="{{route('deleteAuction',['id' => $auction->idauction])}}" method="post">
                                        <input class="modal-btn cf ms-3" type="submit" value="Confirm" />
                                        @method('delete')
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <div class="modal-fader"></div>
                        @endif
                    </div>
                    <p id = "ini" class = "h5 pb-2"> Current Bid: <span id = "pl" class = "h4 pb-2">{{$auction->currentprice}}€</span> </p>
                    <div class = "caixa mb-4">
                        <div class ="ms-3">
                            @if($auction->isover)
                             <p class = "h2 fw-bold pt-3 pb-3 defl"> Auction Expired! </p>
                             <?php
                                $nobids = 1;
                                if(!is_null($bids->last())) {
                                    $iduser = $bids->last()->idclient;
                                    $user = \App\Models\User::find($iduser);
                                    $nobids = 0;
                                }

                             ?>
                             <div class = "pb-4">
                                @if($nobids)
                                    <p class = "h5 me-2"> There were no bids in the auction. </p>
                                @else
                             <p class = "h5 me-2"> Auction Won by: <span class = "fw-bold h5">{{$user->firstname}} {{$user->lastname}} </span></p>
                             <p class = "h5 me-2"> Winning Bid Price: <span class = "fw-bold h5"> {{$bids->last()->price}}€ </span> </p>
                             <p class = "h5 me-2"> Winning Bid Date: <span class = "fw-bold h5"> {{$bids->last()->biddate}} </span> </p>
                             @endif
                             </div>

                            @else
                            <p class = "h5 fw-bold pt-4 pb-2 defl"> Time Left: </p>
                            <div class = "d-flex pt-2 pb-2">
                                <p class = "h5 me-2" id = "expired"> </p>
                                <div class="opt2">
                                    <span id = "day" class = "h4 me-2 fw-bold">  </span>
                                    <p class = "h5 me-2 dia"> Days </p>
                                </div>
                                <div class="opt2">
                                    <span id = "hour" class = "h4 me-2 fw-bold">  </span>
                                    <p class = "h5 me-2 dia"> Hours </p>
                                </div>
                                <div class="opt2">
                                    <span id = "minute" class = "h4 me-2 fw-bold">  </span>
                                    <p class = "h5 me-2 dia"> Minutes </p>
                                </div>
                                <div class="opt2">
                                    <span id = "second" class = "h4 me-2 fw-bold">  </span>
                                    <p class = "h5 me-2 dia"> Seconds </p>
                                </div>
                            </div>
                            <p class = "h5 fw-bold pt-2 pb-2 defl"> Auction Ends: </p>
                            <p class = "h5 me-2 pb-4"> {{$auction->enddate}} </p>
                            @endif
                        </div>
                    </div>
                    <div class = "caixa2 mb-2">
                        <div class ="ms-3">
                            <p class = "h5 fw-bold pt-2"> There is a minimum increase of 5% for each bid. </p>
                            <div class = "d-flex">
                                <p id = "nr" class = "h5 pb-2"> The minimum bid amount right now is <span id = "pp" class = "h4 pb-2">{{$minBid}}€</span> </p>
                            </div>
                        </div>
                    </div>
                        @if($errors->has('error'))
                            <div class="alert alert-danger mb-0 mt-4">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div>
                        <p class = "h5 fw-bold pt-3 defl"> Your Bid: </p>
                        <form id="myform" method="post" action="{{route('addbid',['id' => $auction->idauction])}}">
                            {{ csrf_field() }}
                            <input type="float" class= "inpt p-1" placeholder="{{$minBid}}" value = "{{$minBid}}" name="amount" min= "{{$minBid}}">
                        </form>
                        <div class = "mt-3">
                            <a class = "bidbtn text-center">
                                <button class="open-modal fw-bold" data-target="modal-1">
                                    Bid Now
                                </button>
                            </a>
                            <div id="modal-1" class="modal-window">
                                <div class = "d-flex">
                                    <h2>Bid Confirmation</h2>
                                    <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                                </div>
                                <p class = "rfix">This is a confirmation message to make sure you really want to bid on the auction <span class= "fw-bold h5">{{$auction->name}}</span> </p>
                                <p class = "rfix">If you do not wish to bid, just press close otherwise press the confirm button.</p>
                                <div class = "d-flex">
                                    <button class="modal-btn modal-hide cl">Close</button>
                                    <input type="submit" form="myform" class="modal-btn cf ms-3"  value="Confirm"/>
                                </div>
                            </div>
                            <div class="modal-fader"></div>
                        </div>
                        <div class = "fav d-flex mt-4">
                            <div class = "me-4 hov">
                                <i class="fa-solid fa-user-tag"></i>
                                <a href="{{route('profile',['username' =>$owner->username])}}" class = "pop"> Seller Profile </a>
                            </div>
                            <div class = "me-4 hov">

                            <button id="favbtn" idauction="{{$auction->idauction}}">
                                @if(Auth::guard('admin')->check())
                                @else
                                    @if($isfavorite)
                                        <i class="fa-solid fa-star" id="favorite"></i>
                                        <a class = "pop" id="favtext"> Remove from Favourites </a>
                                    @else
                                        <i class="fa-regular fa-star" id="favorite"></i>
                                        <a class = "pop" id="favtext"> Add to Favourites </a>
                                    @endif
                                @endif


                            </button>

                            </div>

                            <div class = "me-4 hov">


                                    <button class="open-modal" data-target="modal-3">
                                        <i class="fa-solid fa-coins"></i>
                                        <a>Bidding History</a>
                                    </button>
                                </a>
                            </div>
                            <div class = "me-4 hov">

                                    <button class="open-modal" data-target="modal-4">
                                        <i class="fa-solid fa-flag"></i>
                                        <a>Report Auction</a>
                                    </button>

                            </div>
                        </div>
                        <div id="modal-3" class="modal-window">
                            <div class = "d-flex">
                                <h2>Bidding History</h2>
                                <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                            </div>
                            <div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bids as $bid)
                                    <div>
                                        <tr>
                                            <th>{{$bid->idbid}}</th>
                                            <td> {{$bid->biddate}}</td>
                                            <td>{{$bid->price}}€</td>
                                        </tr>
                                    </div>
                                @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class = "d-flex">
                                <button class="modal-btn modal-hide cl">Close</button>
                            </div>
                        </div>
                        <div id="modal-4" class="modal-window bab">
                            <form id="myform4" method="post" action="{{route('createAuctionReport',['id' => $auction->idauction])}}">
                                {{ csrf_field() }}
                                <div class = "d-flex">
                                    <h4>Why do you want to report this auction?</h4>
                                    <button class = "close modal-hide ms-2 mt-1 xau"><i class="fa-solid fa-x "></i></button>
                                </div>
                                <div>
                                    <div class = "mt-3">
                                        <div class="input-box">
                                            <textarea class = "txtt" id="desc" name="desc" placeholder="Write the motive for reporting this auction..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class = "d-flex">
                                    <button class="modal-btn modal-hide cl">Close</button>
                                    <input type="submit" form="myform4" class="modal-btn cf ms-3"  value="Submit"/>
                                </div>
                            </form>
                        </div>
                        <hr class = "mt-3 mb-3">
                        <div class = "d-flex">
                            <span class = "fw-bold"> Auction Owner: </span>
                            <span class = "ms-2"> {{$owner->firstname}} {{$owner->lastname}}</span>
                        </div>
                        <?php
                            $var = \App\Models\AuctionOwner::where('idclient', $auction->idowner)->first()->rating;
                        ?>
                        <div class = "d-flex">
                            <span class = "fw-bold"> Rating: </span>
                            <span class = "ms-2"> {{$var}} </span>
                        </div>
                        <div class = "d-flex">
                            <span class = "fw-bold"> Category: </span>
                            <span class = "ms-2"> {{$category->name}} </span>
                        </div>
                        <div class = "d-flex but">
                            <div>
                                <span class = "fw-bold"> Initial Price: </span>
                            </div>
                            <span class = "ms-2 dtls"> {{$auction->startingprice}}€</span>
                        </div>
                        <div class = "d-flex but">
                            <div>
                                <span class = "fw-bold"> Description: </span>
                            </div>
                            <span class = "ms-2 dtls"> {{$auction->description}}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection
