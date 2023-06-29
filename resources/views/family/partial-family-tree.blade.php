<li>
    <span class="node">{{ $family->name }}</span>
    @if ($family->children->count() > 0)
        <ul>
            @foreach($family->children as $child)
                @include('family.partial-family-tree', ['family' => $child])
            @endforeach
        </ul>
    @endif
</li>
