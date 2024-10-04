<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Barangay Banga 2nd</title>
    <style>
        /* Add your styles here */
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
        .terms {
            margin: 10px 0;
            font-size: 14px;
            color: white;
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
                    window.location.href = 'index.php'; // Redirect to login page
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
            <input type="text" name="name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="mobile" placeholder="Mobile Phone" required>
            <input type="text" name="username" placeholder="Username (for login)" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <div class="terms">
                <input type="checkbox" name="terms" required> I agree to the <a href="#" style="color: #4CAF50;">terms and conditions</a>
            </div>
            <button type="submit">Register</button>
        </form>
        <a href="index.php" style="color: white;">Already have an account? Log in</a>
    </div>
</body>
</html>