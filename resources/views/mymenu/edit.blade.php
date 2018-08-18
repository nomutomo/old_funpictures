@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('edit') ? 'active' : '' }}"><a href="{{ route('mymenu.edit','') }}">ピックアップ編集</a></li>
                <li role="presentation" class="{{ Request::is('profile') ? 'active' : '' }}"><a href="{{ route('mymenu.profile','') }}">プロフィール編集</a></li>
                <li role="presentation" class="{{ Request::is('password') ? 'active' : '' }}"><a href="{{ route('mymenu.password','') }}">パスワード変更</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <br style="clear:both">
            <p>■ 投稿一覧
            @if (count($messages) > 0)
                @include('messages.edit_msgs', ['messages' => $messages])
            @endif
        </div>
        <div class="col-xs-9">
            <br>
            <p>■ピックアップ編集欄<br>
            <ol>
                <li>投稿一覧の投稿を、ピックアップ編集欄のお好きなボックスへ、ドラッグ＆ドロップで移動してください。</li>
                <li>グレー色のボックス１つにつき、１つの投稿を入れてください。</li>
                <li>１つのブロックに、２つ以上の投稿は入りません。（保存されません。）</li>
                <li>ピックアップ投稿を保存するには、「保存」ボタンを押してください。</li>
            </ol>
            </p>
            @include('messages.edit_pickups', ['messages' => $pickups])
            <div class="col-xs-3 col-xs-offset-4">
                <button type="button" class="btn btn-primary btn-block">保存</button>
            </div>
        </div>
    </div>
            
@endsection
