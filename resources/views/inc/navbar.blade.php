<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name', 'Jabu CRM') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          
              <ul class="navbar-nav mr-auto">
                @if(Auth::user())
                <li class="nav-item">
                 
                  <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                 
                </li>
                @endif
                @if(Auth::user())

                <li class="nav-item">
                  <a class="nav-link" href="/tasks">Tasks</a>
                </li>
                @endif
    
              </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
                    @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>
        
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user())
                            <a href="/tasks/create" class="dropdown-item">Add Task</a>
                            @endif
                            @if(Auth::user())
                            <a href="/tasks" class="dropdown-item">View Tasks</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                         </div>

                  </li>
                  
              @endguest
          </ul>
      </div>
  </div>
</nav>