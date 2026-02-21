<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Leaflet CSS -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  />

  <!-- Dashboard CSS -->
  <link rel="stylesheet" href="{{ asset('css/dashboard-map.css') }}">
</head>

<body>
  <div class="topbar">
    <h2>Welcome, {{ auth()->user()->name }}</h2>

    <form method="POST" action="/logout">
      @csrf
      <button class="btn" type="submit">Logout</button>
    </form>
  </div>

  <div class="card">
    <div class="coords" id="coords">
      Click the map to get latitude & longitude.
    </div>
  </div>

  <div id="map"></div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    // ✅ Default center (Manolo Fortich)
    const defaultLat = 8.3432;
    const defaultLng = 124.8613;

    // create map
    const map = L.map("map").setView([defaultLat, defaultLng], 12);

    // OpenStreetMap tiles
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // draggable marker
    const marker = L.marker([defaultLat, defaultLng], {
      draggable: true
    }).addTo(map);

    const coordsEl = document.getElementById("coords");

    function setCoords(lat, lng) {
      coordsEl.textContent =
        `Latitude: ${lat.toFixed(6)} | Longitude: ${lng.toFixed(6)}`;
    }

    // initial coords
    setCoords(defaultLat, defaultLng);

    // click map
    map.on("click", (e) => {
      marker.setLatLng(e.latlng);
      setCoords(e.latlng.lat, e.latlng.lng);
    });

    // drag marker
    marker.on("dragend", () => {
      const pos = marker.getLatLng();
      setCoords(pos.lat, pos.lng);
    });
  </script>
</body>
</html>