@if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        {{ $message }}
    </div>
@endif

@if($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        {{ $message }}
    </div>
@endif
