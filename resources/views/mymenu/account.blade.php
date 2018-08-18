@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs nav-justified">
                    <li role="presentation" class="{{ Request::is('mymenu/edit') ? 'active' : '' }}"><a href="{{ route('mymenu.edit','') }}">ピックアップ編集</a></li>
                    <li role="presentation" class="{{ Request::is('mymenu/profile') ? 'active' : '' }}"><a href="{{ route('mymenu.profile','') }}">プロフィール編集</a></li>
                    <li role="presentation" class="{{ Request::is('mymenu/password') ? 'active' : '' }}"><a href="{{ route('mymenu.password','') }}">パスワード変更</a></li>
                </ul>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <p><br></p>
                <div class="panel panel-default">
                    <div class="panel-heading">アカウント削除（退会）</div>
                    <div class="panel-body">
                        <p><br>
                            アカウント削除を行うと、全ての投稿および画像を削除し、ログアウトします。<br>
                            元に戻すことは出来ません。<br><br>
                            本当に削除してもよろしいですね？<br><br>
                        </p>
                        <div class="form-group">
                            {!! Form::model(Auth::user(), ['route' => ['users.update', Auth::id()], 'method' => 'put']) !!}
                                {!! Form::submit('アカウント削除（ボタンを押すと同時にアカウントを削除し、ログアウトします。）', ['class' => 'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                        
                        <div class="form-group">
                            <button onclick="history.back()">キャンセル</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
