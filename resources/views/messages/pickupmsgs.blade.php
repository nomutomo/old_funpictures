<div class="container">
    <div class="row">

    <?php
        $counter_s = 1
    ?>
    @foreach ($messages as $message)
        <?php
            $user = $message->user;
        ?>
        @for ($counter = $counter_s; $counter < $message->grid_no; $counter++)
            <div class="col-ms-4">
                <div class="media-left">
                    <p></p>
                </div>
                <div class="media-body">
                    <p></p>
                </div>
            </div>
            @if (($counter % 3) == 0)
                </div><div class="row">
            @endif
        @endfor
        @if ($counter == $message->grid_no)
            <div class="col-xs-4">
                <div class="media-left">
                    <img class="media-object img-rounded" src="{{ asset('storage/avatar/' . $user->id . '/' . $user->image_path) }}" height="25px" alt="">
                </div>
                <div class="media-body">
                    <p>{!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted"> - {{ $message->created_at }}</span></p>
                    @if (isset($message->image_path))
                        <p><img class="media-object img-rounded img-responsive" src="{{ asset('storage/avatar/' . $user->id . '/' . $message->image_path) }}" alt="avater"></p>
                    @endif
                    <P>{!! nl2br(e($message->content)) !!}</p>
                </div>
            </div>
            @if (($counter % 3) == 0)
                </div><div class="row">
            @endif
        @endif
        <?php
            $counter_s = $counter + 1
        ?>
    @endforeach
    
    @for ($counter = $counter_s; $counter <= 9; $counter++)
        <div class="col-xs-4">
            <div class="media-left">
                    <p></p>
            </div>
            <div class="media-body">
                    <p></p>
            </div>
        </div>
        @if (($counter % 3) == 0)
            </div><div class="row">
        @endif
    @endfor
    </div>
</div>