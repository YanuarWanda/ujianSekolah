<div class="container-fluid text-dark">
    <div class="row">
        <div class="col-12 sidebar on text-dark">
            <div class="top-sidebar text-center">
                <div class="row">
                    <div class="col-3 mt-1">
                        <img src="{{ asset('image/logo.png') }}" alt="Logo U-Lah" width="40px" id="sidenav-on" class="sidena-on-mobile cursor-pointer"/>
                    </div>
                    <div class="col-5 brand-name">
                        <h1>U-Lah</h1>
                    </div>
                    <div class="nest-sidenavoff-mobile">
                        <i class="btn btn-outline-dark fas fa-2x fa-bars" id="sidenav-off-mobile"></i>
                    </div>
                    <div class="nest-sidenavoff">
                        <i class="btn btn-outline-dark fas fa-arrow-left" id="sidenav-off"></i>
                    </div>
                </div>
            </div>
            <hr class="mb-0 hrnav">
            <div class="rest-sidebar">
                <div class="custom-navbar-mobile">
                    <!-- <h2>Admin</h2> -->
                    <div class="btn-group">
                        <button class="btn btn-dark"><i class="btn btn-dark disabled fas fa-user"></i></button>
                        <button class="btn btn-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="dropdown-toggle-split fas fa-caret-down"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="{{ url('logout') }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="dropdown-item cursor-pointer"><i class="fas fa-power-off fa-fw"></i>Logout</button>
                            </form>
                        </div>
                    </div>
                </div>

                <a href="{{ url('beranda') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-beranda" data-toggle="tooltip" data-placement="right" title="Beranda">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-home fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Beranda</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ url('guru') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-guru" data-toggle="tooltip" data-placement="right" title="Kelola Guru">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-user-md fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Guru</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ url('siswa') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-siswa" data-toggle="tooltip" data-placement="right" title="Kelola Siswa">
                        <div class="row">
                            <div class="col-3 text-center">
                            <i class="fas fa-user fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Siswa</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ url('ujian') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-ujian" data-toggle="tooltip" data-placement="right" title="Kelola Ujian">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fab fa-leanpub fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Ujian</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ url('bank_soal') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-bank-soal" data-toggle="tooltip" data-placement="right" title="Kelola Bank Soal">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-archive fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Bank Soal</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ url('kelas') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-kelas" data-toggle="tooltip" data-placement="right" title="Kelola Kelas">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-university fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Kelas</span>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ url('jurusan') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-jurusan" data-toggle="tooltip" data-placement="right" title="Kelola Jurusan">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-graduation-cap fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Jurusan</span>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ url('mapel') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-mapel" data-toggle="tooltip" data-placement="right" title="Kelola Mapel">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-book fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Mapel</span>
                            </div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ url('bidang_keahlian') }}">
                    <div class="sidebar-menu on" id="sidebar-menu-bidang-keahlian" data-toggle="tooltip" data-placement="right" title="Kelola Bidang Keahlian">
                        <div class="row">
                            <div class="col-3 text-center">
                                <i class="fas fa-id-card fa-fw fa-2x sidebar-menu-icon"></i>
                            </div>
                            <div class="col-9">
                                <span class="sidebar-menu-text">Bidang Keahlian</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 maincontent on">
            <div class="custom-navbar">
                <!-- <h2>Admin</h2> -->
                <div class="btn-group">
                    <button class="btn btn-dark"><i class="btn btn-dark disabled fas fa-user"></i></button>
                    <button class="btn btn-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="dropdown-toggle-split fas fa-caret-down"></i></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ url('settings') }}" class="dropdown-item"><i class="fas fa-cog fa-fw"></i>Settings</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ url('logout') }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="dropdown-item cursor-pointer"><i class="fas fa-power-off fa-fw"></i>Logout</button>
                        </form>
                    </div>
                </div>
            </div>
