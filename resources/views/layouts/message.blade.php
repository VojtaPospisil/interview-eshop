@if (Session::has('infoMessage'))

        <div class="alert alert-danger" role="alert">
            {{ Session::get('infoMessage') }}
            {{\App\Helpers\Helper::ForgetMessage('infoMessage')}}
        </div>

@endif

@if (Session::has('orderCompleted'))

    <div class="alert alert-success" role="alert">
        {{ Session::get('orderCompleted') }}
        {{\App\Helpers\Helper::ForgetMessage('orderCompleted')}}
    </div>

@endif
