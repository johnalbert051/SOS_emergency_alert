<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resident Information Form</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f4f4f4;
    }
    h1 {
        color: #2c3e50;
        text-align: center;
    }
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    select,
    textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #3498db;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 20px;
    }
    input[type="submit"]:hover {
        background-color: #2980b9;
    }
    .required:after {
        content: " *";
        color: red;
    }
    .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #34495e;
        }

        .back-button i {
            margin-right: 5px;
        }
</style></head><body>
    <h1>Resident Information Form</h1>
    <form id="residentForm" action="https://websim.creation.engine/api/submit-form" method="POST">
        <a href="sos.php" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>
        <label for="fullName" class="required">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>

        <label for="dob" class="required">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="ssn" class="required">Social Security Number:</label>
        <input type="text" id="ssn" name="ssn" pattern="\d{3}-\d{2}-\d{4}" placeholder="XXX-XX-XXXX" required>

        <label for="email" class="required">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone" class="required">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="XXX-XXX-XXXX" required>

        <label for="address" class="required">Current Address:</label>
        <textarea id="address" name="address" rows="3" required></textarea>

        <label for="occupation">Occupation:</label>
        <input type="text" id="occupation" name="occupation">

        <label for="employer">Employer:</label>
        <input type="text" id="employer" name="employer">

        <label for="income" class="required">Annual Income:</label>
        <input type="text" id="income" name="income" pattern="^\$?[0-9]+(\.[0-9]{2})?$" placeholder="$50000.00" required>

        <label for="maritalStatus">Marital Status:</label>
        <select id="maritalStatus" name="maritalStatus">
            <option value="">Select...</option>
            <option value="single">Single</option>
            <option value="married">Married</option>
            <option value="divorced">Divorced</option>
            <option value="widowed">Widowed</option>
        </select>

        <label for="emergencyContact" class="required">Emergency Contact Name:</label>
        <input type="text" id="emergencyContact" name="emergencyContact" required>

        <label for="emergencyPhone" class="required">Emergency Contact Phone:</label>
        <input type="tel" id="emergencyPhone" name="emergencyPhone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="XXX-XXX-XXXX" required>

        <label for="vehicles">Number of Vehicles:</label>
        <input type="number" id="vehicles" name="vehicles" min="0" max="10">

        <label for="pets">Number of Pets:</label>
        <input type="number" id="pets" name="pets" min="0" max="10">

        <label for="moveInDate" class="required">Desired Move-In Date:</label>
        <input type="date" id="moveInDate" name="moveInDate" required>

        <label for="leaseLength" class="required">Desired Lease Length:</label>
        <select id="leaseLength" name="leaseLength" required>
            <option value="">Select...</option>
            <option value="6">6 months</option>
            <option value="12">12 months</option>
            <option value="18">18 months</option>
            <option value="24">24 months</option>
        </select>

        <label for="additionalInfo">Additional Information or Special Requests:</label>
        <textarea id="additionalInfo" name="additionalInfo" rows="4"></textarea>

        <input type="submit" value="Submit Application">
    </form>

    <script>
    document.getElementById('residentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Basic form validation
        var requiredFields = document.querySelectorAll('[required]');
        var isValid = true;
        
        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = 'red';
            } else {
                field.style.borderColor = '';
            }
        });
        
        if (isValid) {
            // Here you would typically send the form data to a server
            alert('Form submitted successfully!');
            // You can replace the alert with an AJAX call to submit the form data
        } else {
            alert('Please fill out all required fields.');
        }
    });
    </script>
</body></html>