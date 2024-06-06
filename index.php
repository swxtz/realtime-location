<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.PNG">
    <title>Mapa</title>
</head>
<body>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>

    <div id="map"></div>

    <button id="find-me">Procurar sua localização</button><br />
    <p id="status"></p>
    <a id="map-link" target="_blank"></a>

    <style>
        #map { height: 600px; width: 700px; }
    </style>

    <script>
    
    function geoFindMe() {
  const status = document.querySelector("#status");
  const mapLink = document.querySelector("#map-link");

  mapLink.href = "";
  mapLink.textContent = "";

  function success(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    status.textContent = "";
    mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
    mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
    var map = L.map('map').setView([latitude,longitude], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([latitude,longitude]).addTo(map);

  }

  function error() {
    status.textContent = "Não foi possível acessar sua localização";
  }

  if (!navigator.geolocation) {
    status.textContent = "Geolocalização não é suportada em seu navegador";
  } else {
    status.textContent = "Localizando...";
    navigator.geolocation.getCurrentPosition(success, error);

  }
}

document.querySelector("#find-me").addEventListener("click", geoFindMe);
    </script>
</body>
</html>