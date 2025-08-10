<h1>Properties near {{ $institute->name }}</h1>
<p>Radius: {{ $radius / 1000 }} km</p>

<ul>
    @forelse($properties as $p)
    <li>
        {{ $p->title }} - {{ number_format($p->distance / 1000, 2) }} km away
    </li>
    @empty
    <li>No properties found in this radius.</li>
    @endforelse
</ul>