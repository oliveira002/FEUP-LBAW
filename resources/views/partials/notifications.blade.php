<div class="notlist escondido" id = "notifs">
    <ul>
        <li>
            <div class="d-flex init">
                <span class="fw-bold h5"> Notifications </span>
                <button class="mais">
                    <i class="fa-solid fa-gear"></i>
                </button>
            </div>
        </li>
        <?php
            $counter = 1;
            ?>
        @if(is_null($notifications))
            <li>
                <span class="h6 fw-bold me-2"> {{$counter}}</span>
                No notifications
            </li>
        @else
        @foreach($notifications as $notif)
            <li>
                <span class="h6 fw-bold me-2"> {{$counter}}</span>
                {{$notif->content}}
                <button class="ms-3">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </li>
            <?php $counter = $counter + 1?>
        @endforeach
        @endif
    </ul>
</div>
