
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                @if(Auth::check())   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     {{Auth::user()->name}}
                </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/logout">Logout</a>
                        <a class="dropdown-item" href="#">Dashboard</a>
                </li>
                @else
                <div class="row mx-md-n5">
                    <div class="col px-md-2"><a class="btn btn-primary " href="/login">Login</a></div>
                    <div class="col px-md-2"><a class="btn btn-success" href="/register">Register</a></div>
                </div>
                @endif
            </ul>
        </div>
    </div>
</nav>