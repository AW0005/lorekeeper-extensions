<ul>
    <li class="sidebar-header"><a href="{{ url('world') }}" class="card-link">Lore</a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Trait Guides</div>
        <div class="sidebar-item"><a href="{{ url('world/species/1/traits') }}" class="{{ set_active('world/species/1/traits') }}">AW0005 Trait Guide</a></div>
        <!-- <div class="sidebar-item"><a href="{{ url('world/species/2/traits') }}" class="{{ set_active('world/species/2/traits') }}">Holos Trait Guide</a></div> -->
        <div class="sidebar-item"><a href="{{ url('world/traits') }}" class="{{ set_active('world/traits*') }}">Search Traits</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Characters</div>
        <div class="sidebar-item"><a href="{{ url('world/species') }}" class="{{ set_active(['world/species/**/[!traits]', 'world/species']) }}">Species</a></div>
        <div class="sidebar-item"><a href="{{ url('world/subtypes') }}" class="{{ set_active('world/subtypes*') }}">Subtypes</a></div>
        <div class="sidebar-item"><a href="{{ url('world/rarities') }}" class="{{ set_active('world/rarities*') }}">Rarities</a></div>
        <!-- <div class="sidebar-item"><a href="{{ url('world/trait-categories') }}" class="{{ set_active('world/trait-categories*') }}">Trait Categories</a></div> -->
        <div class="sidebar-item"><a href="{{ url('world/character-categories') }}" class="{{ set_active('world/character-categories*') }}">Character Categories</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Items</div>
        <div class="sidebar-item"><a href="{{ url('world/item-categories') }}" class="{{ set_active('world/item-categories*') }}">Item Categories</a></div>
        <div class="sidebar-item"><a href="{{ url('world/items') }}" class="{{ set_active('world/items*') }}">All Items</a></div>
        <div class="sidebar-item"><a href="{{ url('world/currencies') }}" class="{{ set_active('world/currencies*') }}">Currencies</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Badges</div>
        <div class="sidebar-item"><a href="{{ url('world/award-categories') }}" class="{{ set_active('world/award-categories*') }}">Badge Categories</a></div>
        <div class="sidebar-item"><a href="{{ url('world/awards') }}" class="{{ set_active('world/awards*') }}">All Badges</a></div>
    </li>
</ul>
