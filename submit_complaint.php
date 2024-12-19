<?php
// Database configuration
$host = 'vultr-prod-cfbaea5c-14b5-4c87-b3e2-9929eed22e05-vultr-prod-4489.vultrdb.com';
$port = '16751'; // Specify your database port here
$dbname = 'defaultdb';
$username = 'vultradmin';
$password = 'special_password';

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $otherCategory = $_POST['other-category-text'] ?? null;
    $description = $_POST['description'];
    $dateOfIncident = $_POST['date'];
    $evidenceFilename = null;

    // Handle file upload if an evidence file is provided
    // if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] == 0) {
    //     $evidenceFilename = 'uploads/' . basename($_FILES['evidence']['name']);
    //     move_uploaded_file($_FILES['evidence']['tmp_name'], $evidenceFilename);
    // }

    // Insert data into database
    $stmt = $pdo->prepare("INSERT INTO complaints (category, other_category, description, date_of_incident, evidence_filename) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$category, $otherCategory, $description, $dateOfIncident, $evidenceFilename]);


    // Execute the Python machine learning model
    $pythonScriptPath = 'C:\Users\sharm\OneDrive\Desktop\hackhaton\Secure_Block-main\MODEL-main\model.ipynb';  // Replace with the actual path to your Python script
    $command = "python3 $pythonScriptPath";  // Use python3 if that's the version in your environment

    // Execute the command and capture output
    $output = shell_exec($command);
    echo "Python model executed successfully! Output: " . $output;

    echo "Complaint submitted successfully!";
}
?>
