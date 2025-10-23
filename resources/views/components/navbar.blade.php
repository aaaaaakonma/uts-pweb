<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">MiniProject</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('pengelolaan') }}">Pengelolaan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
      </ul>
    </div>
  </div>
</nav>
