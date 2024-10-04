<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .user-table th {
            background-color: #4CAF50;
            color: white;
        }
        .form-container {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>User Management</h1>

    <!-- User Table -->
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- User rows will be populated here -->
        </tbody>
    </table>

    <!-- Form to Add New User -->
    <div class="form-container">
        <h2>Add New User</h2>
        <form id="addUserForm" onsubmit="addUser(event)">
            <input type="text" id="firstName" placeholder="First Name" required>
            <input type="text" id="lastName" placeholder="Last Name" required>
            <input type="email" id="email" placeholder="Email" required>
            <input type="text" id="mobile" placeholder="Mobile Phone" required>
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>
            
            <!-- Role Selection -->
            <label for="role">Role:</label>
            <select id="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            
            <button type="submit">Add User</button>
        </form>
    </div>

    <script>
        // Function to fetch and display users
        function fetchUsers() {
            fetch('fetch_users.php') // Replace with your actual endpoint
                .then(response => response.json())
                .then(data => {
                    const userTableBody = document.getElementById('userTableBody');
                    userTableBody.innerHTML = ''; // Clear existing rows
                    data.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.last_name}</td>
                            <td>${user.email}</td>
                            <td>${user.mobile}</td>
                            <td>${user.username}</td>
                            <td>
                                <button onclick="deleteUser(${user.id})">Delete</button>
                            </td>
                        `;
                        userTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching users:', error));
        }

        // Function to add a new user
        function addUser(event) {
            event.preventDefault(); // Prevent the default form submission

            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('email').value;
            const mobile = document.getElementById('mobile').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value; // Get the selected role

            fetch('add_admin_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: firstName,
                    last_name: lastName,
                    email: email,
                    mobile: mobile,
                    username: username,
                    password: password,
                    role: role // Include the role in the request
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Show success/error message
                // Optionally refresh the user list or reset the form
            })
            .catch(error => {
                console.error('Error adding user:', error);
            });
        }

        // Function to delete a user
        function deleteUser(userId) {
            fetch(`delete_user.php?id=${userId}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Show success/error message
                fetchUsers(); // Refresh the user list
            })
            .catch(error => console.error('Error deleting user:', error));
        }

        // Fetch users on page load
        fetchUsers();
    </script>
</body>
</html>