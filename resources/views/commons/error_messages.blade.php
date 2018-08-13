@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning">{{ $error }}</div>
    @endforeach
@elseif (session()->has('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
@endif
