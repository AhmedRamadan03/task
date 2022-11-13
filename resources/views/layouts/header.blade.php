


  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; width: 100%;box-shadow: 0 0 10px -5px;z-index: 88888;">
    <a class="navbar-brand" href="{{ route('home') }}">Home</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('folders.index') ? 'active' :'' }}" aria-current="page" href="{{ route('folders.index') }}">Folder</a>
        </li>
        @if (auth()->user()->is_admin == '1')
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('users.index') ? 'active' :'' }}" aria-current="page" href="{{ route('users.index') }}">User</a>
        </li>
        @endif
        
      </ul>
      <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
         {{auth()->user()->username}}
        </button>
        <div class="dropdown-menu">
         <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </div>
    </div>
  </nav>