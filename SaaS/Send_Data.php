<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $modalId = $_POST['modalId'];
    $modalPw = $_POST['modalPw'];

    // Database connection
    $dsn = "odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=C:\\path\\to\\your\\database.accdb;";
    $username = ''; // Typically not used for Access
    $password = ''; // Typically not used for Access

    try {
        // Create a new PDO instance
        $conn = new PDO($dsn, $username, $password);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO Manager (Identifiant, Mdp) VALUES (:identifiant, :mdp)");
        $stmt->bindParam(':identifiant', $modalId);
        $stmt->bindParam(':mdp', $modalPw);

        // Execute the statement
        $stmt->execute();

        echo "New record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
}
