const menuIcon = document.querySelector(".hamburger-menu");
const navbar = document.querySelector(".navbar");


menuIcon.addEventListener("click", () => {
	navbar.classList.toggle("change");
})

function mapView(){
    const area = document.querySelector(".target");
    const div = document.createElement('div');
    div.setAttribute("id","map");
    area.appendChild(div);
    var map = L.map('map').setView([51.505, -0.09], 13);
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map);
}