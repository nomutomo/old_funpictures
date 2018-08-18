@if (count($users) > 0)

    <ul class="media-list">
        @foreach ($users as $user)
            <li class="media">
                <div class="media-left">
                    <img class="media-object img-rounded" src="{{ asset('storage/avatar/' . $user->id . '/' . $user->image_path) }}" width="100px" alt="">
                    @include('user_follow.follow_button', ['user' => $user])
                </div>
                <div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!}
                    </div>
                    <div>
                        <p>{!! nl2br(e($user->profile)) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {!! $users->render() !!}
    
@endif
