@extends('layouts.app')

@section('content')
    <div id="FAQs">
        <?php $id = 0; ?>
        @foreach($faqs as $faq)
            <div id=<?php echo $id; $id++ ?>>
                    <?php echo $faq ?>
            </div>
        @endforeach
    </div>

@endsection
