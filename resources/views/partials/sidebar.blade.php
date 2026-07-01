<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- Brand Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link">

        <i class="fas fa-dice ml-3 mr-2"></i>

        <span class="brand-text font-weight-light">

            Indian Classic

        </span>

    </a>

    {{-- Sidebar --}}
    <div class="sidebar">

        {{-- User --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}"
                    class="img-circle elevation-2">

            </div>

            <div class="info">

                <a href="#" class="d-block">

                    {{ auth()->user()->username }}

                </a>

            </div>

        </div>

        {{-- Menu --}}
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">

                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-home"></i>

                        <p>Dashboard</p>

                    </a>

                </li>

                {{-- User Management --}}
                <li class="nav-item {{ request()->is('admin/retailers*') ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-users"></i>

                        <p>

                            User Management

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="{{ route('admin.retailers.index') }}"
                                class="nav-link {{ request()->routeIs('admin.retailers.*') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Retailers</p>

                            </a>

                        </li>

                    </ul>

                </li>

                {{-- Game Management --}}
                <li class="nav-item
                    {{ request()->is('admin/game-types*') ||
                       request()->is('admin/games*') ||
                       request()->is('admin/rounds*')
                       ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-gamepad"></i>

                        <p>

                            Game Management

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="{{ route('admin.game-types.index') }}"
                                class="nav-link {{ request()->routeIs('admin.game-types.*') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Game Types</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="{{ route('admin.games.index') }}"
                                class="nav-link {{ request()->routeIs('admin.games.*') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Games</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="{{ route('admin.rounds.index') }}"
                                class="nav-link {{ request()->routeIs('admin.rounds.*') ? 'active' : '' }}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Rounds</p>

                            </a>

                        </li>

                    </ul>

                </li>

                {{-- Betting --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-coins"></i>

                        <p>

                            Betting

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Bets</p>

                            </a>

                        </li>

                        <li class="nav-item">

                            <a href="#" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Results</p>

                            </a>

                        </li>

                    </ul>

                </li>

                {{-- Reports --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-chart-line"></i>

                        <p>Reports</p>

                    </a>

                </li>

                {{-- Settings --}}
                <li class="nav-item">

                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-cogs"></i>

                        <p>Settings</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>