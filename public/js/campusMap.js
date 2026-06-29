export function initCampusMap(containerId, menuId, imageUrl) {
    const imageWidth = 2000;
    const imageHeight = 1000;
    const bounds = [[0, 0], [imageHeight, imageWidth]];

    // Inicializar mapa
    const map = L.map(containerId, {
        crs: L.CRS.Simple,
        minZoom: -1.6,
        maxZoom: 1,
        zoomControl: true,
        attributionControl: false,
        maxBounds: bounds,        // Limitar movimiento fuera de la imagen
        maxBoundsViscosity: 1.0  // Evita que el usuario se salga incluso suavemente
    });

    // Imagen del campus
    const image = L.imageOverlay(imageUrl, bounds).addTo(map);
    map.fitBounds(bounds); // Ajusta el mapa al tamaño de la imagen

    // Ajustar el contenedor al tamaño de la imagen (proporcional)
    const container = document.getElementById(containerId);
    container.style.width = "100%";
    container.style.height = "600px"; // Mantener alto fijo o puedes calcular proporcional

    // Punto inicial: Entrada principal
    const startCoords = [820, 287];
    const userMarker = L.circleMarker(startCoords, {
        radius: 10,
        color: "red",
        fillColor: "#ff5555",
        fillOpacity: 0.8
    }).addTo(map).bindPopup("Your position").openPopup();

    // Hotspots (destinos)
    const hotspots = [
        { name: "1 Auditorium", coords: [786, 1273] },
        { name: "1-6: Classrooms", coords: [734, 1153] },
        { name: "7-8: Labs", coords: [726, 1080] },
        { name: "9-12: Classrooms", coords: [668, 1447] },
        { name: "13: Speakers Lounge", coords: [604, 1461] },
        { name: "14: Cafeteria", coords: [530, 1161] }
    ];

    const menu = document.getElementById(menuId);
    let routeLine;

    hotspots.forEach(h => {
        const btn = document.createElement('button');
        btn.className = "btn btn-primary mb-2";
        btn.innerText = h.name;
        btn.style.width = "100%";
        menu.appendChild(btn);

        L.marker(h.coords).addTo(map).bindPopup(`<b>${h.name}</b>`);

        btn.addEventListener('click', () => {
            drawRoute(h.coords);
            moveUserTo(h.coords);
        });
    });

    function drawRoute(destCoords) {
        if (routeLine) map.removeLayer(routeLine);

        routeLine = L.polyline([startCoords, destCoords], {
            color: 'blue',
            weight: 4,
            dashArray: '10,10',
            opacity: 0.9
        }).addTo(map);
    }

    function moveUserTo(destCoords) {
        const steps = 50;
        const latStep = (destCoords[0] - startCoords[0]) / steps;
        const lngStep = (destCoords[1] - startCoords[1]) / steps;
        let i = 0;

        const interval = setInterval(() => {
            if (i > steps) {
                clearInterval(interval);
                startCoords[0] = destCoords[0];
                startCoords[1] = destCoords[1];
                return;
            }
            const newLat = startCoords[0] + latStep * i;
            const newLng = startCoords[1] + lngStep * i;
            userMarker.setLatLng([newLat, newLng]);
            i++;
        }, 30);
    }
    //Opcional: clic en mapa para ver coordenadas
    // map.on('click', function (e) {
    //     const lat = e.latlng.lat;
    //     const lng = e.latlng.lng;
    //     console.log(`Clicked: Lat=${lat.toFixed(2)}, Lng=${lng.toFixed(2)}`);
    //     L.marker([lat, lng]).addTo(map)
    //         .bindPopup(`You clicked here:<br>Lat: ${lat.toFixed(2)}, Lng: ${lng.toFixed(2)}`)
    //         .openPopup();
    // });

    return map;
}


document.addEventListener('DOMContentLoaded', function () {
    const scrollBtn = document.getElementById('scrollToMapBtn');
    const mapSection = document.querySelector('.campus-map');

    if (scrollBtn && mapSection) {
        scrollBtn.addEventListener('click', function () {
            // Si el header es fijo, ajusta el desplazamiento manualmente
            const headerHeight = 80; // cambia según la altura real del header
            const offsetTop = mapSection.getBoundingClientRect().top + window.pageYOffset - headerHeight;

            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        });
    }
});