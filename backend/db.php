<?php
$host = "db";  
$db = "fitnation";
$user = "postgres";
$pass = "password";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Test Query
    $query = $pdo->query("SELECT 'Database connection successful!' AS message");
    $result = $query->fetch();

    
   

} catch (PDOException $e) {
    echo "<h2>❌ Database connection failed</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    die();
}
?>
