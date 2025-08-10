<form action="{{ route('properties.results') }}" method="GET">
    <label for="institute_id">Choose Institute:</label>
    <select name="institute_id" id="institute_id" required>
        @foreach($institutes as $i)
        <option value="{{ $i->id }}">{{ $i->name }}</option>
        @endforeach
    </select>

    <label for="radius">Radius (meters):</label>
    <input type="number" name="radius" id="radius" value="5000">

    <button type="submit">Search</button>
</form>