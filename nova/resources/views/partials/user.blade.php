<dropdown-trigger class="h-9 flex items-center" slot-scope="{toggle}" :handle-click="toggle">
    
        @if(@getimagesize(asset('storage/'.$user->photo)))
            <img
                src="{{asset('storage/'.$user->photo)}}"
                class="rounded-full w-8 h-8 mr-3"
            />
        @else 
            @isset($user->email)
            <img
                src="https://secure.gravatar.com/avatar/{{ md5($user->email) }}?size=512"
                class="rounded-full w-8 h-8 mr-3"
            />
            @endif
        @endif

    <span class="text-90">
        {{ $user->name ?? $user->email ?? __('Nova User') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            @if(Auth::user()->tenants()->count()>1)
                <a href="{{ route('custom.tenants.set') }}" class="block no-underline text-90 hover:bg-30 p-3">
                    {{ __('Change Tenant') }}
                </a>
            @endif
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
