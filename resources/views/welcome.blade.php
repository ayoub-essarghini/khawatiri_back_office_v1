<h1>
    Welcome page
</h1>
@auth
@if (Auth::user()->is_admin == 1)
    
<a href="{{route('admin.dashboard')}}">Dashboard</a>

@else
<a href="{{route('editor.dashboard')}}">Dashboard</a>
@endif

@endauth
@guest
<a href="{{route('admin.login')}}">Admin login</a>
@endguest
