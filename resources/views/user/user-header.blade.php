<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">Bus System</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('report.booking') }}">Booking Reports</a></li>
            <li><a href="{{ route('report.bus') }}">Bus Reports</a></li>

            <li><a href="{{ url('/show-bus-list') }}"><span class="glyphicon glyphicon-calendar"></span> Bus List</a></li>
            <li><a href="{{ route('profiles.myProfile') }}"><span class="glyphicon glyphicon-user"></span></a></li>

            <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">

                Logout
            </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </ul>
    </div>
</nav>