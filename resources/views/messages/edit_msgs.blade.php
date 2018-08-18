<ul id="sortable1" class="media-list droptrue col-xs-12">
    @foreach ($messages as $message)
        <?php $user = $message->user; ?>
        <li class="media">
            <div class="media-left">
                <img class="media-object img-rounded" src="http://23441cd9965b41c18eade1246bcc714b.vfs.cloud9.us-east-1.amazonaws.com/storage/avatar/1/P6Sq6EjWYtT6Ulk2br9VmyBRJmU3MT2Cr2lPxUVS.jpeg" height="25px" alt="">
            </div>
            <div class="media-body">
                <div>
                    {!! $user->name !!} <span class="text-muted"> - {{ $message->created_at }}</span>
                </div>
                <div>
                    @if (isset($message->image_path))
                        <p><img class="media-object img-rounded img-responsive" src="{{ asset('storage/avatar/' . $user->id . '/' . $message->image_path) }}" alt="avater"></p>
                    @endif
                    <p>{!! nl2br(e($message->content)) !!}</p>
                </div>
            </div>
        </li>
    @endforeach
</ul>
<ul class="col-xs-12">
    {!! $messages->render() !!}
</ul>