<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: logins.php"); // Redirect to login page if not logged in
    exit();
}

?>


<html lang="en">
<head>
    <meta name="viewport" content="device-width", initial-scale="1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="user_dashboards.css">
</head>
<body>
    
<body>
<script>
    // Function to clear the content area
    function clearModuleContent() {
        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = ''; // Clear the existing content
    }


 // Function to display dashboard content
function dashboard() {
    clearModuleContent(); // Clear previous module content

    const moduleContent = document.getElementById("module-content");

    // Fetch reservation counts from the server
    fetch('get_reservation_counts.php') // Adjust path if necessary
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Log the data for debugging
            moduleContent.innerHTML = `
                <style>
                     .reservation-summary {
                        display: flex;
                        gap: 20px;
                        justify-content: center;
                        margin: 20px 0;
                    }
                    .reservation-card {
                        flex: 1;
                        max-width: 350px;
                        padding: 20px;
                        color: #fff;
                        text-align: center;
                        border-radius: 0px;
                        position: relative;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                        transition: transform 0.3s;
                    }
                    .reservation-card h3 {
                        font-size: 2.5em;
                        margin: 0;
                    }
                    .reservation-card p {
                        margin: 10px 0 0;
                    }
                    .reservation-card.approved {
                        background-color: #28a745; /* Green for approved */
                    }
                    .reservation-card.total {
                        background-color: #007bff; /* Blue for total reservations */
                    }
                    .reservation-card.pending {
                        background-color: #ffc107; /* Yellow for pending */
                    }
                    .reservation-card.rejected {
                        background-color: #dc3545; /* Red for rejected */
                    }
                    .scrollable-container {
                        height: 82vh; /* Full height of the viewport */
                        overflow-y: auto; /* Enable vertical scrolling */
                    }
                    .welcome-section {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        background-image: url('barangay.jpg'); /* Replace with your image URL */
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        color: white;
                        padding: 100px;
                        border-radius: 8px;
                        margin-bottom: 20px; /* Adjust margin below */
                        text-align: center;
                        position: relative;
                        height: 300px; /* Set a fixed height for the welcome section */
                    }
                    .welcome-text {
                        position: absolute; /* Ensure the text stays above the background image */
                        z-index: 0;
                    }
                </style>
                <div class="reservation-summary">
                    <div class="reservation-card approved">
                        <h3>${data.approvedCount}</h3>
                        <p>Total Approved</p>
                    </div>
                    <div class="reservation-card total">
                        <h3>${data.totalReservations}</h3>
                        <p>Total Reservations</p>
                    </div>
                    <div class="reservation-card pending">
                        <h3>${data.pendingCount}</h3>
                        <p>Pending</p>
                    </div>
                    <div class="reservation-card rejected">
                        <h3>${data.rejectedCount}</h3>
                        <p>Rejected</p>
                    </div>
                </div>
                <div class="scrollable-container">
                    <div class="dashboard-container">
                        <!-- Welcome Section -->
                        <div class="welcome-section">
                            <div class="welcome-text">
                                <h1>Welcome to Facility Reservation</h1>
                                <p>Book and manage your facility reservations easily.</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error fetching reservation counts:', error);
        });
}




// Function to load Module 1 content
function loadModule1() {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");
    // HTML structure for moduleContent
    moduleContent.innerHTML = `
    <style>
        /* Container for scrollable facility cards */
        #userFacilityContainer {
            max-height: 600px; /* Adjust height for desktop mode */
            overflow-y: auto; /* Enable vertical scrolling */
            padding: 10px;
            border: 1px solid #ccc; /* Optional: add a border */
            border-radius: 8px; /* Optional: add rounded corners */
            margin-bottom: 20px; /* Add margin for spacing */
        }

        /* Facility cards container */
        .facility-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }

        /* Individual facility card style */
        .facility-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            text-align: left;
            background-color: #fff;
            max-width: 290px;
            flex: 1 1 250px;
            transition: transform 0.3s; /* Add transition effect */
        }

        .facility-card:hover {
            transform: scale(1.03); /* Slightly scale the card on hover */
        }

        .facility-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .facility-card h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .facility-card p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        /* Style for capacity, amenities, and availability details */
        .facility-details {
            margin-top: 10px;
            padding: 5px;
            border-top: 1px solid #ddd;
            display: flex;
            flex-direction: column;
        }

        .facility-details span {
            font-weight: bold;
            color: #333;
        }

        .availability {
            font-weight: bold;
            color: green;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .facility-card {
                max-width: 100%; /* Make cards full width on small screens */
            }
            #userFacilityContainer {
                max-height: 470px; /* Adjust height for mobile */
            }
        }
    </style>

    <div id="userFacilityContainer">
        <div id="userFacilityList" class="facility-list"></div>
    </div>
    `;
    loadUserFacilities(); // Load facilities when the module is loaded
}
// Function to render facilities on the user dashboard
function renderUserFacilities() {
    const userFacilityList = document.getElementById("userFacilityList");
    userFacilityList.innerHTML = ''; // Clear existing facilities

    if (userFacilities.length === 0) {
        userFacilityList.innerHTML = '<p>No facilities available.</p>'; // Message when no facilities
    } else {
        userFacilities.forEach((facility) => {
            const facilityCard = document.createElement("div");
            facilityCard.classList.add("facility-card");
            facilityCard.innerHTML = `
                <img src="${facility.photo}" alt="${facility.name}">
                <h3>${facility.name}</h3>
                <p>${facility.description}</p>
                <div class="facility-details">
                    <span>Capacity:</span> <p>${facility.capacity}</p>
                    <span>Amenities:</span> <p>${facility.amenities}</p>
                    <span>Availability:</span> <p class="availability">${facility.availability}</p>
                </div>
            `;
            userFacilityList.appendChild(facilityCard);
        });
    }
}

// Function to save facilities to localStorage
function saveFacilities() {
    localStorage.setItem("facilities", JSON.stringify(userFacilities));
}

// Function to load facilities from localStorage for the user dashboard
function loadUserFacilities() {
    const storedFacilities = localStorage.getItem("facilities");
    if (storedFacilities) {
        userFacilities = JSON.parse(storedFacilities); // Update userFacilities array
    } else {
        userFacilities = []; // Ensure array is empty if no data
    }
    renderUserFacilities(); // Render updated facilities
}

// Example function to add a facility (this should be called by admin when adding a facility)
function addFacility(facility) {
    userFacilities.push(facility);
    saveFacilities(); // Save to localStorage after adding
    renderUserFacilities(); // Update the display
}

// Listen for localStorage changes (real-time update for facilities)
window.addEventListener("storage", (event) => {
    if (event.key === "facilities") {
        loadUserFacilities(); // Reload facilities when updated by admin
    }
});

// Initial load for facilities when the user's page is opened
loadUserFacilities();




 // Function to module content
 function toggleSubmodules() {
        clearModuleContent(); // Clear previous module content

        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = `
        <p>Welcome to your module 1!</p>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <h4>module 1- Content Here</h4>
                </div>
                <div class="card-body">
                    <p>module 1 content is loaded here.</p>
                </div>
            </div>
        </div>`;
 }
 
  
 // Function to module content
 function loadSubmodule1() {
        clearModuleContent(); // Clear previous module content

        const moduleContent = document.getElementById("module-content");
        moduleContent.innerHTML = `
 <link rel="stylesheet" href="usercss/userreservation.css">

<div class="container">
    <!-- Form Section -->
    <div>
        <form id="reservationForm" method="POST" onsubmit="submitReservation(event);">
            <div class="form-row">
                <div class="form-group">
                    <label for="user_name">Name</label>
                    <input type="text" id="user_name" name="user_name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="facility_name">Select Facility</label>
                    <select id="facility_name" name="facility_name" required>
                        <option value="" disabled selected>-- Select Facility --</option>
                        <option value="Community Hall">Community Hall</option>
                        <option value="Conference Room">Conference Room</option>
                        <option value="Basketball Court">Basketball Court</option>
                        <option value="Banquet Hall">Banquet Hall</option>
                        <option value="Gymnasium">Gymnasium</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="reservation_date">Reservation Date</label>
                    <input type="date" id="reservation_date" name="reservation_date" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="time" id="start_time" name="start_time" required>
                </div>

                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="time" id="end_time" name="end_time" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="additional_request">Additional Requests</label>
                    <textarea id="additional_request" name="additional_request" placeholder="Enter any additional requests" rows="3"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="purpose">Purpose</label>
                    <input type="text" id="purpose" name="purpose" placeholder="Enter the purpose of reservation" required>
                </div>
            </div>

            <button type="submit">Submit Reservation</button>
        </form>
    </div>

    <!-- Facility Information Section -->
    <div class="info-section">
        <h2>Facility Information</h2>
        <p>Ensure you have all the details ready for your reservation.</p>
        <ul>
            <li>Available facilities include:</li>
            <li>Community Hall</li>
            <li>Conference Room</li>
            <li>Basketball Court</li>
            <li>Banquet Hall</li>
            <li>Gymnasium</li>
        </ul>
        <p>Check our calendar for availability on the desired date.</p>
        <p>For any inquiries, please contact our office.</p>
        <p>63+ 919 659 5120</p>
    </div>
</div>

        </div>`;
 }
 fetchReservations(); // Fetch and display all reservations


// Submit reservation data
function submitReservation(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(document.getElementById("reservationForm"));
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_reservation.php", true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                alert(response.message); // Show success message
                document.getElementById("reservationForm").reset(); // Reset form after submission
                fetchReservations(); // Refresh the reservations list
            } else {
                alert(response.message); // Show error message
            }
        }
    };
    xhr.send(formData); // Send the form data
}

// Fetch all reservations from the server
function fetchReservations() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_reservations.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("allReservations").innerHTML = xhr.responseText;
        } else {
            document.getElementById("allReservations").innerHTML = "Failed to load reservations.";
        }
    };
    xhr.send();
}



          // Function to load Module 1 content
       // Function to load Module 1 content
       function loadSubmodule3() {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");
    moduleContent.innerHTML = `
 
</div>
    `;
}








function loadSubmodule2() {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");
    moduleContent.innerHTML = `
     <style>
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .calendar-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 95%;
            max-width: 1000px;
            margin: auto;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 30px;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            width: 24%;
            margin-right: 10px;
        }

        label {
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        select,
        input[type="number"] {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        select:focus,
        input[type="number"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .calendar-day {
            width: 140px;
            height: 140px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
            display: inline-block;
            margin: 10px;
            position: relative;
            background-color: #f9f9f9;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .calendar-day:hover {
            background-color: #e0e0e0;
            cursor: pointer;
        }

        .facility-status-container {
            height: 80px;
            overflow-y: auto;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            background-color: #ffffff;
        }

        .facility-status {
            display: block;
            margin-top: 2px;
            font-size: 10px;
            border-radius: 4px;
            color: white;
            text-align: center;
            min-width: 70px;
        }

        .status-available {
            background-color: green;
        }

        .status-unavailable {
            background-color: red;
        }

        .status-maintenance {
            background-color: grey;
        }

        .status-pending {
            background-color: yellow;
            color: black;
        }

        .day-number {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 20px;
            color: #333;
        }

        /* Tooltip for more information */
        .tooltip {
            visibility: hidden;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .calendar-day:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 600px) {
            .controls {
                flex-direction: column;
            }

            .control-group {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }

            .calendar-day {
                width: 100%;
            }
        }
    </style>
</div>
  <h1>User Calendar</h1>

    <div class="calendar-container">
        <div class="controls">
            <div class="control-group">
                <label for="month">Month:</label>
                <select id="month" onchange="generateCalendar()">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="control-group">
                <label for="year">Year:</label>
                <input type="number" id="year" min="2023" placeholder="Year" onchange="generateCalendar()">
            </div>
        </div>

        <h3>Calendar:</h3>
        <div id="user-calendar"></div>
    </div>
    `;
}
function generateCalendar() {
            const month = document.getElementById("month").value;
            const year = document.getElementById("year").value;
            const calendarContainer = document.getElementById("user-calendar");

            // Clear previous calendar
            calendarContainer.innerHTML = '';

            if (!year) {
                alert("Please enter a valid year.");
                return;
            }

            // Get number of days in the selected month and year
            const daysInMonth = new Date(year, month, 0).getDate();

            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${year}-${month.padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayDiv = document.createElement('div');
                dayDiv.classList.add('calendar-day');
                dayDiv.setAttribute('data-date', date);

                const dayNumber = document.createElement('span');
                dayNumber.classList.add('day-number');
                dayNumber.textContent = day;
                dayDiv.appendChild(dayNumber);

                // Create a container for facility statuses
                const facilityStatusContainer = document.createElement('div');
                facilityStatusContainer.classList.add('facility-status-container');
                dayDiv.appendChild(facilityStatusContainer);

                // Load existing status from localStorage (if any)
                loadFacilityStatus(facilityStatusContainer, date);

                // Tooltip for detailed info
                const tooltip = document.createElement('div');
                tooltip.classList.add('tooltip');
                tooltip.textContent = `Details for ${date}`;
                dayDiv.appendChild(tooltip);

                calendarContainer.appendChild(dayDiv);
            }
        }

        function loadFacilityStatus(container, date) {
            container.innerHTML = ''; // Clear previous statuses

            const facilityStatuses = JSON.parse(localStorage.getItem(date)) || {};
            for (const [facility, status] of Object.entries(facilityStatuses)) {
                const statusDiv = document.createElement('span');
                statusDiv.classList.add('facility-status');

                // Set the appropriate class based on status
                switch (status) {
                    case 'available':
                        statusDiv.classList.add('status-available');
                        break;
                    case 'unavailable':
                        statusDiv.classList.add('status-unavailable');
                        break;
                    case 'maintenance':
                        statusDiv.classList.add('status-maintenance');
                        break;
                    case 'pending':
                        statusDiv.classList.add('status-pending');
                        break;
                }

                statusDiv.textContent = `${facility.replace(/_/g, ' ')}: ${status.charAt(0).toUpperCase() + status.slice(1)}`;
                container.appendChild(statusDiv);
            }
        }

        // Generate calendar on load
        window.onload = () => {
            const currentDate = new Date();
            document.getElementById("year").value = currentDate.getFullYear();
            generateCalendar();
        }


       
function Module3() {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");
    moduleContent.innerHTML = `
 
</div>
    `;
}
   


</script>





<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <!-- Logo for LGU -->
    <img id="lgu-logo" src="logo.png" alt="LGU Logo" class="lgu-logo">
 
        <ul class="sidebar-menu">
        </li>
        <li class="list-group-item">
            <a href="#" onclick="dashboard()"><i class="fas fa-th-large"></i>Dashboard</a></li>
            <ul class="list-group">

            <li class="list-group-item">
                    <a href="#" onclick="loadModule1()"><i class="fas fa-wrench"></i>FACILITY LISTING</a>
                </li>
                

         <!-- Dropdown for Module 1 -->
    <li class="list-group-item">
        <a href="#" id="module2" onclick="toggleSubmodules('submodule1-dropdown')">
            <i class="fas fa-wrench"></i>FACILITY <i class="fas fa-chevron-down"></i>
        </a>
        <ul class="submodule-dropdown" id="submodule1-dropdown" style="display: none;">
            <li><a href="#" id="submodule1" onclick="loadSubmodule1()">FACILITY RESERVATIONS</a></li>
            <li><a href="#" id="submodule2" onclick="loadSubmodule2()">CALENDAR</a></li>
            <li><a href="#" id="submodule3" onclick="loadSubmodule3()">Submodule 3</a></li>
        </ul>
    </li>


    <li class="list-group-item">
            <a href="#" onclick="module3()"><i class="fas fa-wrench"></i>module 3</a></li>
            <ul class="list-group">
    </li>
                
                </li>
                </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <header>
            <div class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="header-right">
                <i class="fas fa-comment-dots" id="message-icon"></i>
                
                <i class="fas fa-bell" id="notification-icon"></i>
<div class="notification-area" id="notification-area" style="display: none;">
    <h3>Notifications</h3>
    <style>
        .notification-area {
            position: absolute;
            top: 60px;  /* Adjust according to your layout */
            right: 60px;  /* Adjust to align with the bell icon */
            width: 270px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 350px;
            overflow-y: auto;
            padding: 15px;
            border-radius: 5px;
        }

        .notification {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .notification a {
            text-decoration: none;
            color: #333;
        }

        .notification.unread {
            font-weight: bold;
        }

        .notification.read {
            font-weight: normal;
        }

        .notification:hover {
            background-color: #f9f9f9;
        }

        #notification-icon {
            font-size: 20px;
            cursor: pointer;
            right: 10px;
            position: relative;
        }

        /* Mobile Styles */
        @media (max-width: 600px) {
            .notification-area {
                width: 70%; /* Take up most of the screen width */
                right: .1%; /* Center the notification on smaller screens */
                top: 60px; /* Adjust top position if necessary */
            }
        }
    </style>
    <div id="notifications-list">
        <!-- Notifications will be dynamically loaded here -->
    </div>
</div>

                <div class="profile" id="profile-icon">

                    <div class="profile-container">
                        <div class="profile-icon">

<!-- User Profile Icon and Dropdown -->
<div class="user-profile" onclick="toggleDropdown()">
    <img src="wa.jpg" alt="Profile" class="profile-image">
</div>

<!-- Dropdown Menu -->
<div class="dropdown-menu" id="dropdownMenu">
    <div class="dropdown-header">
        <img src="aa.jpg" alt="User Avatar">
        <h1>Welcome, <span><?php echo ucfirst($_SESSION['username']); ?></span></h1>

    </div>
    <ul>
        <li>
            <a href="user_editprofile.php">
                <i class="fas fa-user icon-profile"></i><span>Edit Profile</span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a>
        </li>
        <li>
            <i class="fas fa-cog icon-settings"></i><span>Settings & Privacy</span>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
        <li>
            <i class="fas fa-question-circle icon-help"></i><span>Help & Support</span>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
        <li>
            <i class="fas fa-sign-out-alt icon-logout"></i><a href="logout.php">Logout</a>
            <i class="fas fa-chevron-right arrow-icon"></i>
        </li>
    </ul>
</div>



                  
                </div>
            </div>
        </header>
        <main>
            <h1 id="content-title">Dashboard</h1>
            
        
            <!-- Empty Section for Module Content -->
           <!-- Content Area -->
    <div class="col-9">
        <div id="module-content" class="content-area"></div>
    </div>

        </main>
    </div>

    
    <script>// Toggle sidebar functionality
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("main-content").classList.toggle("collapsed");
        });
   
        // Change content based on clicked module
        document.querySelectorAll(".sidebar-menu li a").forEach(item => {
            item.addEventListener("click", function (event) {
                // Remove active class from all menu items
                document.querySelectorAll(".sidebar-menu li").forEach(li => li.classList.remove("active"));
                
                // Add active class to clicked menu item
                event.currentTarget.parentElement.classList.add("active");
        
                // Change the content dynamically
                const contentTitle = document.getElementById("content-title");
                contentTitle.textContent = event.currentTarget.textContent.trim();
            });
        });
        
        // Handle profile, notifications, and messages click
        document.getElementById("profile-icon").addEventListener("click", function () {
            const profileIcon = document.getElementById('profileIcon');
const dropdownMenu = document.getElementById('dropdownMenu');

// Toggle the dropdown menu when the profile icon is clicked
profileIcon.addEventListener('click', function() {
  dropdownMenu.classList.toggle('show');
});

// Close the dropdown menu if clicked outside
window.addEventListener('click', function(e) {
  if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.classList.remove('show');
  }
});
        });

   // Function to toggle dropdown menu
   function toggleDropdown() {
        var dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("active");
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.closest('.user-profile')) {
            document.getElementById("dropdownMenu").classList.remove("active");
        }
    }
    document.getElementById("notification-icon").addEventListener("click", function () {
    const notificationArea = document.getElementById("notification-area");
    const notificationsList = document.getElementById("notifications-list");

    // Fetch notifications from the server
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "get_notifications.php", true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const notifications = JSON.parse(xhr.responseText);
            notificationsList.innerHTML = ''; // Clear previous notifications

            if (notifications.length === 0) {
                notificationsList.innerHTML = '<p>No new notifications.</p>';
            } else {
                notifications.forEach(notification => {
                    notificationsList.innerHTML += `
                        <div class="notification ${notification.is_read ? 'read' : 'unread'}">
                            <a href="mark_as_read.php?id=${notification.id}">
                                ${notification.message}
                            </a>
                        </div>
                    `;
                });
            }
        }
    };
    xhr.send();

    // Toggle notification area visibility
    notificationArea.style.display = (notificationArea.style.display === 'none' || notificationArea.style.display === '') ? 'block' : 'none';
});
    
        document.getElementById("message-icon").addEventListener("click", function () {
            alert("Messages clicked!");
        });

// Function to toggle the dropdown visibility
function toggleSubmodules(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (dropdown.style.display === "none" || dropdown.style.display === "") {
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
}

// Function to load the specific submodule
function loadSubmodule(submoduleNumber) {
    clearModuleContent(); // Clear previous module content
    const moduleContent = document.getElementById("module-content");

    let submoduleTitle = "";
    let submoduleContent = "";

    switch (submoduleNumber) {
        case 1:
            submoduleTitle = "Submodule 1";
            submoduleContent = "Content for Submodule 1 is loaded here.";
            break;
        case 2:
            submoduleTitle = "Submodule 2";
            submoduleContent = "Content for Submodule 2 is loaded here.";
            break;
        case 3:
            submoduleTitle = "Submodule 3";
            submoduleContent = "Content for Submodule 3 is loaded here.";
            break;
        default:
            submoduleTitle = "Module 1";
            submoduleContent = "Default content for Module 1.";
    }

    moduleContent.innerHTML = `
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h4>${submoduleTitle}</h4>
            </div>
            <div class="card-body">
                <p>${submoduleContent}</p>
            </div>
        </div>
    </div>`;
}

// Function to clear previous module content
function clearModuleContent() {
    document.getElementById("module-content").innerHTML = "";
}

    
</script>

</body>
</html>