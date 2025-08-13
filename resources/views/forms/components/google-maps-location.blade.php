<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    {{-- Container untuk peta dan pencarian --}}
    <div
        x-data="{
            // Gunakan wire:model.live untuk sinkronisasi otomatis
            latitude: $wire.entangle('data.latitude'),
            longitude: $wire.entangle('data.longitude'),
            address: $wire.entangle('data.address'),
            city: $wire.entangle('data.city'),
            state: $wire.entangle('data.state'),
            postal_code: $wire.entangle('data.postal_code'),

            map: null,
            marker: null,
            autocomplete: null,
            
            init() {
                this.loadGoogleMaps();
            },

            loadGoogleMaps() {
                if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
                    const script = document.createElement('script');
                    script.src = `https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&region=MY`;
                    script.async = true;
                    script.defer = true;
                    script.onload = () => {
                        this.initMap();
                        this.initAutocomplete();
                    };
                    document.head.appendChild(script);
                } else {
                    this.initMap();
                    this.initAutocomplete();
                }
            },
            
            initMap() {
                const defaultLat = this.latitude || 3.139003;
                const defaultLng = this.longitude || 101.686855;
                
                this.map = new google.maps.Map(this.$refs.map, {
                    center: { lat: parseFloat(defaultLat), lng: parseFloat(defaultLng) },
                    zoom: 12,
                    mapId: 'YOUR_MAP_ID_HERE',
                });

                this.marker = new google.maps.Marker({
                    position: { lat: parseFloat(defaultLat), lng: parseFloat(defaultLng) },
                    map: this.map,
                    draggable: true,
                });

                this.marker.addListener('dragend', () => {
                    const position = this.marker.getPosition();
                    // Gunakan $wire.set() untuk memaksa sinkronisasi data
                    this.latitude = position.lat();
                    this.longitude = position.lng();
                    this.reverseGeocode(position);
                });

                this.map.addListener('click', (event) => {
                    this.marker.setPosition(event.latLng);
                    // Gunakan $wire.set() untuk memaksa sinkronisasi data
                    this.latitude = event.latLng.lat();
                    this.longitude = event.latLng.lng();
                    this.reverseGeocode(event.latLng);
                });
            },

            initAutocomplete() {
                this.autocomplete = new google.maps.places.Autocomplete(this.$refs.searchInput, {
                    types: ['geocode'],
                    componentRestrictions: { country: 'MY' }
                });

                this.autocomplete.addListener('place_changed', () => {
                    const place = this.autocomplete.getPlace();
                    if (!place.geometry || !place.geometry.location) {
                        return;
                    }
                    this.map.setCenter(place.geometry.location);
                    this.marker.setPosition(place.geometry.location);
                    this.latitude = place.geometry.location.lat();
                    this.longitude = place.geometry.location.lng();
                    this.updateAddressFields(place);
                });
            },
            
            reverseGeocode(location) {
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ location: location }, (results, status) => {
                    if (status === 'OK' && results[0]) {
                        this.updateAddressFields(results[0]);
                    }
                });
            },

            updateAddressFields(place) {
                const addressComponents = place.address_components;
                let streetAddress = '';
                let city = '';
                let state = '';
                let postalCode = '';

                addressComponents.forEach(component => {
                    const types = component.types;
                    if (types.includes('locality') || types.includes('sublocality')) {
                        city = component.long_name;
                    }
                    if (types.includes('administrative_area_level_1')) {
                        state = component.long_name;
                    }
                    if (types.includes('postal_code')) {
                        postalCode = component.long_name;
                    }
                });

                this.address = place.formatted_address;
                this.city = city;
                this.state = state;
                this.postal_code = postalCode;
            }
        }"
    >
        <div class="mb-4">
            <input
                x-ref="searchInput"
                type="text"
                placeholder="Search for a location in Malaysia"
                class="w-full p-2 mb-4 border text-black rounded"
                style="color: black"
            >
            <div x-ref="map" class="w-full h-96 border rounded"></div>
        </div>
    </div>
</x-dynamic-component>