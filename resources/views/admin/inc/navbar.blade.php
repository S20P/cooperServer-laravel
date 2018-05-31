<header class="header">
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">

      
            <div class="navbar-header">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
            </div>

              <!-- Collapsed Hamburger -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>

              <!-- Branding Image -->
              <!-- <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name', 'Laravel') }}
              </a> -->


          <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <!-- Left Side Of Navbar -->
              <ul class="nav navbar-nav">
                  &nbsp;
              </ul>

              <!-- Right Side Of Navbar -->
            @guest
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center navbar-right">
                  <!-- Authentication Links -->
                  <li  class="nav-item">
                  <a href="{{ route('admin.logout') }}" class="nav-link logout"   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Logout<i class="fa fa-sign-out"></i></a></li>

                      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </li>
                  <li>
                  <a href="{{ route('admin.changePassword_form') }}">
                     Change Password  <i class="fa fa-lock" aria-hidden="true"></i>
                  </a>
                </li>
                    @else
                  <li><a href="{{ URL::to('admin') }}">Login</a></li>
                  <li><a href="{{ URL::to('admin/register') }}">Register</a></li>
              </ul>
                @endguest
          </div>
      </div>
  </nav>

</header>
