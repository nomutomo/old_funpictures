@if (count($users) > 0)

    <ul class="media-list">
        @foreach ($users as $user)
            <li class="media">
                <div class="media-left">
                    <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
                    @include('user_follow.follow_button', ['user' => $user])
                </div>
                <div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!}
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {!! $users->render() !!}
    
@endif
