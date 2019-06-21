<?php view()->addNamespace('nova', base_path()."\\nova\\resources\\views");?>
<link rel="stylesheet" href="{{ mix('custom/css/app.css')}}">
@extends('nova::auth.layout')
@section("content")
@include('nova::auth.partials.header')
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
    <svg class="block mx-auto mb-6" xmlns="http://www.w3.org/2000/svg" width="100" height="2" viewBox="0 0 100 2">
        <g id="Page-1" fill="none" fill-rule="evenodd">
            <g id="08-login" fill="#D8E3EC" transform="translate(-650 -371)">
                <path id="Rectangle-15" d="M650 371h100v2H650z"></path>
            </g>
        </g>
    </svg>
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
        <div class="mb-6">
            <a class="text-primary dim font-bold no-underline" href="{{route('nova.logout')}}">
                 {{__('Go back to login')}}
            </a>
        </div>
    </div>

    
</form>
<script src="{{URL::asset('custom/js/app.js')}}"></script>
@endsection
