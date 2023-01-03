@extends('layouts.app')

@section('content')
    <div class="d-flex globalWrapper">
        <div id="aboutUsGlobal">
            <div id="meetTheTeam"><h1>Meet the team</h1></div>
            <div class="d-flex aboutUsWrapper">
                <div class="d-flex aboutUsPerson">
                    <img class="aboutUsImg" src="images/aboutus/diogobabo.jpg" alt="Diogo Babo">
                    <div class="aboutUsName">Diogo B.</div>
                </div>
                <div class="d-flex aboutUsPerson">
                    <img class="aboutUsImg" src="images/aboutus/gustavocosta.png" alt="Gustavo Costa">
                    <div class="aboutUsName">Gustavo C.</div>
                </div>
                <div class="d-flex aboutUsPerson">
                    <img class="aboutUsImg" src="images/aboutus/joaooliveira.jpg" alt="João Oliveira">
                    <div class="aboutUsName">João O.</div>
                </div>
                <div class="d-flex aboutUsPerson">
                    <img class="aboutUsImg" src="images/aboutus/ricardocavalheiro.jpg" alt="Ricardo Cavalheiro">
                    <div class="aboutUsName">Ricardo C.</div>
                </div>
            </div>
            <div class="aboutUsTextWrapper">
                <div class="aboutUsText"><h5>WeBid is an online auction platform built by 4 LEIC (FEUP) students for the LBAW course 22/23 edition.</h5></div>
                <div class="aboutUsText"><h5>It was built using the Bootstrap and Laravel frameworks for front-end and back-end web development, respectively.</h5></div>
                <div class="aboutUsText"><h5>The group had to go through many stages of development to get to this final product, from requirements engineering to building the website, without forgetting database planning.</h5></div>
                <div class="aboutUsText"><h5>This was by far one of our favourite projects to work on, something that cemented our passion for web dev.</h5></div>
            </div>
        </div>
    </div>
@endsection
