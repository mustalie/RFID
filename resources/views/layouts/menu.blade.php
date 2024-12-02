<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tags.index') }}"
       class="nav-link {{ Request::is('tags*') ? 'active' : '' }}">
        <p>Tags</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('tagMaps.index') }}"
       class="nav-link {{ Request::is('tagMaps*') ? 'active' : '' }}">
        <p>Tag Maps</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('checkins.index') }}"
       class="nav-link {{ Request::is('checkins*') ? 'active' : '' }}">
        <p>Checkins</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('studentPresences.index') }}"
       class="nav-link {{ Request::is('studentPresences*') ? 'active' : '' }}">
        <p>Student Presences</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('rooms.index') }}"
       class="nav-link {{ Request::is('rooms*') ? 'active' : '' }}">
        <p>Rooms</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('itemMovements.index') }}"
       class="nav-link {{ Request::is('itemMovements*') ? 'active' : '' }}">
        <p>Item Movements</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('deviceRooms.index') }}"
       class="nav-link {{ Request::is('deviceRooms*') ? 'active' : '' }}">
        <p>Device Rooms</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('inventoryRooms.index') }}"
       class="nav-link {{ Request::is('inventoryRooms*') ? 'active' : '' }}">
        <p>Inventory Rooms</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('inventoryGroups.index') }}"
       class="nav-link {{ Request::is('inventoryGroups*') ? 'active' : '' }}">
        <p>Inventory Groups</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('inventoryDetails.index') }}"
       class="nav-link {{ Request::is('inventoryDetails*') ? 'active' : '' }}">
        <p>Inventory Details</p>
    </a>
</li>


