<nav class="main-header navbar navbar-expand bg-primary navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

    </ul>

    <!-- SEARCH FORM -->


    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
        <!-- Messages Dropdown Menu -->
        <li>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-warning btn-sm" type="submit">خروج از سیستم</button>
            </form>


        </li>

    </ul>
</nav>
