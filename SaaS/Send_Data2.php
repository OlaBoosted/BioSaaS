<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nom = $_POST['nom'];
    $prénom = $_POST['prénom'];
    $fabNum = $_POST['fabNum'];
    $today = $_POST['today'];
    $workStart = $_POST['workStart'];
    $workEnd = $_POST['workEnd'];
    $workStop = $_POST['workStop'];
    

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
        $stmt = $conn->prepare("INSERT INTO Production (Start, End, Jour, Pause, OF) VALUES (:start, :end, :jour, :pause, :of)");
        $stmt->bindparam(':start', $workStart);
        $stmt->bindparam(':end', $workEnd);
        $stmt->bindparam(':jour', $today);
        $stmt->bindparam(':pause', $workStop);
        $stmt->bindparam(':of', $fabNum);

        $stmt2 = $conn->prepare("INSERT INTO Opérateur (Nom, Prénom) VALUES (:nom, :prénom)");
        $stmt2->bindParam(':nom', $nom);
        $stmt2->bindParam(':prénom', $prénom);

        // Execute the statement
        $stmt->execute();
        $stmt2->execute();

        echo "New record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
}
