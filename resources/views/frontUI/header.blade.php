<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{url('/')}}" class="nav-link">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            @auth
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('/assets/img/avatar5.png') }}" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline">{{$name}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset('/assets/img/avatar5.png') }}" class="rounded-circle shadow" alt="User Image">
                        <p>
                            {{$name}}
                            <small>{{ strtoupper(str_replace('_', ' ', empty($roles) ? ' ' : $roles)) }} {{ ucwords(str_replace('_', ' ', empty($user_nip) ? ' ' : $user_nip)) }}</small>
                            <small>Hak : {{ucwords(str_replace('_', ' ',$hak))}}</small>
                        </p>
                    </li>
                    @endauth
                    <!-- <li class="user-body">
                        <div class="row">
                            <div class="col-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </div>
                    </li> -->
                    <li class="user-footer">
                        <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>