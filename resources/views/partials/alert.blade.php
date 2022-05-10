@if (Session::has('info'))
    <div class="alert alert-info" role="alert">
        {{ Session::get('info') }}
        {{ Session::forget('info') }}
    </div>
@elseif (Session::has('info-danger'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('info-danger') }}
        {{ Session::forget('info-danger') }}
    </div>
@elseif (Session::has('info-warning'))
    <div class="alert alert-warning" role="alert">
        {{ Session::get('info-warning') }}
        {{ Session::forget('info-warning') }}
    </div>
@endif