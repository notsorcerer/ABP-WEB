@props([
    'lat' => old('latitude', ''),
    'lng' => old('longitude', ''),
])

<div class="sm:col-span-2" id="location-picker-wrapper">
    <input type="hidden" name="latitude" id="latitude" value="{{ $lat }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ $lng }}">

    <label class="block text-sm font-medium text-accent mb-1.5">Lokasi Pengiriman</label>

    <div id="location-preview" class="bg-gray-50 rounded-xl p-4 border-2 {{ $lat ? 'border-primary/30' : 'border-dashed border-gray-200' }}">
        @if ($lat)
            <div class="flex items-start gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-accent truncate" id="preview-address">Lokasi telah dipilih</p>
                    <p class="text-xs text-gray-500 mt-0.5">
                        Lat: <span id="preview-lat" class="font-mono">{{ $lat }}</span>,
                        Lng: <span id="preview-lng" class="font-mono">{{ $lng }}</span>
                    </p>
                </div>
                <a href="https://www.google.com/maps?q={{ $lat }},{{ $lng }}" target="_blank" rel="noopener noreferrer"
                   class="text-xs text-primary hover:text-secondary font-semibold inline-flex items-center gap-1 transition-colors duration-200 shrink-0">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Buka Maps
                </a>
            </div>
        @else
            <div id="location-empty" class="text-center py-4">
                <svg class="h-8 w-8 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <p class="text-sm text-gray-400">Belum memilih lokasi</p>
                <p class="text-xs text-gray-300 mt-1">Klik tombol di bawah untuk memilih lokasi</p>
            </div>
        @endif
    </div>

    <div class="flex gap-2 mt-2">
        <button type="button" onclick="openLocationModal()"
                class="flex-1 px-4 py-2.5 bg-primary hover:bg-secondary text-white rounded-xl text-sm font-semibold transition-all duration-200 flex items-center justify-center gap-1.5">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            Pilih Lokasi
        </button>
        <button type="button" onclick="detectMyLocation()"
                class="px-4 py-2.5 border-2 border-gray-200 hover:border-primary text-accent rounded-xl text-sm font-semibold transition-all duration-200 flex items-center justify-center gap-1.5">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5l16.5-4.5-4.5 16.5-5.25-7.5L3.75 7.5z" />
            </svg>
            Lokasi Saya
        </button>
    </div>

    @error('latitude')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    @error('longitude')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Modal -->
<div id="location-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6" style="display: none;">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeLocationModal()"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col z-10 animate-fade-in">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 shrink-0">
            <h3 class="text-lg font-bold text-accent">Pilih Lokasi</h3>
            <button type="button" onclick="closeLocationModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-4 border-b border-gray-200 shrink-0">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="text" id="location-search" oninput="debouncedSearch(this.value)" autocomplete="off"
                       placeholder="Cari alamat, kota, atau tempat..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-primary focus:outline-none transition-colors duration-200 text-sm">
            </div>
            <div id="search-results" class="mt-2 hidden"></div>
            <div id="search-status" class="text-xs text-gray-400 mt-1 hidden"></div>
        </div>

        <div class="flex-1 relative min-h-[300px] sm:min-h-[400px]">
            <div id="leaflet-map" class="absolute inset-0"></div>
        </div>

        <div id="modal-selected-info" class="hidden p-3 bg-primary/5 border-t border-primary/20 shrink-0"></div>

        <div class="flex items-center justify-between gap-3 p-4 border-t border-gray-200 shrink-0">
            <button type="button" onclick="detectLocationInModal()"
                    class="px-4 py-2.5 border-2 border-gray-200 hover:border-primary text-accent rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-1.5">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5l16.5-4.5-4.5 16.5-5.25-7.5L3.75 7.5z" />
                </svg>
                Gunakan Lokasi Saya
            </button>
            <button type="button" onclick="saveLocationFromModal()"
                    class="px-6 py-2.5 bg-primary hover:bg-secondary text-white rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-1.5">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Simpan Lokasi
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let locationMap = null;
    let locationMarker = null;
    let mapInitialized = false;
    let modalLat = null;
    let modalLng = null;
    let modalAddress = '';
    let searchTimeout = null;

    function openLocationModal() {
        const modal = document.getElementById('location-modal');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const currentLat = parseFloat(latInput.value) || -2.5;
        const currentLng = parseFloat(lngInput.value) || 118.0;
        const zoom = latInput.value ? 15 : 5;

        modalLat = currentLat;
        modalLng = currentLng;

        if (!mapInitialized) {
            locationMap = L.map('leaflet-map').setView([currentLat, currentLng], zoom);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19,
            }).addTo(locationMap);

            locationMarker = L.marker([currentLat, currentLng], { draggable: true }).addTo(locationMap);

            locationMarker.on('dragend', function (e) {
                const pos = e.target.getLatLng();
                modalLat = pos.lat;
                modalLng = pos.lng;
                reverseGeocode(pos.lat, pos.lng);
            });

            locationMap.on('click', function (e) {
                locationMarker.setLatLng(e.latlng);
                modalLat = e.latlng.lat;
                modalLng = e.latlng.lng;
                reverseGeocode(e.latlng.lat, e.latlng.lng);
            });

            mapInitialized = true;
        } else {
            locationMarker.setLatLng([currentLat, currentLng]);
            locationMap.setView([currentLat, currentLng], zoom);
        }

        setTimeout(function () {
            if (locationMap) locationMap.invalidateSize();
        }, 300);

        if (latInput.value) {
            reverseGeocode(currentLat, currentLng);
        } else {
            updateModalInfo(currentLat, currentLng, '');
        }
    }

    function closeLocationModal() {
        const modal = document.getElementById('location-modal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.body.style.overflow = '';
        const results = document.getElementById('search-results');
        results.classList.add('hidden');
        document.getElementById('location-search').value = '';
    }

    function reverseGeocode(lat, lng) {
        fetch('https://nominatim.openstreetmap.org/reverse?lat=' + lat + '&lon=' + lng + '&format=json&accept-language=id', {
            headers: { 'User-Agent': 'LiquidPedia/1.0' }
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            modalAddress = data.display_name || '';
            updateModalInfo(lat, lng, modalAddress);
        })
        .catch(function () {
            modalAddress = lat.toFixed(6) + ', ' + lng.toFixed(6);
            updateModalInfo(lat, lng, '');
        });
    }

    function updateModalInfo(lat, lng, address) {
        var info = document.getElementById('modal-selected-info');
        info.classList.remove('hidden');
        info.innerHTML =
            '<div class="flex items-start gap-2">' +
                '<svg class="h-4 w-4 text-primary mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">' +
                    '<path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />' +
                '</svg>' +
                '<div>' +
                    '<p class="text-sm text-accent font-medium">' + (address || 'Lokasi dipilih') + '</p>' +
                    '<p class="text-xs text-gray-500 mt-0.5">Lat: ' + lat.toFixed(6) + ' | Lng: ' + lng.toFixed(6) + '</p>' +
                '</div>' +
            '</div>';
    }

    function debouncedSearch(query) {
        clearTimeout(searchTimeout);
        if (query.length < 3) {
            document.getElementById('search-results').classList.add('hidden');
            return;
        }
        searchTimeout = setTimeout(function () { searchLocation(query); }, 300);
    }

    function searchLocation(query) {
        var resultsDiv = document.getElementById('search-results');
        var statusDiv = document.getElementById('search-status');
        statusDiv.classList.remove('hidden');
        statusDiv.textContent = 'Mencari...';

        fetch('https://nominatim.openstreetmap.org/search?q=' + encodeURIComponent(query) + '&format=json&limit=5&accept-language=id', {
            headers: { 'User-Agent': 'LiquidPedia/1.0' }
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            statusDiv.classList.add('hidden');
            if (data.length === 0) {
                resultsDiv.innerHTML = '<div class="p-3 text-sm text-gray-500 text-center">Lokasi tidak ditemukan</div>';
                resultsDiv.classList.remove('hidden');
                return;
            }
            resultsDiv.innerHTML = data.map(function (r) {
                var name = r.display_name.replace(/'/g, "\\'");
                return '<button type="button" onclick="selectSearchResult(' + r.lat + ', ' + r.lon + ', \'' + name + '\')"' +
                       ' class="w-full text-left px-4 py-2.5 text-sm hover:bg-primary/5 transition-colors duration-150 border-b border-gray-100 last:border-0">' +
                       '<span class="font-medium text-accent">' + r.display_name + '</span></button>';
            }).join('');
            resultsDiv.classList.remove('hidden');
        })
        .catch(function () {
            statusDiv.classList.add('hidden');
            resultsDiv.innerHTML = '<div class="p-3 text-sm text-red-500 text-center">Gagal mencari lokasi</div>';
            resultsDiv.classList.remove('hidden');
        });
    }

    function selectSearchResult(lat, lng, displayName) {
        modalLat = parseFloat(lat);
        modalLng = parseFloat(lng);
        modalAddress = displayName;

        locationMarker.setLatLng([modalLat, modalLng]);
        locationMap.setView([modalLat, modalLng], 16);
        updateModalInfo(modalLat, modalLng, displayName);

        document.getElementById('search-results').classList.add('hidden');
        document.getElementById('location-search').value = displayName.split(',')[0];
    }

    function detectMyLocation() {
        if (!navigator.geolocation) {
            alert('Geolocation tidak didukung oleh browser ini.');
            return;
        }
        navigator.geolocation.getCurrentPosition(
            function (pos) {
                var lat = pos.coords.latitude;
                var lng = pos.coords.longitude;
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
                updateLocationPreview(lat, lng, 'Lokasi terdeteksi');
            },
            function () {
                alert('Gagal mendeteksi lokasi. Pastikan izin lokasi diaktifkan.');
            }
        );
    }

    function detectLocationInModal() {
        if (!navigator.geolocation) {
            alert('Geolocation tidak didukung oleh browser ini.');
            return;
        }
        navigator.geolocation.getCurrentPosition(
            function (pos) {
                modalLat = pos.coords.latitude;
                modalLng = pos.coords.longitude;
                locationMarker.setLatLng([modalLat, modalLng]);
                locationMap.setView([modalLat, modalLng], 16);
                reverseGeocode(modalLat, modalLng);
            },
            function () {
                alert('Gagal mendeteksi lokasi. Pastikan izin lokasi diaktifkan.');
            }
        );
    }

    function updateLocationPreview(lat, lng, address) {
        var preview = document.getElementById('location-preview');
        preview.className = 'bg-gray-50 rounded-xl p-4 border-2 border-primary/30';
        preview.innerHTML =
            '<div class="flex items-start gap-3">' +
                '<div class="flex-1 min-w-0">' +
                    '<p class="text-sm font-medium text-accent truncate">' + (address || 'Lokasi dipilih') + '</p>' +
                    '<p class="text-xs text-gray-500 mt-0.5">Lat: <span class="font-mono">' + lat.toFixed(6) + '</span>, Lng: <span class="font-mono">' + lng.toFixed(6) + '</span></p>' +
                '</div>' +
                '<a href="https://www.google.com/maps?q=' + lat + ',' + lng + '" target="_blank" rel="noopener noreferrer"' +
                   ' class="text-xs text-primary hover:text-secondary font-semibold inline-flex items-center gap-1 transition-colors duration-200 shrink-0">' +
                    '<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />' +
                    '</svg>' +
                    'Buka Maps' +
                '</a>' +
            '</div>';
    }

    function saveLocationFromModal() {
        if (modalLat === null || modalLng === null) {
            alert('Silakan pilih lokasi terlebih dahulu.');
            return;
        }
        document.getElementById('latitude').value = modalLat.toFixed(6);
        document.getElementById('longitude').value = modalLng.toFixed(6);
        updateLocationPreview(modalLat, modalLng, modalAddress);
        closeLocationModal();
    }
</script>
@endpush
