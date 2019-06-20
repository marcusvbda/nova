@extends('custom.layouts.auth')
<div class="mx-auto py-8 max-w-sm text-center text-90">
    {{-- @include('nova::auth.partials.logo') --}}
    <img src="{{asset('imgs/logo.png')}}" style="width: 150px;"/>
    
</div>

@section("content")
<form
    id="app"
    class="bg-white shadow rounded-lg p-8 max-w-login mx-auto"
    method="POST"
    action="{{route('custom.tenants.set.submit')}}"
>
    {{ csrf_field() }}
    <h2 class="text-2xl text-center font-normal mb-6 text-90">
        {{__("Select the tenant you want to access")}}
    </h2>

    @if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('tenant'))
            {{ $errors->first('tenant') }}
        @endif
    </p>
    @endif
    
    
    <div class="mb-6 {{ $errors->has('tenant') ? ' has-error' : '' }}">
        
        <select-tenant
            label="{{ ucfirst(__('tenants')) }}"
            name="tenant"
            id="id"
            value="{{ old('tenant') }}" 
            autofocus
            required
            placeholder="{{__('Select one option')}}"
            route="{{route('custom.tenants.get.options')}}"
            ref="select"
            btntext={{ __('Continue') }}
        >
        </select-tenant>
    </div>

    
</form>
@endsection
