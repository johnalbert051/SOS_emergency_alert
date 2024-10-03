<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SOS Emergency Alert</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    height: 100%;
    background-color: #f0f0f0;
  }
  .navbar {
    background-color: #d9534f;
    padding: 10px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
  }
  .navbar a {
    color: white;
    text-decoration: none;
    font-size: 16px; /* Adjusted for mobile */
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .navbar i {
    font-size: 24px;
  }
  .container {
    max-width: 100%; /* Full width on mobile */
    margin: 20px auto;
    padding: 10px; /* Reduced padding for mobile */
    text-align: center;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
  h1 {
    color: #d9534f;
    margin-bottom: 20px;
    font-size: 24px; /* Adjusted for mobile */
  }
  #sosButton {
    width: 150px; /* Adjusted for mobile */
    height: 150px; /* Adjusted for mobile */
    border-radius: 50%;
    background-color: #d9534f;
    border: none;
    color: white;
    font-size: 20px; /* Adjusted for mobile */
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    margin: 20px auto;
    display: block;
  }
  #sosButton:hover {
    background-color: #c9302c;
    transform: scale(1.05);
  }
  #sosButton:active {
    transform: scale(0.95);
  }
  #map {
    width: 100%;
    height: 200px; /* Adjusted for mobile */
    margin-top: 20px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  }
  .emergency-contacts, .inbox, .profile {
    margin-top: 20px;
    text-align: left;
    display: none; /* Hide by default */
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  .profile {
    display: block; /* Show profile by default */
  }
  .profile h2 {
    color: #333;
    margin-bottom: 10px;
  }
  .profile-info {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 15px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    justify-content: space-between; /* Added to space out items */
  }
  .profile-info img {
    border-radius: 50%;
    width: 60px; /* Adjusted for mobile */
    height: 60px; /* Adjusted for mobile */
    margin-right: 15px;
  }
  .profile-details {
    text-align: left;
  }
  .profile-details strong {
    display: block;
    margin-bottom: 5px;
    font-size: 14px; /* Adjusted for mobile */
    color: #333;
  }
  hr {
    border: 0;
    height: 1px;
    background: #ccc;
    margin: 10px 0;
  }
  .section-title {
    margin: 10px 0;
    font-size: 16px; /* Adjusted for mobile */
    font-weight: bold;
  }
  .logout {
    color: red;
    cursor: pointer;
    font-weight: bold;
  }
  .settings, .help-center, .about {
    margin: 10px 0;
    padding: 10px;
    background-color: #f1f1f1;
    border-radius: 5px;
    transition: background-color 0.3s;
    cursor: pointer;
  }
  .settings:hover, .help-center:hover, .about:hover {
    background-color: #e0e0e0;
  }
  .inbox {
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  .inbox-message {
    margin: 10px 0;
    display: flex;
    justify-content: flex-start; /* Default to incoming messages */
  }
  .inbox-message.outgoing {
    justify-content: flex-end; /* Align outgoing messages to the right */
  }
  .message-bubble {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 20px;
    color: white;
    font-size: 14px;
    line-height: 1.5;
  }
  .incoming .message-bubble {
    background-color: #e0e0e0; /* Light gray for incoming messages */
    color: #333; /* Dark text for readability */
  }
  .outgoing .message-bubble {
    background-color: #d9534f; /* Red for outgoing messages */
  }
  .message-input {
    display: flex;
    align-items: center;
    margin-top: 15px;
  }
  .message-input input {
    flex: 1;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  .message-input button {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    background-color: #d9534f;
    color: white;
    cursor: pointer;
    margin-left: 10px;
  }
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  input[type="text"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  button {
    background-color: #d9534f;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  button:hover {
    background-color: #c9302c;
  }
  /* Media Queries for Mobile Responsiveness */
  @media (max-width: 600px) {
    .navbar a {
      font-size: 14px; /* Smaller font size for mobile */
    }
    h1 {
      font-size: 20px; /* Smaller font size for mobile */
    }
    #sosButton {
      width: 120px; /* Smaller button for mobile */
      height: 120px; /* Smaller button for mobile */
      font-size: 18px; /* Smaller font size for mobile */
    }
    .profile-info img {
      width: 50px; /* Smaller profile picture for mobile */
      height: 50px; /* Smaller profile picture for mobile */
    }
    .profile-details strong {
      font-size: 12px; /* Smaller font size for mobile */
    }
    .message-input input {
      padding: 8px; /* Smaller padding for mobile */
    }
    .message-input button {
      padding: 8px; /* Smaller padding for mobile */
    }
  }
</style>
</head>
<body>
<div class="navbar">
  <a href="#home" onclick="showSection('home')"><i class="fas fa-home"></i> Home</a>
  <a href="#inbox" onclick="showSection('inbox')"><i class="fas fa-inbox"></i> Inbox</a>
  <a href="#profile" onclick="showSection('profile')"><i class="fas fa-user"></i> Profile</a>
</div>

<div class="container">
  <h1>Emergency Help Needed?</h1>
  <button id="sosButton">SOS</button>
  <div id="map"></div>
  
  <div class="emergency-contacts" id="emergencyContact">
    <h2>Emergency Contacts</h2>
    <ul>
      <li>Police: 911</li>
      <li>Fire Department: 911</li>
      <li>Ambulance: 911</li>
      <li>Poison Control: 1-800-222-1222</li>
    </ul>
  </div>

  <div class="inbox" id="inboxSection">
    <h2>Inbox Messages</h2>
    <div class="inbox-message incoming">
        <div class="message-bubble">
            <strong>Admin:</strong> Your SOS alert has been activated.
        </div>
    </div>
    <div class="inbox-message outgoing">
        <div class="message-bubble">
            <strong>You:</strong> Emergency services Needed.
        </div>
    </div>
    <div class="inbox-message incoming">
        <div class="message-bubble">
            <strong>Admin:</strong> Stay safe and keep your phone charged.
        </div>
    </div>

    <hr>

    <div class="message-input">
        <input type="text" id="customerMessage" placeholder="Type your message here..." style="width: 80%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        <button id="sendMessage" style="padding: 10px 15px; border: none; border-radius: 5px; background-color: #d9534f; color: white; cursor: pointer; margin-left: 10px;">Send</button>
    </div>
  </div>

  <div class="profile" id="profileSection">
    <h2>Profile Information</h2>
    <a  style="text-decoration: none; color: inherit;">
      <div class="profile-info" style="cursor: pointer;">
        <img src="https://via.placeholder.com/80" alt="Profile Picture">
        <div class="profile-details">
          <strong>Juan Dela Cruz</strong>
          <span>Banga 2nd, Plaridel, Bulacan</span>
        </div>
        <span class='btn-icon' style="font-size: 27px; margin-left: auto; color: #d9534f;">&#10095;</span>
      </div>
    </a>
    <hr>
    <a href="resident_information_form.php" style="text-decoration: none; color: inherit;">
    <h3 class="section-title" style="display: flex; justify-content: space-between; align-items: center;">
        Resident Information Form
        <span class='btn-icon' style="font-size: 24px; color: #d9534f;">&#10095;</span>
    </h3>
    </a>
    <hr>
    <div>
      <strong>Hotline:</strong>
      <ul>
        <li>ARFF Plaridel Station: 0997-657-6536</li>
        <li>Plaridel Ambulance: 0997-657-6536</li>
      </ul>
    </div>
    <hr>
    <div class="settings">Settings</div>
    <div class="help-center">Help Center</div>
    <div class="about">About</div>
    <hr>
    <div class="logout">Log out</div>
  </div>

  <!-- Modal Structure -->
  <div id="profileModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Update Profile</h2>
        <form id="updateProfileForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="Juan Dela Cruz" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="Banga 2nd, Plaridel, Bulacan" required>

            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" value="0997-657-6536" required>

            <button type="submit">Update</button>
        </form>
    </div>
  </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKEvwgVPHmv39D-JLIcjPKT-LJmZMBRg"></script>
<script>
let map, marker;
let isAlertActive = false;

function initMap() {
  const defaultLocation = { lat: -34.397, lng: 150.644 }; // Default location (can be anywhere)
  const mapOptions = {
    center: defaultLocation,
    zoom: 15
  };
  map = new google.maps.Map(document.getElementById('map'), mapOptions);
  marker = new google.maps.Marker({
    position: defaultLocation,
    map: map,
    title: 'Your Location',
    visible: false // Initially hide the marker
  });
}

function updateLocation(position) {
  const lat = position.coords.latitude;
  const lng = position.coords.longitude;
  
  map.setCenter({ lat, lng });
  marker.setPosition({ lat, lng });
  marker.setVisible(true); // Show the marker when the location is updated
}

function handleLocationError(error) {
  console.error("Error: " + error.message);
  document.getElementById('statusMessage').textContent = "Unable to retrieve your location";
}

function toggleAlert() {
  const sosButton = document.getElementById('sosButton');
  
  if (!isAlertActive) {
    isAlertActive = true;
    sosButton.classList.add('pulsing');
    sosButton.textContent = 'ALERT ACTIVE';
    
    console.log('Emergency alert activated!');
    
    navigator.geolocation.watchPosition(updateLocation, handleLocationError);
    navigator.geolocation.getCurrentPosition(updateLocation, handleLocationError);
  } else {
    isAlertActive = false;
    sosButton.classList.remove('pulsing');
    sosButton.textContent = 'SOS';
    
    console.log('Emergency alert deactivated.');
  }
}

document.addEventListener('DOMContentLoaded', () => {
    initMap(); // Initialize the map on page load
    const sosButton = document.getElementById('sosButton');
    sosButton.addEventListener('click', toggleAlert);

    // Check localStorage for the last active section
    const lastSection = localStorage.getItem('activeSection');
    if (lastSection) {
        showSection(lastSection);
    } else {
        showSection('home'); // Default to home if no section is saved
    }
});

function showSection(section) {
    const inboxSection = document.getElementById('inboxSection');
    const profileSection = document.getElementById('profileSection');
    const sosButton = document.getElementById('sosButton');
    const emergencyContact = document.getElementById('emergencyContact');
    const map = document.getElementById('map');

    // Hide all sections
    inboxSection.style.display = 'none';
    profileSection.style.display = 'none';
    sosButton.style.display = 'block'; // Show SOS button
    emergencyContact.style.display = 'block'; // Show Emergency Contact

    // Show the selected section
    if (section === 'inbox') {
        inboxSection.style.display = 'block'; // Show inbox
        sosButton.style.display = 'none'; // Hide SOS button
        emergencyContact.style.display = 'none'; // Hide Emergency Contact
        map.style.display = 'none'; // Hide map
    } else if (section === 'profile') {
        profileSection.style.display = 'block'; // Show profile
        sosButton.style.display = 'none'; // Hide SOS button
        emergencyContact.style.display = 'none'; // Hide Emergency Contact
        map.style.display = 'none'; // Hide map
    } else {
        map.style.display = 'block'; // Show map for home section
    }

    // Save the active section to localStorage
    localStorage.setItem('activeSection', section);
}


// JavaScript for modal functionality
var modal = document.getElementById("profileModal");
var profileInfo = document.querySelector(".profile-info");
var span = document.getElementById("closeModal");

profileInfo.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.getElementById("updateProfileForm").onsubmit = function(event) {
    event.preventDefault(); // Prevent the default form submission
    alert("Profile updated!"); // Placeholder for actual update logic
    modal.style.display = "none"; // Close the modal after submission
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, handleLocationError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;
    console.log("Latitude: " + lat + ", Longitude: " + lng);
    // Update the map or marker position here
}

function handleLocationError(error) {
    console.error("Error: " + error.message);
    alert("Unable to retrieve your location: " + error.message);
}

// Call getLocation when needed, e.g., on button click
document.getElementById('sosButton').addEventListener('click', getLocation);
</script>
</body>
</html>