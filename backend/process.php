<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $promo_code = $_POST['promo_code'] ?? null;
    $email = $_POST['email'] ?? null;

    if (!$promo_code || !$email) {
        die("❌ Error: Missing promo code or email.");
    }

    // Load promo codes from CSV file
    $csv_file = 'promo_codes.csv';
    $promo_codes = [];

    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        $header = fgetcsv($handle); // Read header row

        // Remove BOM (Byte Order Mark) if present
        $header[0] = preg_replace('/\x{FEFF}/u', '', $header[0]);

        while (($data = fgetcsv($handle)) !== FALSE) {
            $promo_codes[] = array_combine($header, $data);
        }
        fclose($handle);
    } else {
        die("❌ Error: Unable to open CSV file.");
    }

    // Check if promo code exists in CSV
    $found = false;
    $voucher_code = null;

    foreach ($promo_codes as $row) {
        if (trim($row['hexCode']) === trim($promo_code)) {
            $found = true;
            $voucher_code = trim($row['vCode']); // Get corresponding voucher code
            break;
        }
    }

    if (!$found) {
        die("❌ Error: Invalid promo code.");
    }

    // Check if the promo code has already been used in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM promo_code1 WHERE promo_code = ?");
    $stmt->execute([$promo_code]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        die("❌ Error: Promo code already used.");
    }

    // Insert into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO promo_code1 (promo_code, email, voucher_code) VALUES (?, ?, ?)");
        $stmt->execute([$promo_code, $email, $voucher_code]);

        $message = "✅ Success! Your voucher code is: $voucher_code : Enjoy your 10% discount!";

    } catch (PDOException $e) {
        die("❌ Database Error: " . $e->getMessage());
    }
} else {
    die("❌ Error: Invalid request method.");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNation Promotion - Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('bg.jpg') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
            color: white;
            padding: 20px;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            margin-top: 15%;
        }
        h2 {
            margin-bottom: 20px;
        }
        .message {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>FitNation Promotion App</h2>
        <div class="message"><?php echo $message; ?></div>
        <a href="index.php" class="back-btn">Go Back</a>
    </div>
</body>
</html>
