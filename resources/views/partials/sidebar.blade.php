<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
                <ul class="navbar-nav" id="navbar-nav">
                    @foreach (menus() as $category => $menus)
                        @foreach ($menus as $mm)
                            @can('read ' . $mm->url)
                                <li class="menu-title"><span data-key="t-menu">{{ $category }}</span>
                                </li>

                                @php
                                    $menuId = 'menu_' . $mm->id;
                                @endphp
                                <li @class([
                                    'nav-item' => str_contains(request()->path(), $mm->url),
                                ])>
                                    @if (count($mm->subMenus))
                                        <a @class([
                                            'nav-link menu-link',
                                            'active' => str_contains(request()->path(), $mm->url),
                                        ]) href="#{{ $menuId }}"
                                            data-bs-toggle="collapse" role="button" aria-expanded="false"
                                            aria-controls="{{ $menuId }}">
                                            <i data-feather="{{ $mm->icon }}"></i> <span
                                                data-key="t-layouts">{{ $mm->name }}</span>
                                        </a>
                                        <div @class([
                                            'collapse menu-dropdown',
                                            'show' => str_contains(request()->path(), $mm->url),
                                        ]) id="{{ $menuId }}">
                                            <ul class="nav nav-sm flex-column">
                                                @foreach ($mm->subMenus as $sm)
                                                    @can('read ' . $sm->url)
                                                        <li>
                                                            <a href="{{ url($sm->url) }}" @class([
                                                                'nav-link menu-link',
                                                                'active' => str_contains(request()->path(), $sm->url),
                                                            ])
                                                                data-key="t-horizontal">{{ $sm->name }}</a>
                                                        </li>
                                                    @endcan
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <a class="nav-link menu-link" href="{{ url($mm->url) }}">
                                            <i data-feather="{{ $mm->icon }}"></i> <span
                                                data-key="t-widgets">{{ $mm->name }}</span>
                                        </a>
                                    @endif

                                </li>
                            @endcan
                        @endforeach
                    @endforeach

                </ul>
            </div>

        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
