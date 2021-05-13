@extends('boilerplate::auth.layout', [
    'title' => __('boilerplate::auth.firstlogin.title'),
    'bodyClass' => 'hold-transition login-page'
])

@section('content')
    @component('boilerplate::auth.loginbox')
        {{ Form::open(['route' => 'boilerplate.users.firstlogin', 'autocomplete' => 'off']) }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="alert alert-info">
            @lang('boilerplate::auth.firstlogin.intro')
        </div>
        @component('boilerplate::input', ['name' => 'password', 'placeholder' => 'boilerplate::auth.fields.password', 'append-text' => 'fas fa-lock', 'type' => 'password', 'autofocus' => true])@endcomponent
        @component('boilerplate::input', ['name' => 'password_confirmation', 'placeholder' => 'boilerplate::auth.fields.password_confirm', 'append-text' => 'fas fa-lock', 'type' => 'password'])@endcomponent
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">@lang('boilerplate::auth.firstlogin.button')</button>
        </div>
        </form>
    @endcomponent
@endsection
