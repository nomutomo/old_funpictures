<?php
    $counter_s = 1
?>
<div class="col-xs-11 col-xs-offset-1">
    @if (count($pickups) > 0 )
        @foreach ($pickups as $pickup)
            <?php
                $user = $pickup->user;
            ?>
            @for ($counter = $counter_s; $counter < $pickup->grid_no; $counter++)
                <ul id="sortable3" class="media-list droptrue col-xs-3">
                </ul>
                @if (($counter % 3) == 0)
                    </div><div class="col-xs-11 col-xs-offset-1">
                @endif
            @endfor
            @if ($counter == $pickup->grid_no)
                <ul id="sortable3" class="media-list droptrue col-xs-3">
                    <li class="media">
                        <div class="media-left">
                            {!! $counter !!}<img class="media-object img-rounded" src="{{ asset('storage/avatar/' . $user->id . '/' . $user->image_path) }}" height="25px" alt="">
                        </div>
                        <div class="media-body">
                            <div>
                                {!! $user->name !!} <span class="text-muted"> - {{ $pickup->created_at }}</span>
                            </div>
                            <div>
                                @if (isset($pickup->image_path))
                                    <p><img class="media-object img-rounded img-responsive" src="{{ asset('storage/avatar/' . $user->id . '/' . $pickup->image_path) }}" alt=""></p>
                                @endif
                                <p>{!! nl2br(e($pickup->content)) !!}</p>
                            </div>
                        </div>
                    </li>
                </ul>
                @if (($counter % 3) == 0)
                    </div><div class="col-xs-11 col-xs-offset-1">
                @endif
            @endif
            <?php
                $counter_s = $counter + 1
            ?>
        @endforeach
    @endif
    
    @for ($counter = $counter_s; $counter <= 9; $counter++)
        <ul id="sortable3" class="media-center droptrue col-xs-3">
        </ul>
        @if (($counter % 3) == 0)
            </div><div class="col-xs-11 col-xs-offset-1">
        @endif
    @endfor
</div>
{!! $pickups->render() !!}
