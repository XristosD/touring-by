"use strict";


function initMap() {
  var oldLatLong = latLongExists();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 18,
    center: oldLatLong == null ? { lat: -33.8688, lng: 151.2195 } : oldLatLong,
  });
  new google.maps.Marker({
    position: oldLatLong == null ? { lat: -33.8688, lng: 151.2195 } : oldLatLong,
    map,
    title: "Hello World!"
  });
}

let mymarker = null;

function initAutocomplete() {
  var oldLatLong = latLongExists();
  const map = new google.maps.Map(document.getElementById("map"), {
    center: oldLatLong == null ? { lat: -33.8688, lng: 151.2195 } : oldLatLong,
    // center:  { lat: -33.8688, lng: 151.2195 },
    zoom: 18,
    streetViewControl: false,
    mapTypeControl: false,
    styles: [ 
      { 
        "featureType": "poi", 
        "stylers": [ 
          { "visibility": "off" } 
        ] 
      } 
    ],
    mapTypeId: "roadmap"
  });
  // Create the search box and link it to the UI element.
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  if(oldLatLong){
    placeMarker(oldLatLong, map);
  }
  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
  map.addListener('click', function(e) {
    mymarker = placeMarker(e.latLng, map);
  });
  let markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    // Clear out the old markers.
    markers.forEach(marker => {
      marker.setMap(null);
    });
    markers = [];
    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();
    places.forEach(place => {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
      const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };
      // Create a marker for each place.
      markers.push(
        new google.maps.Marker({
          map,
          icon,
          title: place.name,
          position: place.geometry.location
        })
      );

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    markers.forEach(marker => {
      marker.addListener('click', function(e) {
        mymarker = placeMarker(e.latLng, map);
      })
    });
    map.fitBounds(bounds);
  });
}

function placeMarker(position, map) {
  if(mymarker == null){
    mymarker = new google.maps.Marker({
      position: position,
      map: map
    });
  }else{
    mymarker.setPosition(position)
  }
  mymarker.setZIndex(1);
  map.panTo(position);
  formStatus();
  return mymarker;
}

function formStatus() {
  var latInp = document.getElementById("latitude");
  var longInp = document.getElementById("longitude");
  var position = mymarker.position.toJSON();
  latInp.value = position["lat"];
  longInp.value = position["lng"];
  // if(inp.value.length > 0){
  //   document.getElementById("submitPosition").disabled = false;
  // }
}

function latLongExists(){
  var latInp = document.getElementById("latitude");
  var longInp = document.getElementById("longitude");
  if( latInp.value != "" && longInp != ""){
    return { lat: parseFloat(latInp.value), lng: parseFloat(longInp.value) };
  }
  else{
    return null;
  }
}
