<nav class="navbar navbar-expand-md navbar-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      {{ config('app.name', 'Laravel') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto"></ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @else

        @if(Auth::user()->hasRole('administrator'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('clients_list')}}">
            Clientes <i class="fas fa-user"></i>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('content_list')}}">
            Conteudo <i class="fas fa-newspaper"></i>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('users_list')}}">
            Usuários <i class="fas fa-users"></i>
          </a>
        </li>
        @endif

        <li class="nav-item">
          <a class="nav-link" href="{{route('user')}}">
            {{ Auth::user()->name }} <i class="fas fa-cog"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i></a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
