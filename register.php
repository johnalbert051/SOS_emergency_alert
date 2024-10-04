<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Barangay Banga 2nd</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Font Awesome CDN -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('barangay-background.jpg');
            background-size: cover;
            background-position: center;
        }
        .register-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            color: white;
            max-width: 400px;
            width: 100%;
        }
        .input-container {
            position: relative; /* Position relative for absolute positioning of icons */
            margin: 10px 0;
        }
        input {
            width: 100%;
            padding: 10px 40px; /* Add padding for the icon */
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .input-container i {
            position: absolute; /* Position the icon */
            left: 10px; /* Space from the left */
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust for vertical centering */
            color: #4CAF50; /* Icon color */
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .terms {
            display: flex; /* Use flexbox for alignment */
            align-items: center; /* Center vertically */
            margin: 10px 0; /* Add some spacing above and below */
            font-size: 14px; /* Font size for the text */
            color: white; /* Text color */
        }
        .terms input[type="checkbox"] {
            width: 20px; /* Increase checkbox size */
            height: 20px; /* Increase checkbox size */
            margin-right: 10px; /* Add space between checkbox and text */
        }
    </style>
    <script>
        function register(event) {
            event.preventDefault(); // Prevent the default form submission

            const name = document.querySelector('input[name="name"]').value;
            const lastName = document.querySelector('input[name="last_name"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const mobile = document.querySelector('input[name="mobile"]').value;
            const username = document.querySelector('input[name="username"]').value;
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            const termsAccepted = document.querySelector('input[name="terms"]').checked;

            if (!termsAccepted) {
                alert("You must agree to the terms and conditions.");
                return;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return;
            }

            // Send AJAX request
            fetch('register_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'name': name,
                    'last_name': lastName,
                    'email': email,
                    'mobile': mobile,
                    'username': username,
                    'password': password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message); // Show success message
                    window.location.href = 'login_page_directory.php'; // Redirect to login page
                } else {
                    alert(data.message); // Show error message
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <form onsubmit="register(event)">
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="First Name" required>
            </div>
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <div class="input-container">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <i class="fas fa-phone"></i>
                <input type="text" name="mobile" placeholder="Mobile Phone" required>
            </div>
            <div class="input-container">
                <i class="fas fa-user-circle"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="terms">
                <input type="checkbox" name="terms" required>
                <span>I agree to the <a href="#" style="color: #4CAF50;">terms and conditions</a></span>
            </div>
            <button type="submit">Register</button>
        </form>
        <a href="login_page_directory.php" style="color: white;">Already have an account? Log in</a>
    </div>
</body>
</html>