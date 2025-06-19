@php
    $sidebar_menus = App\Models\Menu::with('children')->orderBy('order')->get();
    function hasVisibleChildren($menuItem)
    {
        foreach ($menuItem->children as $child) {
            if ($child->subdomain != null && auth()->user()->can($child->permission_view)) {
                return true;
            }
        }
        return false;
    }
@endphp

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main" style="overflow-y: auto; overflow-x: hidden;">
    <div class="sidenav-header">
        {{-- <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i> --}}
        {{-- <a class="navbar-brand m-0" href="{{ url('/') }}"> --}}
        {{-- <span class="ms-1 font-weight-bold">Starter-Kit</span> --}}
        {{-- </a> --}}

        <a class="navbar-brand m-0" href="{{ url('/') }}">
            <span class="app-brand-logo demo">
                <img src={{ asset('assets/img/tapin.svg') }} alt="Logo" width="30" height="65">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
                PROFIL SKPD
            </span>
        </a>
    </div>
    <hr class="horizontal dark mt-3">
    <div class="navbar-collapse h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <div id="sidebar-accordion">
                @foreach ($sidebar_menus as $sidebar_menu)
                    @if ($sidebar_menu->parent_id == null && $sidebar_menu->children->isNotEmpty() && hasVisibleChildren($sidebar_menu))
                        @include('component.menu_item', [
                            'sidebar_menu' => $sidebar_menu,
                            'additional_class' => null,
                        ])
                    @endif
                @endforeach
            </div>
        </ul>
    </div>
</aside>
