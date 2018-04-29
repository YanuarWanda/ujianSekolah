<nav class="navbar navbar-dark bg-main">
    <div class="container justify-content-between">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('image/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
            U-LAH
        </a>
        <div class="btn-group">
            <button class="btn btn-dark">{{ Auth::user()->username }}</button>
            <button class="btn btn-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="dropdown-toggle-split fas fa-caret-down"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ url('siswa/profil') }}" class="dropdown-item"><i class="fas fa-user fa-fw"></i>&nbsp;Profil</a>
                <a href="{{ url('settings') }}" class="dropdown-item"><i class="fas fa-cog fa-fw"></i>&nbsp;Settings</a>
                <div class="dropdown-divider"></div>
                <form action="{{ url('logout') }}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="dropdown-item cursor-pointer"><i class="fas fa-power-off fa-fw"></i>&nbsp;Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>