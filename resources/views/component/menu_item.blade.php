@php
    $isActive = request()->segment(1) == $sidebar_menu->subdomain;
    $hasChildren = $sidebar_menu->children->isNotEmpty();
    $collapseId = 'submenu-' . $sidebar_menu->id;

    $isChildActive = $sidebar_menu->children->contains(function ($child) {
        return request()->segment(1) == $child->subdomain;
    });
@endphp

<li class="nav-item {{ $additional_class }}">
    <a class="nav-link {{ $isActive ? 'active' : '' }} {{ $sidebar_menu->parent_id == null ? ' parent-sidebar' : '' }}"
        href="{{ $hasChildren ? '#' . $collapseId : url($sidebar_menu->subdomain) }}" {{-- @if ($hasChildren) data-bs-toggle="collapse" role="button" aria-expanded="{{ $isActive ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}" @endif> --}}
        @if ($hasChildren) data-bs-toggle="collapse" role="button" aria-expanded="{{ $isChildActive ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}" @endif>

        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class=" fas {{ $sidebar_menu->icon }} {{ $sidebar_menu->parent_id == null ? 'text-primary' : 'text-primary' }} text-sm opacity-10 fa-fw"></i>
        </div>
        <span class="nav-link-text ms-1">{!! $sidebar_menu->name !!}</span>

        {{-- @if ($hasChildren)
            <i class="fas fa-chevron-down ms-auto text-xs"></i>
        @endif --}}
    </a>

    @if ($hasChildren)
        {{-- <ul class="navbar-nav collapse {{ $isActive ? 'show' : '' }}" id="{{ $collapseId }}"> --}}
        <ul class="navbar-nav collapse {{ $isChildActive ? 'show' : '' }}" id="{{ $collapseId }}" data-bs-parent="#sidebar-accordion">

            @foreach ($sidebar_menu->children as $child)
                @if ($child->subdomain != null && !auth()->user()->can($child->permission_view))
                    @continue
                @endif
                @include('component.menu_item', ['sidebar_menu' => $child, 'additional_class' => 'ms-3'])
            @endforeach
        </ul>
    @endif
</li>
