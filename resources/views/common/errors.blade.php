@if (count($errors))
    <div class="alert alert-danger">
        @lang('messages.something_went_wrong')
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('messages'))
    <div class="alert alert-danger">
        {{ Session::get('messages') }}
    </div>
@endif
