@extends('layouts.app')

@section('content')
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <div class="cover out3">
        <div class="prof d-flex">
            @include('partials.adminside')
            <div class="outsideWrapper d-flex flex-column">
                <div class="outside">
                    <div class="spec d-flex flex-column ps-3 pe-3">
                        <div class="stuf mt-4 mb-4">
                            @if($errors->has('error'))
                                <div class="alert alert-danger mb-0 mt-4">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="d-flex query mt-4">
                                <p class="h3 fw-bold"> All Auctions </p>
                                <div class="search2">
                                    <div class="sbar2">
                                        <input type="text" id="searchbar2" name="search_query"
                                               placeholder="Search an auction...">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tableContainer">
                                <table class="table oview mt-4">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tablecontent">
                                    @foreach($auctions as $idx => $value)
                                        <div class="d-flex align-items-center">
                                            <tr>
                                                <th class="fw-bold">{{$auctions[$idx]["idauction"]}}</th>
                                                <td>
                                                    <span class="ms-2 fw-light">{{$auctions[$idx]["name"]}}</span>
                                                </td>
                                                <td class="mt-3">{{$auctions[$idx]["owner"]}}</td>
                                                <td>
                                                    <a href="{{route('auction',['id' => $auctions[$idx]["idauction"]])}}"
                                                       class="linkii"><i class="fa-solid fa-eye"></i></a>
                                                    <a href="{{route('edit',['id' => $auctions[$idx]["idauction"]])}}"
                                                       class="linkii"><i class="fa-solid fa-pencil"></i></a>
                                                    <a class="open-modal fw-bold linkii"
                                                       data-target="modal-{{($auctions[$idx]["idauction"])}}"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </div>
                                        <div id="modal-{{($auctions[$idx]["idauction"])}}" class="modal-window">
                                            <div class="d-flex">
                                                <h2>Delete Confirmation</h2>
                                                <button class="close modal-hide"><i class="fa-solid fa-x "></i></button>
                                            </div>
                                            <p class="rfix">This is a confirmation message to make sure you really want to
                                                <span class="fw-bold"> DELETE </span> the auction <span
                                                    class="fw-bold">{{$auctions[$idx]["name"]}}</span></p>
                                            <p class="rfix">If you do not wish to perform this action, just press close
                                                otherwise press the confirm button.</p>
                                            <div class="d-flex">
                                                <button class="modal-btn modal-hide cl">Close</button>
                                                <form action="{{route('deleteAuction',['id' => $auctions[$idx]["idauction"]])}}" method="post">
                                                    <input class="modal-btn cf ms-3" type="submit" value="Confirm"/>
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-fader"></div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let searchUser = document.querySelector('#searchbar2')
        searchUser.addEventListener("input", updateAdminAuction)
    </script>
@endsection
