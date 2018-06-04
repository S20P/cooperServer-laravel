@section('sidebar')
<div>
  <nav class="side-navbar">
    <div class="side-navbar-wrapper">
      <div class="sidenav-header d-flex align-items-center justify-content-center">
        <div class="sidenav-header-inner text-center">
          <img src="{{ asset('./img/avatar-1.jpg') }}" alt="person" class="img-fluid rounded-circle">
          <h2><strong class="text-primary">Sales </strong>Call Admin</h2>
          <!-- <h4 class="text-primary">{{Session::get('email')}}</h4> -->
        </div>
        <div class="sidenav-header-logo"><a href="{{ route('admin.dashboard') }}" class="brand-small text-center"> <strong>C</strong><strong class="text-primary">A</strong></a></div>
      </div>
      <div class="main-menu">
        <ul id="side-main-menu" class="side-menu list-unstyled">
          <li>
            <a href="{{ route('admin.dashboard') }}">
              <i class="icon-home"></i><span>Home</span>
            </a>
          </li>
           <li>
              <a href="{{ route('admin.Call_Logs_form') }}">
                <i class="fa fa-users" aria-hidden="true"></i><span>Call Logs</span>
              </a>
            </li>
          <li>
             <a href="{{ route('admin.fileupload_form') }}">
              <i class="fa fa-upload" aria-hidden="true"></i><span>Import Customers</span>
             </a>
          </li>
          <!-- <li>
             <a href="{{ route('admin.Export_Customer') }}">
            <i class="fa fa-external-link" aria-hidden="true"></i><span>Export Customers</span>
             </a>
          </li> -->
          <li>
             <a href="{{ route('admin.Export_Call_Logs') }}">
            <i class="fa fa-external-link" aria-hidden="true"></i><span>Export Call Logs</span>
             </a>
          </li>
          <li>
             <a href="{{ route('admin.changePassword_form') }}">
          <i class="fa fa-lock" aria-hidden="true"></i><span>Change Password</span>
             </a>
          </li>
          <li>
             <a href="{{ route('admin.settingEmail_page') }}">
             <i class="fa fa-cog" aria-hidden="true"></i><span>Cron Email User</span>
             </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 @show
</div>
