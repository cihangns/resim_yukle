<div class="side-nav expand-lg">
    <div class="side-nav-inner">
      <ul class="side-nav-menu">
        @if (Auth::check())
        <li class="side-nav-header">
          <span>Navigation</span>
        </li>
        <li class="nav-item dropdown">
          <a class="dropdown-toggle" href="/">
            <span class="icon-holder">
              <i class="lni-home"></i>
            </span>
            <span class="title">Anasayfa</span>
          </a>
        </li>
        <li class="nav-item dropdown ">
          <a href="{{route("imagesList")}}" class="dropdown-toggle">
            <span class="icon-holder">
              <i class="lni-dashboard"></i>
            </span>
            <span class="title">Resimlerim</span>
          </a>
        </li>
        @endif
        @guest
        <li class="nav-item dropdown ">
          <a href="{{url("/")}}" class="dropdown-toggle">
            <span class="icon-holder">
              <i class="lni-home"></i>
            </span>
            <span class="title">Anasayfa</span>
          </a>
        </li>
        <li class="nav-item dropdown ">
          <a href="{{url("/login")}}" class="dropdown-toggle">
            <span class="icon-holder">
              <i class="lni-user"></i>
            </span>
            <span class="title">Giriş Yap</span>
          </a>
        </li>
        <li class="nav-item dropdown ">
          <a href="{{url("/register")}}" class="dropdown-toggle">
            <span class="icon-holder">
              <i class="lni-plus"></i>
            </span>
            <span class="title">Kayıt ol</span>
          </a>
        </li>
        @endguest
      </ul>
    </div>
  </div>