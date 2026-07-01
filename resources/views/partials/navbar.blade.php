<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">

        <li class="nav-item">

            <a class="nav-link"
               data-lte-toggle="sidebar"
               href="#"
               role="button">

                <i class="fas fa-bars"></i>

            </a>

        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto">

        <!-- Logged In User -->
        <li class="nav-item dropdown">

            <a class="nav-link"
               data-bs-toggle="dropdown"
               href="#">

                <i class="fas fa-user-circle me-1"></i>

                {{ auth()->user()->username }}

            </a>

            <div class="dropdown-menu dropdown-menu-end">

                <span class="dropdown-item-text">

                    <strong>{{ auth()->user()->username }}</strong>

                    <br>

                    <small class="text-muted">

                        {{ auth()->user()->getRoleNames()->implode(', ') }}

                    </small>

                </span>

                <div class="dropdown-divider"></div>

                <a href="#"
                   class="dropdown-item">

                    <i class="fas fa-user me-2"></i>

                    Profile

                </a>

                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="dropdown-item text-danger">

                        <i class="fas fa-sign-out-alt me-2"></i>

                        Logout

                    </button>

                </form>

            </div>

        </li>

    </ul>

</nav>