
<!-- Navbar  -->
<section class="menu menu2 cid-u3GZCsGXbm" once="menu" id="menu-5-u3GZCsGXbm">
  <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
    <div class="container">
      <div class="navbar-brand">
        <span class="navbar-logo">
          <a href="{{ route('index') }}">                            
						<img src="images/loko.png" style="height: 4.3rem;">
					</a>
				</span>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-bs-toggle="collapse" data-target="#navbarSupportedContent"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarNavAltMarkup" aria-expanded="false"
        aria-label="Toggle navigation">
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>     
          <span></span>
        </div>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link link text-black display-4" href="{{ route('components') }}">Components</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link text-black display-4" href="#">Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link text-black display-4" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link text-black display-4" href="{{ route('contact') }}">Contacts</a>
          </li>
        </ul>
        <div class="navbar-buttons mbr-section-btn align-items-left">
            @guest    
          <a class="btn btn-primary display-4" href="{{ route('login') }}" style="background-color: yellow; color: black;">
            <i class="fas fa-user" style="font-size: 24px; margin-right: 10px;"></i>
              LOGIN
          </a>
          @endguest
            @auth
          <a class="btn btn-primary display-4" href="{{ route('logout') }}" style="background-color: yellow; color: black;">
            <i class="fas fa-user" style="font-size: 24px; margin-right: 10px;"></i>
              LOGOUT
          </a>
          @endguest
      </div>
      </div>
    </div>
  </nav>
</section>