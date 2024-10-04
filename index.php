<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barangay Banga 2nd</title>
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
        .login-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            color: white;
            max-width: 400px;
            width: 100%;
        }
        .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        h1 {
            margin: 0 0 20px;
            font-size: 24px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
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
        .forgot-password {
            margin-top: 10px;
            font-size: 14px;
            color: #f44336;
            text-decoration: none;
        }
    </style>
    <script>
        function login(event) {
            event.preventDefault(); // Prevent the default form submission

            const username = document.querySelector('input[type="text"]').value;
            const password = document.querySelector('input[type="password"]').value;

            // Send AJAX request
            fetch('login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'username': username,
                    'password': password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Redirect to the dashboard or another page
                    window.location.href = 'SOS.php'; // Change to your dashboard page
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
    <div class="login-container">
        <img src="barangay-logo.png" alt="Barangay Logo" class="logo">
        <h1>BARANGAY BANGA 2ND<br>PLARIDEL BULACAN</h1>
        <form onsubmit="login(event)">
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
            <button type="submit">Log in</button>
        </form>
        <a href="register.php" style="color: white; margin-top: 10px; display: inline-block;">Don't have an account? Register here</a> <!-- Link to registration page -->
        <a href="SOS.php" class="forgot-password">Forgot Password?</a>
    </div>
</body>
</html>