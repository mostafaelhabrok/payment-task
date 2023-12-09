<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link {{ (Route::currentRouteName() == 'payment') ? 'active' : '' }}" href="{{route('payment')}}">Payment</a>
            <a class="nav-item nav-link {{ (Route::currentRouteName() == 'history') ? 'active' : '' }}" href="{{route('history')}}">History</a>
        </div>
        </div>
    </nav>
</header>