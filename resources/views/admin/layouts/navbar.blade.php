 <!-- Header-->
 <header id="header" class="header">

  <div class="header-menu">

      <div class="col-sm-7">
          <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
      </div>

      <div class="col-sm-5">
          <div class="user-area dropdown float-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="user-avatar rounded-circle" src="{{url('admin/images/admin.jpg')}}" alt="User Avatar">
              </a>

              <div class="user-menu dropdown-menu">
                  <a class="nav-link" href="{{route('admin.logout')}}"><i class="fa fa-power-off"></i> Logout</a>
              </div>
          </div>

      </div>
  </div>

</header><!-- /header -->
<!-- Header-->