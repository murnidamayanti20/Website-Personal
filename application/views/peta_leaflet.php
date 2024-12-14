<div class="content"> ​
   <div id="map" style="width: 100%; height: 530px; color:black;">
   </div> ​

</div> 
<script>

// var
// var prov = new L.LayerGroup();
// var faskes = new L.LayerGroup();
var sungai = new L.LayerGroup();
// var provin = new L.LayerGroup();
var sungaitangsel = new L.LayerGroup();
var kecamatanciputattimur = new L.LayerGroup();
// var jalantangsel = new L.LayerGroup();
// end var


// map
var map = L.map('map', {
 center: [-6.2982011, 106.757507],
 zoom: 13,
 zoomControl: false,
 layers:[]
});
var GoogleSatelliteHybrid= L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
maxZoom: 22,
attribution: 'Latihan Web GIS'
}).addTo(map);
//end map

// basemap esri
var Esri_NatGeoWorldMap =
L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/NatGeo_World_Map/MapServer/tile/{z}/{y}/{x}', {
attribution: 'Tiles &copy; Esri &mdash; National Geographic, Esri, DeLorme,NAVTEQ, UNEP-WCMC, USGS, NASA, ESA, METI, NRCAN, GEBCO, NOAA, iPC',
maxZoom: 16
});

// googlemaps
var GoogleMaps = new
L.TileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', { opacity: 1.0,
attribution: 'Latihan Web GIS'
});
//end googlemaps

//googleroads
var GoogleRoads = new
L.TileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}',{
opacity: 1.0,
attribution: 'Latihan Web GIS'
});
//end google road


	// control layers
var baseLayers = {'Google Satellite Hybrid': GoogleSatelliteHybrid,'Esri_NatGeoWorldMap':Esri_NatGeoWorldMap,'GoogleMaps': GoogleMaps,'GoogleRoads':GoogleRoads};
// var overlayLayers = {}
// L.control.layers(baseLayers, overlayLayers, {collapsed: true}).addTo(map);
// end control layers

// provinsi
var groupedOverlays = {
"Peta Dasar":{
	// 'Ibu Kota Provinsi' :prov,
	// 'Jaringan Sungai':sungai,
	// 'Provinsi' :provin,
  'Sungai Tangerang Selatan': sungaitangsel,
  'Kecamatan Ciputat Timur' : kecamatanciputattimur,
  // 'Jalan Tangerang Selatan' : jalantangsel
}
// "Peta Khusus":{
// 	'Fasilitas Kesehatan' :faskes
// }
};
L.control.groupedLayers(baseLayers, groupedOverlays).addTo(map);
// end provinsi


//mini map
var
osmUrl='https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';
var osmAttrib='Map data &copy; OpenStreetMap contributors';
var osm2 = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 13, attribution: osmAttrib });
var rect1 = {color: "#ff1100", weight: 3};
var rect2 = {color: "#0000AA", weight: 1, opacity:0, fillOpacity:0};
var miniMap = new L.Control.MiniMap(osm2, {toggleDisplay: true, position : "bottomright",
aimingRectOptions : rect1, shadowRectOptions: rect2}).addTo(map);

//minimap

// geocoder
const geo = L.Control.geocoder({position :"topleft", collapsed:true}).addTo(map);
// endgecoder

// koordinat
/* GPS enabled geolocation control set to follow the user's location */
/* GPS enabled geolocation control set to follow the user's location */
var locateControl = L.control.locate({
position: "topleft",
drawCircle: true,
follow: true,
setView: true,
keepCurrentZoomLevel: true,
markerStyle: {
weight: 1,
opacity: 0.8,
fillOpacity: 0.8
},
circleStyle: {
weight: 1,
clickable: false
},
icon: "fa fa-location-arrow",
metric: false,
strings: {
title: "My location",
popup: "You are within {distance} {unit} from this point",
outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
},
locateOptions: {
maxZoom: 18,
watch: true,
enableHighAccuracy: true,
maximumAge: 10000,
timeout: 10000
}
}).addTo(map);
// koordinat

// controlzoombar
var zoom_bar = new L.Control.ZoomBar({position: 'topleft'}).addTo(map);
// end control zoombar


// leaflet coordinates
L.control.coordinates({
position:"bottomleft",
decimals:2,
decimalSeperator:",",
labelTemplateLat:"Latitude: {y}",
labelTemplateLng:"Longitude: {x}"
}).addTo(map);
/* scala */
L.control.scale({metric: true, position: "bottomleft"}).addTo(map);
// leaflet coordinates

// mata angin
var north = L.control({ position: 'bottomleft' });

north.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend');
    div.innerHTML = '<img src="<?=base_url()?>assets/arah-mata-angin.png"style=width:200px;>';  
    return div;
};

north.addTo(map);
//mataangin


// geojson provinsi
// $.getJSON("assets/provinsi.geojson",function(data){
// var ratIcon = L.icon({
// iconUrl: 'assets/images/marker.png',
// iconSize: [12,10]
// });
// L.geoJson(data,{
// pointToLayer: function(feature,latlng){
// var marker = L.marker(latlng,{icon: ratIcon});
// marker.bindPopup(feature.properties.CITY_NAME);
// return marker;
// }
// }).addTo(prov);
// });

// enndgeojson

//geojson rsu
// $.getJSON("assets/rsu.geojson",function(data){
// var ratIcon = L.icon({
// iconUrl: 'assets/images/marker2.png',
// iconSize: [12,10]
// });
// L.geoJson(data,{
// pointToLayer: function(feature,latlng){
// var marker = L.marker(latlng,{icon: ratIcon});
// marker.bindPopup(feature.properties.NAMOBJ);
// return marker;
// }
// }).addTo(faskes);
// });
//end geojson

//poliklinik geojson
// $.getJSON("assets/poliklinik.geojson",function(data){
// var ratIcon = L.icon({
// iconUrl: 'assets/images/marker3.png',
// iconSize: [12,10]
// });
// L.geoJson(data,{
// pointToLayer: function(feature,latlng){
// var marker = L.marker(latlng,{icon: ratIcon});
// marker.bindPopup(feature.properties.NAMOBJ);
// return marker;
// }
// }).addTo(faskes);
// });
//end geojson

//geojson puskesmas
// $.getJSON("assets/puskesmas.geojson",function(data){
// var ratIcon = L.icon({
// iconUrl: 'assets/images/marker4.png',
// iconSize: [12,10]
// });
// L.geoJson(data,{
// pointToLayer: function(feature,latlng){
// var marker = L.marker(latlng,{icon: ratIcon});
// marker.bindPopup(feature.properties.NAMOBJ);
// return marker;
// }
// }).addTo(faskes);
// });
//end geojson

//geojson sungai
// $.getJSON("assets/sungai.geojson",function(kode){
//  L.geoJson( kode, {
//  style: function(feature){
//  var color,
//  kode = feature.properties.kode;
//  if ( kode < 2 ) color = "#f2051d";
//  else if ( kode > 0 ) color = "#f2051d";
//  else color = "#f2051d"; // no data
//  return { color: "#999", weight: 5, color: color, fillOpacity: .8 };
//  },
//  onEachFeature: function( feature, layer ){
//  layer.bindPopup
//  ()
//  } }).addTo(sungai);
// });
//end geojson

// sungai ciputat timur
$.getJSON("assets/sungai_ciputat_timur.geojson", function (kode) {
  L.geoJson(kode, {
    style: function (feature) {
      var color = "#ffff00"; // warna kuning
      return { color: color, weight: 5, fillOpacity: 0.8 };
    },
    onEachFeature: function (feature, layer) {
      layer.bindPopup();
    },
  }).addTo(sungaitangsel);
});
// end sungai ciputat timur

// batas wilayah ciputat timur
$.getJSON("assets/kecamatan_ciputat_timur.geojson", function (kode) {
  L.geoJson(kode, {
    style: function (feature) {
      var color = "#00FFFF"; // cyan
      return { color: color, weight: 5, fillOpacity: 0.10 };
    },
    onEachFeature: function (feature, layer) {
      layer.bindPopup();
    },
  }).addTo(kecamatanciputattimur);
});
// end sungai ciputat timur

var markersDataKos = [
	{
    coords: [-6.287208614698011, 106.7629680655026],
    popupText: "<b>Kos Putri'98 Rempoa</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jalan Mawar II RT01/03 No.98, Rempoa, Ciputat Timur, South Tangerang City, Banten 15412<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja, lemari pakaian kecil), Kamar mandi luar, Wi-Fi (shared), Dapur (shared), Balkon, Non-AC, Jemuran, Area parkir motor, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 1.000.000/bulan<br><br><img src='assets/foto/1 - Kos Putri Rempoa 98.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.307308070782501, 106.75707612883564],
    popupText: "<b>Kos Assalam</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Pondokan ASSALAM, Jl. Limun No.14A, Pisangan, Ciputat Timur, South Tangerang City, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja, lemari pakaian kecil), Kamar mandi luar, Wi-Fi (shared), Dapur (shared), Balkon, Non-AC, Jemuran, Area parkir motor, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 1.500.000/bulan<br><br><img src='assets/foto/2 - Kos Assalam.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.3079798433868195, 106.75742004232868],
    popupText: "<b>Kos Putri Novita</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Limun No.23, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419, Indonesia<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja belajar, lemari kecil), Kamar mandi bersama, Wi-Fi (shared), Non-AC, Jemuran, Area parkir motor, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 700.000/bulan<br><br><img src='assets/foto/3 - Kos Putri Novita.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.308091024543143, 106.75833099433858],
    popupText: "<b>Kos Vanilla</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Kertamukti Gg. Leman No.25, RW.RW, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15412<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja kecil, lemari pakaian), AC, Kamar mandi dalam, Wi-Fi (shared), CCTV, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 1.300.000/bulan<br><br><img src='assets/foto/4 - Kos Vanilla.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.310680000189682, 106.75867972883563],
    popupText: "<b>Kos Griya K189C</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Kertamukti No.189c, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja, lemari pakaian), AC, Kamar mandi dalam, Balkon, Laundry, Wi-Fi (shared), Area parkir motor, Keamanan 24 jam, Penjaga/bersih-bersih<br><br><b>Harga:</b><br>Rp. 2.000.000/bulan<br><br><img src='assets/foto/5 - Kos Griya189C.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.311176164238738, 106.76115469999999],
    popupText: "<b>Kostel Residence Cendekia Ciputat</b><br><b>Khusus Campur</b><br><b>Alamat:</b><br>Jl. Pisangan Raya, Cireundeu, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard, Kamar mandi dalam, Wi-Fi (shared), Laundry, AC, Area parkir motor/mobil, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 1.100.000/bulan<br><br><img src='assets/foto/6 - Kostel Residence Cendekia Ciputat.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.3106959895925945, 106.75865826550292],
    popupText: "<b>Kos Tulip</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Kertamukti Gg. Buni No.88e Rt05, RW.09, Cireundeu, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja kecil, lemari pakaian), Kamar mandi luar, Wi-Fi (shared), Dapur (shared), Area parkir motor, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 800.000/bulan<br><br><img src='assets/foto/7 - Kos Tulip.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.3135632184091035, 106.75894322317436],
    popupText: "<b>Kos Putri Aisyah</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Kertamukti No.100, Cireundeu, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja kecil, lemari pakaian), Kamar mandi luar, Non-AC, Non Wi-Fi, Area parkir motor, Dapur bersama, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 650.000/bulan<br><br><img src='assets/foto/8 - Kos Putri Aisyah.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.3192476406941545, 106.76946040000001],
    popupText: "<b>Kos Ridwan Yon Suyudi</b><br><b>Khusus Pria</b><br><b>Alamat:</b><br>Jalan Cirendeu gang bidan RT03 RW 03, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur double, meja belajar), Kamar mandi luar, Wi-Fi (shared), Dapur bersama, Non-AC, Area parkir motor, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 900.000/bulan<br><br><img src='assets/foto/9 - Kos Ridwan Yon Suyudi.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.306802011587501, 106.75713069564435],
    popupText: "<b>Kos Griya Aini</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. H. Nipan, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja kecil, lemari pakaian), Kamar mandi dalam, Non-AC, Dapur bersama, Jemuran, Wi-Fi (shared), Keamanan 24 jam, Penjaga/bersih-bersih<br><br><b>Harga:</b><br>Rp. 1.200.000/bulan<br><br><img src='assets/foto/10 - Kos Griya Aini.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.306323007165744, 106.75200444152632],
    popupText: "<b>Kos Mansyur</b><br><b>Khusus Pria</b><br><b>Alamat:</b><br>Jl. Pesanggrahan No.56, RW.4, Cemp. Putih, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15412<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja belajar), Kamar mandi luar, Wi-Fi (shared), Non-AC, Keamanan 24 jam, Penjaga/bersih-bersih<br><br><b>Harga:</b><br>Rp. 650.000/bulan<br><br><img src='assets/foto/11 - Kos Mansyur.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
    coords: [-6.305028381241829, 106.75304632538923],
    popupText: "<b>Kos Puteri Puri Ellysia</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Kost Puteri Puri Ellysia, Jl. Al-Ikhlas No.43, Cemp. Putih, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15412<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja belajar, lemari pakaian), Non-AC, Kamar mandi bersama, Wi-Fi (shared), Keamanan 24 jam, Setrikaan, Dapur (shared), Jemuran + mesin cuci, Penjaga/bersih-bersih<br><br><b>Harga:</b><br>Rp. 800.000/bulan<br><br><img src='assets/foto/12 - Kos Puteri Puri Ellysia.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
    coords: [-6.303663770203702, 106.7530596808455],
    popupText: "<b>Kos Pondok Anisa</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Pondok Annisa, Jl. Al-Ikhlas No.99, RT.3/RW.4, Cemp. Putih, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15412<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja, lemari pakaian kecil), Kamar mandi luar, Wi-Fi (shared), Non-AC, Area parkir motor, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 750.000/bulan<br><br><img src='assets/foto/13 - Kos Pondok Anisa.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
  coords: [-6.316011213457461, 106.76988955156106],
    popupText: "<b>Kos Telkom Griya Satwika</b><br><b>Khusus Pria</b><br><b>Alamat:</b><br>Jl. Perum Griya Satwika Telkom Blok C4 No.32, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Deluxe (kasur queen size, meja, lemari pakaian), AC, Kamar mandi dalam, Wi-Fi, Laundry kiloan, Area Parkir motor, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 1.800.000/bulan<br><br><img src='assets/foto/14 - Kos Telkom Griya Satwika.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
    coords: [-6.3191964952440705, 106.76088140847901],
    popupText: "<b>Kos Berkah</b><br><b>Khusus Pria</b><br><b>Alamat:</b><br>Jl. Purnawarman No.43, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja, lemari kecil), Kamar mandi dalam, Wi-Fi (shared), AC, Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 1.000.000/bulan<br><br><img src='assets/foto/15 - Kos Putra Berkah.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
    coords: [-6.31601512137089, 106.7515925725483],
    popupText: "<b>Kos Griya Aliyyah</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Mustika Raya No.8 Blok A9, Pisangan, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15419<br><br><b>Fasilitas:</b><br>Kamar Deluxe (kasur queen size, meja, lemari besar), AC, Kamar mandi dalam, Wi-Fi (shared), Keamanan 24 jam, Laundry kiloan<br><br><b>Harga:</b><br>Rp. 1.600.000/bulan<br><br><img src='assets/foto/16 - Kos Griya Aliyyah.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
    coords: [-6.306770062198714, 106.75302094232867],
    popupText: "<b>Kos Sakinah</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Pesanggrahan No.62, Cemp. Putih, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15412, Indonesia<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja, lemari kecil), Kamar mandi luar, Wi-Fi (shared), Keamanan 24 jam<br><br><b>Harga:</b><br>Rp. 850.000/bulan<br><br><img src='assets/foto/17 - Kos Sakinah.jpg' alt='Image 3' style='width:100%;'/><br>"
  },

  {
    coords: [-6.307029425913825, 106.75473252468967],
    popupText: "<b>Kos Manda</b><br><b>Khusus Wanita</b><br><b>Alamat:</b><br>Jl. Pesanggrahan No.39, Cemp. Putih, Kec. Ciputat Tim., Kota Tangerang Selatan, Banten 15412, Indonesia<br><br><b>Fasilitas:</b><br>Kamar Standard (kasur single, meja belajar, lemari kecil), Kamar mandi luar, Area Jemuran<br><br><b>Harga:</b><br>Rp. 500.000/bulan<br><br><img src='assets/foto/18 - Kos Manda.jpg' alt='Image 3' style='width:100%;'/><br>"
  },
  
];

markersDataKos.forEach(function(marker) {
  var newMarker = L.marker(marker.coords).addTo(kecamatanciputattimur);
  newMarker.bindPopup(marker.popupText).openPopup();
});

// // jalan_tangsel
// $.getJSON("assets/jalan_tangsel.geojson", function (kode) {
//   L.geoJson(kode, {
//     style: function (feature) {
//       var color = "#FF8000"; // warna kuning
//       return { color: color, weight: 5, fillOpacity: 0.20 };
//     },
//     onEachFeature: function (feature, layer) {
//       layer.bindPopup();
//     },
//   }).addTo(jalantangsel);
// });
// // jalan_tangsel


//geojson provinsi polygon
// $.getJSON("assets/provinsi_polygon.geojson",function(kode){
//  L.geoJson( kode, {
//  style: function(feature){
//  var fillColor,
//  kode = feature.properties.kode;
//  if ( kode > 21 ) fillColor = "#006837";
//  else if (kode>20) fillColor="#fec44f"
//  else if (kode>19) fillColor="#c2e699"
//  else if (kode>18) fillColor="#fee0d2"
//  else if (kode>17) fillColor="#756bb1"
//  else if (kode>16) fillColor="#8c510a"
//  else if (kode>15) fillColor="#01665e"
//  else if (kode>14) fillColor="#e41a1c"
//  else if (kode>13) fillColor="#636363"
//  else if (kode>12) fillColor= "#762a83"
//  else if (kode>11) fillColor="#1b7837"
//  else if (kode>10) fillColor="#d53e4f"
//  else if (kode>9) fillColor="#67001f"
//  else if (kode>8) fillColor="#c994c7"
//  else if (kode>7) fillColor="#fdbb84"
//  else if (kode>6) fillColor="#dd1c77"
//  else if (kode>5) fillColor="#3182bd"
//  else if ( kode > 4 ) fillColor ="#f03b20"
//  else if ( kode > 3 ) fillColor = "#31a354";
//  else if ( kode > 2 ) fillColor = "#78c679";
//  else if ( kode > 1 ) fillColor = "#c2e699";
//  else if ( kode > 0 ) fillColor = "#ffffcc";
//  else fillColor = "#f7f7f7"; // no data
//  return { color: "#999", weight: 1, fillColor: fillColor, fillOpacity: .6 };
//  },
//  onEachFeature: function( feature, layer ){
//  layer.bindPopup(feature.properties.PROV)
//  }
//  }).addTo(provin);
//  });
 //end geosjon
 
//end new map
</script>