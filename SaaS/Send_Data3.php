<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //extraction des filtres de données
    $dateCheck = isset($_POST['dateCheck']);
    $fabCheck = isset($_POST['fabCheck']);
    $itemCheck = isset($_POST['itemCheck']);
    $allCheck = isset($_POST['allCheck']);

    //Données de formulaire
    $factoryNum = $_POST['factoryNum'] ?? '';
    $periodBegin = $_POST['periodBegin'] ?? '';
    $periodEnd = $_POST['periodEnd'] ?? '';
    $itemName = $_POST['itemName'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $item = $_POST['item'];
    $cost = $_POST['cost'];

    // Database connection
    $databaseChemin = "odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=C:\\path\\to\\your\\database.accdb;";
    $username = '';
    $password = '';

    try {
        // Create a new PDO instance
        $conn = new PDO($dsn, $username, $password);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO Production (Quantité) VALUES (:quantité)");
        $stmt->bindParam(':quantité', $quantité);

        $stmt2 = $conn->prepare("INSERT INTO Items (Dénomination, Coût_Unitaire) VALUES (:dénomination, :coût_unitaire)");
        $stmt2->bindParam(':dénomination', $item);
        $stmt2->bindParam(':coût_unitaire', $cost);

        // Execute the statement
        $stmt->execute();

        echo "Enregistrement des données effectué !";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    header("Location: fetchedData.php?factoryNum=$factoryNum&periodBegin=$periodBegin&periodEnd=$periodEnd&itemName=$itemName&quantity=$quantity&cost=$cost");

    exit();
    

    // Close the connection
    // $conn = null;
}

?>