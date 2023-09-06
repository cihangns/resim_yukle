<div class="header navbar">
    <div class="header-container">
      <div class="nav-logo">
        <a href="/home">
          <b><img src="assets/img/logo.png" alt=""></b>
          <span class="logo">
            <img src="assets/img/logo-text.png" alt="">
          </span>
        </a>
      </div>
      <ul class="nav-left">
        <li>
          <a class="sidenav-fold-toggler" href="javascript:void(0);">
            <i class="lni-menu"></i>
          </a>
          <a class="sidenav-expand-toggler" href="javascript:void(0);">
            <i class="lni-menu"></i>
          </a>
        </li>
      </ul>
      @if (Auth::check())
      <ul class="nav-right">
        <li class="user-profile dropdown dropdown-animated scale-left">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img class="profile-img img-fluid" style="height: 35px" src="{{Auth::user()->profilePhoto ? $profilePhotoUrl : "assets/img/avatar/avatar.png"}}" alt=""> 
          </a>
          <ul class="dropdown-menu dropdown-md">
            <li>
              <ul class="list-media">
                <li class="list-item avatar-info">
                  <div class="media-img">
                    <img src="{{Auth::user()->profilePhoto ? $profilePhotoUrl : "assets/img/avatar/avatar.png"}}" alt="">
                  </div>
                  <div class="info">
                    <span class="title text-semibold">{{ $username }}</span>
                    <span class="sub-title">{{Auth::user() ? (Auth::user()->isAdmin == 1 ? "Admin" : "Guest"): ""}}</span>
                  </div>
                </li>
              </ul>
            </li>
            <li role="separator" class="divider"></li>
            <li>
              <a href="">
                <i class="lni-cog"></i>
                <span>{{__('Ayarlar')}}</span>
              </a>
            </li>
            <li>
              <a href="/setprofilepage">
                <i class="lni-user"></i>
                <span>{{__('Profil')}}</span>
              </a>
            </li>
            <li>
              <a href="#" onclick="
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                ">
                <i class="lni-lock"></i>
                <span>Logout</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </a>
            </li>
          </ul>
        </li> 
      </ul>
      @endif
      
    </div>
  </div>