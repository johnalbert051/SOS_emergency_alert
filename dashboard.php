<?php
// admin_dashboard.php

session_start();
$last_location = $_SESSION['last_location'] ?? null;

// if ($last_location) {
//     echo "Last known location: Latitude: " . $last_location['latitude'] . ", Longitude: " . $last_location['longitude'];
// } else {
//     echo "No location data available.";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emergency SOS Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }
    .dashboard {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    h1 {
      color: #d9534f;
      text-align: center;
      font-size: 24px;
    }
    .sos-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }
    .sos-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      transition: transform 0.3s ease;
    }
    .sos-card:hover {
      transform: translateY(-5px);
    }
    .sos-card h2 {
      margin-top: 0;
      color: #d9534f;
      font-size: 20px;
    }
    .sos-card p {
      margin: 5px 0;
      font-size: 14px;
    }
    .status {
      font-weight: bold;
      text-transform: uppercase;
    }
    .new { color: #d9534f; }
    .in-progress { color: #f0ad4e; }
    .resolved { color: #5cb85c; }
    #notification {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #d9534f;
      color: white;
      padding: 15px;
      border-radius: 5px;
      display: none;
      animation: fadeInOut 4s ease-in-out;
      z-index: 1000;
      font-size: 14px;
    }
    @keyframes fadeInOut {
      0%, 100% { opacity: 0; }
      10%, 90% { opacity: 1; }
    }
    #map {
      height: 300px;
      margin-bottom: 20px;
      border-radius: 10px;
    }
    
    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1000;
      top: 0;
      left: -250px;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidebar a {
      padding: 16px;
      text-decoration: none;
      font-size: 18px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover {
      color: #f1f1f1;
    }

    .sidebar hr {
      border: 0;
      height: 1px;
      background-color: #818181;
      margin: 15px 0;
    }

    .content {
      transition: margin-left .5s;
      padding: 20px;
    }

    .sidebar .logo {
      text-align: center;
      padding: 20px 0;
    }

    .sidebar .logo img {
      max-width: 100px;
      height: auto;
      border-radius: 50%;
    }

    .sidebar a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }

    .sidebar h2 {
      color: #fff;
      font-weight: 300;
      font-size: 15px;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 20px 0 10px;
      padding: 0 16px;
    }

    #menuToggle {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1001;
      font-size: 30px;
      cursor: pointer;
      color: #d9534f;
    }

    @media screen and (max-width: 768px) {
      .sidebar {
        padding-top: 15px;
      }
      .sidebar a {
        font-size: 18px;
      }
      .content {
        margin-left: 0;
      }
      .sos-list {
        grid-template-columns: 1fr;
      }
      #map {
        height: 250px;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZRfvMMjOdGIagWecWKW_emC8tif8ndog"></script>
</head>
<body>
  <div id="menuToggle" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
  </div>

  <div class="sidebar" id="sidebar">
    <div class="logo">
      <img src="logo.jpg" alt="Emergency SOS Logo">
      <h1>Emergency SOS</h1>
    </div>
    <h2>Main Menu</h2>
    <a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#inbox"><i class="fas fa-inbox"></i> Inbox</a>
    <a href="#resident-record"><i class="fas fa-users"></i> Resident Record</a>
    <a href="#report"><i class="fas fa-chart-bar"></i> Report</a>
    <a href="users.php"><i class="fas fa-users"></i> Users</a>
    <hr>
    <h2>Help & Services</h2>
    <a href="#help-center"><i class="fas fa-question-circle"></i> Help Center</a>
    <a href="#settings"><i class="fas fa-cog"></i> Settings</a>
    <a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="content" id="dashboard">
    <div class="dashboard">
      <h1>Emergency SOS Dashboard</h1>
      <div id="map"></div>
      <div class="sos-list" id="sosList"></div>
    </div>
  </div>
  <div id="notification"></div>

  <script>
    const sosList = document.getElementById('sosList');
    const notification = document.getElementById('notification');
    let map;
    let markers = [];
    let userLat, userLng; // Variables to store user's location

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 0, lng: 0},
        zoom: 2
      });
    }

    function addMarker(lat, lng, title) {
      const marker = new google.maps.Marker({
        position: {lat, lng},
        map: map,
        title: title
      });
      markers.push(marker);
    }

    function createSOSCard(sos) {
      const card = document.createElement('div');
      card.className = 'sos-card';
      card.innerHTML = `
        <h2>${sos.type}</h2>
        <p><strong>Location:</strong> ${sos.location}</p>
        <p><strong>Time:</strong> ${sos.time}</p>
        <p><strong>Description:</strong> ${sos.description}</p>
        <p class="status ${sos.status.toLowerCase()}">${sos.status}</p>
      `;
      return card;
    }

    function addSOS(sos) {
      const card = createSOSCard(sos);
      sosList.prepend(card);
      
      // Use user's location for the SOS alert
      addMarker(userLat, userLng, sos.type);
      showNotification(`New SOS: ${sos.type} at your location.`);
    }

    function showNotification(message) {
      notification.textContent = message;
      notification.style.display = 'block';
      setTimeout(() => {
        notification.style.display = 'none';
      }, 4000);
    }

    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const content = document.getElementById('content');
      if (sidebar.style.left === '0px') {
        sidebar.style.left = '-250px';
        content.style.marginLeft = '0';
      } else {
        sidebar.style.left = '0px';
        content.style.marginLeft = '250px';
      }
    }

    function updateUserLocation(position) {
      userLat = position.coords.latitude; // Store user's latitude
      userLng = position.coords.longitude; // Store user's longitude
      map.setCenter({ lat: userLat, lng: userLng }); // Center the map on the user's location

      // Check if the marker already exists
      if (markers.length > 0) {
        // Update the existing marker's position
        markers[0].setPosition({ lat: userLat, lng: userLng });
      } else {
        // Create a new marker for the user's location
        addMarker(userLat, userLng, 'Your Location');
      }

      showNotification(`Your location has been updated on the map.`);
    }

    function handleLocationError(error) {
      console.error("Error: " + error.message);
      showNotification("Unable to retrieve your location.");
    }

    function startTrackingUserLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(updateUserLocation, handleLocationError, {
          enableHighAccuracy: true, // Use high accuracy if available
          maximumAge: 0, // Do not use cached position
          timeout: 5000 // Timeout after 5 seconds
        });
      } else {
        showNotification("Geolocation is not supported by this browser.");
      }
    }

    // Fetch user locations when the dashboard loads
    function fetchUserLocations() {
        fetch('fetch_user_locations.php')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    data.forEach(location => {
                        const sos = {
                            type: 'User Location', // You can customize this
                            location: `Lat: ${location.latitude}, Lng: ${location.longitude}`,
                            time: new Date(location.timestamp).toLocaleTimeString(),
                            description: 'User location retrieved from database.',
                            status: 'Resolved', // You can customize this
                        };
                        addSOS(sos); // Call the function to create SOS card
                    });
                } else {
                    console.error('Error fetching locations:', data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching user locations:', error);
            });
    }

    // Call the function to fetch user locations
    fetchUserLocations();
    initMap();
    startTrackingUserLocation(); // Start tracking the user's location
  </script>
</body>
</html>