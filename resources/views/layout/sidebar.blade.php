@php
    $current_path = '/' . request()->path();

    $dashboard = [
        'title' => 'Dashboard',
        'url' => '/dashboard'
    ]; 
    $user = [
        'title' => 'Users',
        'url' => '#',
        'icon' => 'bi bi-person-fill',
        'childrens' => [
            [
            'title' => 'List User',
            'url' => '/admin/users/all'
            ],
            [
                'title' => 'Create Users',
                'url' => '/admin/users/create'
            ]
        ]
    ];
    $article = [
        'title' => 'Articles',
        'url' => '#',
        'icon' => 'bi bi-file-text-fill',
        'childrens' => [
            [
            'title' => 'List Articles',
            'url' => '/admin/articles/all'
            ],
            [
                'title' => 'Create Article',
                'url' => '/admin/articles/create'
            ]
        ]
    ];
    $category= [
        'title' => 'Category',
        'url' => '#',
        'icon' => 'bi bi-tags-fill',
        'childrens' => [
            [
            'title' => 'List Category',
            'url' => '/admin/categories/all'
            ],
            [
                'title' => 'Create Category',
                'url' => '/admin/categories/create'
            ]
        ]
    ];

    $menus = [$dashboard, $user, $article, $category];
@endphp

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="/dist/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                @foreach ($menus as $menu)
                    @if (isset($menu['childrens']))
                        @php
                            $isActive = false;
                            foreach ($menu['childrens'] as $child) {
                                if($child['url'] == $current_path){
                                    $isActive = true;
                                }
                            }
                        @endphp
                        <li class="sidebar-item has-sub {{ $isActive ? 'active' : ''}}">
                            <a href="{{ $menu['url'] }}" class='sidebar-link'>
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                            <ul class="submenu {{ $isActive ? 'active' : '' }}">
                                @foreach ($menu['childrens'] as $item)
                                <li class="submenu-item ">
                                    <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="sidebar-item {{$current_path == $menu['url'] ? 'active' : ''}} ">
                            <a href="{{ $menu['url'] }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link btn btn-danger text-dark'>
                        <i class="bi bi-box-arrow-left text-dark"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>