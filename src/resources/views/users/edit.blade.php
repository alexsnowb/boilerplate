@extends('boilerplate::layout.index', [
    'title' => __('boilerplate::users.title'),
    'subtitle' => __('boilerplate::users.edit.title'),
    'breadcrumb' => [
        __('boilerplate::users.title') => 'boilerplate.users.index',
        __('boilerplate::users.edit.title')
    ]
])

@section('content')
    {{ Form::open(['route' => ['boilerplate.users.update', $user->id], 'method' => 'put', 'autocomplete' => 'off']) }}
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("boilerplate.users.index") }}" class="btn btn-default" data-toggle="tooltip" title="@lang('boilerplate::users.returntolist')">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        @lang('boilerplate::users.save')
                    </button>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @component('boilerplate::card', ['title' => __('boilerplate::users.informations')])
                    @if(Auth::user()->id !== $user->id)
                        @component('boilerplate::select2', ['name' => 'active', 'label' => 'boilerplate::users.status', 'minimum-results-for-search' => '-1'])
                            <option value="1" @if (old('active', $user->active) == '1') selected="selected" @endif>@lang('boilerplate::users.active')</option>
                            <option value="0" @if (old('active', $user->active) == '0') selected="selected" @endif>@lang('boilerplate::users.inactive')</option>
                        @endcomponent
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            @component('boilerplate::input', ['name' => 'first_name', 'label' => 'boilerplate::users.firstname', 'value' => $user->first_name])@endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('boilerplate::input', ['name' => 'last_name', 'label' => 'boilerplate::users.lastname', 'value' => $user->last_name])@endcomponent
                        </div>
                    </div>
                        @component('boilerplate::input', ['name' => 'email', 'label' => 'boilerplate::users.email', 'value' => $user->email])@endcomponent
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('boilerplate::card', ['color' => 'teal', 'title' =>__('boilerplate::users.roles')])
                    <table class="table table-sm table-hover">
                        @foreach($roles as $role)
                            @if($role->name !== 'admin' || ($role->name === 'admin' && Auth::user()->hasRole('admin')))
                            <tr>
                                <td style="width:25px">
                                    <div class="icheck-primary">
                                    @if(Auth::user()->id === $user->id && $role->name === 'admin' && Auth::user()->hasRole('admin'))
                                        {{ Form::checkbox('roles['.$role->id.']', 1, old('roles['.$role->id.']', $user->hasRole($role->name)), ['id' => 'role_'.$role->id, 'class' => 'icheck', 'checked', 'disabled']) }}
                                        {!! Form::hidden('roles['.$role->id.']', '1', ['id' => 'role_'.$role->id]) !!}
                                    @else
                                        {{ Form::checkbox('roles['.$role->id.']', 1, old('roles['.$role->id.']', $user->hasRole($role->name)), ['id' => 'role_'.$role->id, 'class' => 'icheck']) }}
                                    @endif
                                        <label for="{{ 'role_'.$role->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    {{ Form::label('role_'.$role->id, $role->display_name, ['class' => 'mbn']) }}<br />
                                    <span class="small">{{ $role->description }}</span><br />
                                    <span class="small text-muted">{{ $role->permissions->implode('display_name', ', ') }}</span>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                @endcomponent
            </div>
        </div>
    {{ Form::close() }}
@endsection