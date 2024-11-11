<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <form class="dropdown-item d-flex align-items-center" action="{{route('logout')}}" method="get">
                        @csrf
                        <i class="mdi mdi-logout font-size-16 align-middle mr-1"><input class="btn btn-light" style="border: none; outline:none" type="submit" value="Logout"></i>
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </form>
        </li>
    </ul>
</nav>