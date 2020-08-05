<nav class="navbar navbar-expand-lg navbar-light  border-bottom">
    <a id="menu-toggle" href="javascript::">
        <i class="las la-bars la-lg "></i>
    </a>
    <small class= "text-primary m-2 font-bold text-uppercase">Backoffice Panel</small>
    <a href="javascript::" class="navbar-toggler border-0 px-0" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="las la-ellipsis-v la-lg text-primary"></i>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            @guest
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item"> 
                        <a class="nav-link text-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
            @endif
            @else
                @if (auth()->user()->hasAnyRole($role))    
                <li class="nav-item ">
                    <a class="nav-link text-secondary " href="{{route('admin.dashboard')}}">Dashboard</a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle p-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{Avatar::create(Auth::user()->name)->toBase64()}}" width="30" height="30" class="rounded-circle border">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <span class="dropdown-item text-primary">{{ Auth::user()->name }} </span>
                        <small class="dropdown-item text-secondary">{{Auth::user()->roles()->first()->name ?? '-'}}</small>
                        <hr>
                        <a class="dropdown-item" href="#">Dashboard</a>
                        <a class="dropdown-item" href="#">Edit Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
