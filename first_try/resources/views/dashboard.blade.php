<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <!-- Dashboard CSS -->
  <link rel="stylesheet" href="{{ asset('css/dashboard-map.css') }}">
</head>

<body>
  <!-- ✅ TOP BAR: Welcome + Search + Logout -->
  <div class="topbar">
    <div class="left">
      <h2 class="welcome">Welcome, {{ auth()->user()->name }}</h2>
    </div>

    <div class="right">
      <div class="search-mini">
        <input
          id="searchInput"
          class="search-input"
          type="text"
          placeholder="Search place..."
        />
        <button id="searchBtn" class="btn" type="button">Search</button>
      </div>

      <form method="POST" action="/logout" class="logout-form">
        @csrf
        <button class="btn btn-logout" type="submit">Logout</button>
      </form>
    </div>
  </div>

  <!-- ✅ COORDS CARD -->
  <div class="card">
    <div class="coords" id="coords">Click the map to get latitude & longitude.</div>
    <div class="hint" id="hint"></div>
  </div>

  <!-- MAP -->
  <div id="map"></div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    const defaultLat = 8.3132;
    const defaultLng = 124.8613;

    const map = L.map("map").setView([defaultLat, defaultLng], 12);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    const coordsEl = document.getElementById("coords");
    const hintEl = document.getElementById("hint");
    const searchInput = document.getElementById("searchInput");
    const searchBtn = document.getElementById("searchBtn");

    function setCoords(lat, lng) {
      coordsEl.textContent = `Latitude: ${lat.toFixed(6)} | Longitude: ${lng.toFixed(6)}`;
    }

    function setHint(msg) {
      hintEl.textContent = msg || "";
    }

    setCoords(defaultLat, defaultLng);

    map.on("click", (e) => {
      marker.setLatLng(e.latlng);
      setCoords(e.latlng.lat, e.latlng.lng);
      setHint("");
    });

    marker.on("dragend", () => {
      const pos = marker.getLatLng();
      setCoords(pos.lat, pos.lng);
      setHint("");
    });

    async function searchPlace() {
      const q = (searchInput.value || "").trim();
      if (!q) {
        setHint("Type a place name first.");
        return;
      }

      setHint("Searching...");

      try {
        const url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(q)}`;
        const res = await fetch(url, { headers: { "Accept": "application/json" } });

        if (!res.ok) throw new Error("Search failed");

        const data = await res.json();

        if (!data || data.length === 0) {
          setHint("No results. Try a more specific keyword.");
          return;
        }

        const lat = parseFloat(data[0].lat);
        const lng = parseFloat(data[0].lon);

        map.setView([lat, lng], 15);
        marker.setLatLng([lat, lng]);
        setCoords(lat, lng);

        setHint(data[0].display_name || "Found!");
      } catch (err) {
        setHint("Error searching. Check internet connection and try again.");
      }
    }

    searchBtn.addEventListener("click", searchPlace);

    searchInput.addEventListener("keydown", (e) => {
      if (e.key === "Enter") searchPlace();
    });
  </script>
</body>
</html>