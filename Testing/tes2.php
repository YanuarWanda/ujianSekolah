@section('css')
    <link rel="stylesheet" href="{{asset('css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{asset('css/ace-skins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/ace-rtl.min.css')}}" />
@endsection

<div id="sidebar" class="sidebar responsive ace-save-state">
   <!--  <script type="text/javascript">
      try{ace.settings.loadState('sidebar')}catch(e){}
    </script> -->
    <ul class="nav nav-list">
      <li class="active open">
        <a href="#">
          <i class="menu-icon fa fa-home"></i>
          <span class="menu-text"> Beranda </span>
        </a>
        <b class="arrow"></b>
      </li>
            <li class="">
                <a href="#">
                    <i class="menu-icon fa fa-newspaper-o"></i>
                    <span class="menu-text"> Berita </span>
                </a>
            </li>
            <li class="">
          <a href="#">
            <i class="menu-icon fa fa-calendar"></i>
            <span class="menu-text"> Agenda </span>
            <b class="arrow"></b>
          </a>
        </li>
        <li class="">
          <a href="#">
            <i class="menu-icon fa fa-id-card"></i>
            <span class="menu-text"> Guru </span>
          </a>
          <b class="arrow"></b>
        </li>
            <li class="">
          <a href="#">
            <i class="menu-icon fa fa-bell"></i>
            <span class="menu-text"> Pengumuman </span>
          </a>
          <b class="arrow"></b>
        </li>
        <li class="">
          <a href="#">
            <i class="menu-icon fa fa-picture-o"></i>
            <span class="menu-text"> Gallery </span>
          </a>
          <b class="arrow"></b>
        </li>
        </ul>
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
      <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
  </div>
  
  <script src="{{asset('js/ace-elements.min.js')}}"></script>
  <script src="{{asset('js/ace.min.js')}}"></script>