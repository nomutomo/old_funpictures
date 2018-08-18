@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs nav-justified">
                    <li role="presentation" class="{{ Request::is('edit') ? 'active' : '' }}"><a href="{{ route('mymenu.edit','') }}">ピックアップ編集</a></li>
                    <li role="presentation" class="{{ Request::is('account') ? 'active' : '' }}"><a href="{{ route('mymenu.profile','') }}">プロフィール編集</a></li>
                    <li role="presentation" class="{{ Request::is('password') ? 'active' : '' }}"><a href="{{ route('mymenu.password','') }}">パスワード変更</a></li>
                </ul>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <p><br></p>
                <div class="panel panel-default">
                    <div class="panel-heading">パスワード変更</div>
                    <div class="panel-body">
                        {!! Form::model(Auth::user(), ['route' => ['users.update', Auth::id()], 'method' => 'put']) !!}
                            <div class="form-group">
                                {!! Form::label('password', '新パスワード') !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('password_confirmation', '新パスワード（確認）') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                            </div>
                            
                            {!! Form::hidden('name', Auth::user()->name) !!}
                            {!! Form::hidden('email', Auth::user()->email) !!}
                            {!! Form::hidden('profile', Auth::user()->profile) !!}
                            {!! Form::hidden('image_path', Auth::user()->image_path) !!}
                            {!! Form::hidden('page', 'パスワード') !!}
                            
                            {!! Form::submit('パスワード変更', ['class' => 'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        
@endsection
