@extends('layouts.app')

@section('content')
    <div class="FaqWrapper">
        <div class="accordion" id="accordionFAQ">
            <?php $id = 0; ?>
            @foreach($faqs as $faq)
                <div class="accordion-item caixaFaq">
                    <h2 class="accordion-header" id="<?php echo "heading".$id;?>">
                        <button class="accordion-button collapsed caixaFaq" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo "collapse".$id;?>" aria-expanded="false" aria-controls="<?php echo "collapse".$id;?>">
                            <strong><?php echo $faq?></strong>
                        </button>
                    </h2>
                    <div id="<?php echo "collapse".$id;?>" class="accordion-collapse collapse" aria-labelledby="<?php echo "heading".$id;?>" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body caixaFaq">
                            <?php echo $faqs_text[$id] ?>
                        </div>
                    </div>
                </div>
                <?php $id++?>
            @endforeach
        </div>
    </div>
@endsection
