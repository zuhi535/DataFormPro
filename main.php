<?php
// Function to write data to a file
function writeDataToFile($name, $address, $phone, $note) {
    $filename = 'data.txt';
    $data = "$name;$address;$phone;$note\r\n"; // Adding \r\n
    file_put_contents($filename, $data, FILE_APPEND | LOCK_EX); // Append data to the file
}

// Function to export data to CSV
function exportToCSV() {
    // Check if data.txt exists
    if (file_exists('data.txt')) {
        // Create CSV file
        $csvFile = fopen('export.csv', 'w');

        // Check if CSV file creation was successful
        if ($csvFile) {
            // Set encoding to UTF-8
            fprintf($csvFile, chr(0xEF).chr(0xBB).chr(0xBF));

            // Open file for reading
            $file = fopen('data.txt', 'r');

            // Read data line by line and write to CSV
            while (($line = fgets($file)) !== false) {
                fwrite($csvFile, rtrim($line) . "\r\n"); // Adding rtrim and \r\n
            }

            // Close the file
            fclose($file);

            // Close the CSV file
            fclose($csvFile);

            // Success message
            return "<p class='success-message'>Data has been successfully exported to CSV file.</p>";
        } else {
            // Error message if CSV file creation fails
            return "<p class='error-message'>Error occurred while creating the CSV file.</p>";
        }
    } else {
        // Error message if data.txt does not exist
        return "<p class='error-message'>No data available for export.</p>";
    }
}

$success_export_message = '';

// Check if the HTTP request method is POST and for CSV export
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['export_csv'])) {
    $success_export_message = exportToCSV();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['note'])) {
        // Receive data from the form and write to file
        writeDataToFile($_POST['name'], $_POST['address'], $_POST['phone'], $_POST['note']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Input and Output Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            height: 100px;
            max-height: 150px;
            overflow-y: auto;
            resize: none; /* Disable resizing */
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            margin-top: 20px;
        }

        .processed-data {
            white-space: nowrap; /* Prevent text from wrapping */
            overflow-x: auto; /* Add horizontal scrolling */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Input and Output Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address">
        
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" oninput="validatePhoneNumber(this)">
        
        <label for="note">Note:</label>
        <textarea id="note" name="note" rows="4" cols="50"></textarea>
        
        <input type="submit" value="Submit">
        <button type="submit" name="export_csv" style="background-color: #00FF00; color: #fff; border: none; border-radius: 4px; padding: 10px 20px; cursor: pointer; font-size: 16px;">Export to CSV</button>
        
        <?php echo $success_export_message; ?>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['export_csv'])) {
        if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['note'])) {
            echo "<div class='processed-data'>";
            echo "<h2>Processed Data</h2>";
            echo "Name: " . $_POST['name'] . "<br>";
            echo "Address: " . $_POST['address'] . "<br>";
            echo "Phone: " . $_POST['phone'] . "<br>";
            echo "Note: " . $_POST['note'] . "<br>";
            echo "<p class='success-message'>Data has been successfully added to the file.</p>";
            echo "</div>";
        }
    }
    ?>
</div>

<script>
    function validatePhoneNumber(input) {
        var regex = /^[0-9]+$/;
        if (!regex.test(input.value)) {
            alert("Phone number can only contain digits!");
            input.value = "";
        }
    }
</script>
</body>
</html>
