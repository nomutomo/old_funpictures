@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs nav-justified">
                    <li role="presentation" class=""><a href="#">ピックアップ編集</a></li>
                    <li role="presentation" class="{{ Request::is('profile') ? 'active' : '' }}"><a href="{{ route('mymenu.profile','') }}">プロフィール編集</a></li>
                    <li role="presentation" class="{{ Request::is('password') ? 'active' : '' }}"><a href="{{ route('mymenu.password','') }}">パスワード変更</a></li>
                </ul>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <p><br></p>
                <div class="panel panel-default">
                    <div class="panel-heading">プロフィール変更</div>
                    <div class="panel-body">
                        {!! Form::model(Auth::user(), ['route' => ['users.update', Auth::id()], 'method' => 'put']) !!}
                        
                            <div class="form-group">
                                {!! Form::label('image_path', 'プロフィール画像') !!}
                                {!! Form::text('image_path', old('image_path'), ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('name', '名前') !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('email', 'メールアドレス') !!}
                                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('profile', 'プロフィール') !!}
                                {!! Form::text('profile', old('profile'), ['class' => 'form-control']) !!}
                            </div>
                            
                            {!! Form::hidden('password', Auth::user()->password) !!}
                            {!! Form::hidden('page', 'プロフィール') !!}
                            
                            {!! Form::submit('プロフィール変更', ['class' => 'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <p><br></p>
                {!! link_to_route('mymenu.account', 'アカウント削除（退会）はこちら') !!}
            </div>
        </div>
        
@endsection
