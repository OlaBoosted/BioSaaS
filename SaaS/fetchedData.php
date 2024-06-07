<?php
 // Database connection
 $dsn = "odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=C:\\path\\to\\your\\database.accdb;";
 $user = ''; // Typically not used for Access
 $password = ''; // Typically not used for Access

 try {
     // Create a new PDO instance
     $conn = new PDO($dsn, $user, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


$factoryNum = $_GET['factoryNum'];
$periodBegin = $_GET['periodBegin'];
$periodEnd = $_GET['periodEnd'];
$itemName = $_GET['itemName'];
$quantity = $_GET['quantity'];
$cost = $_GET['cost'];

// Query to get production data for the specified period
$sql = "SELECT * FROM Production WHERE Date BETWEEN '$periodBegin' AND '$periodEnd' AND Item = (SELECT Id FROM Coûts WHERE Items = '$itemName')";
$result = $conn->query($sql);

$productionData = [];
$totalQuantity = 0;
$totalTime = 0;
$totalPause = 0;

while($row = $result->fetch_assoc()) {
    $productionData[] = $row;
    $totalQuantity += $row['Quantité'];
    $startTime = strtotime($row['Start']);
    $endTime = strtotime($row['End']);
    $totalTime += ($endTime - $startTime);
    $totalPause += $row['Pause'];
}

$cadence = $totalQuantity / ($totalTime / 3600); // in products per hour

// Operator cost calculation (assuming hourly rate is provided in the form)
$hourlyRate = $cost; // assuming cost is hourly rate
$operatorCost = ($totalTime / 3600) * $hourlyRate; // total time in hours * hourly rate

// Product cost calculation
$productCost = $totalQuantity * $cost; // total quantity * unit cost

// Rendement calculation
$rendement = $operatorCost / $productCost;
$rendementInverse = 1 / $rendement;


// Replace 'your_database_path' with the actual path to your Access database
$databasePath = 'your_database_path.accdb';

// Create connection to Access database
$conn = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$databasePath;");

if (!$conn) {
    die("Connection failed: " . odbc_errormsg());
}

// Fetch data based on filters
$sql = "SELECT factoryNum, date, product, quantity FROM production_data WHERE 1=1";

if (isset($_POST['dateCheck']) && !empty($_POST['periodBegin']) && !empty($_POST['periodEnd'])) {
    $periodBegin = $_POST['periodBegin'];
    $periodEnd = $_POST['periodEnd'];
    $sql .= " AND date BETWEEN '$periodBegin' AND '$periodEnd'";
}

if (isset($_POST['fabCheck']) && !empty($_POST['factoryNum'])) {
    $factoryNum = $_POST['factoryNum'];
    $sql .= " AND factoryNum = '$factoryNum'";
}

if (isset($_POST['itemCheck']) && !empty($_POST['itemName'])) {
    $itemName = $_POST['itemName'];
    $sql .= " AND product = '$itemName'";
}

$stmt = $conn->prepare($sql);
$stmt->execute();

$data = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// If CSV is requested, generate CSV file
if ($csvFile) {
    $cheminUser = realpath(getenv('USERPROFILE'));
    $deposit_directory = $cheminUser . '\Téléchargements';
    $csvFilename = 'Vos_heures_' . date('Ymd') . '.csv';
    $csvChemin = $deposit_directory . '/' . $csvFilename;
    $csvFile = fopen($csvChemin, 'w');

    
    // Combine keys of the first two associative arrays for the header row
    $headerRow = array_merge(array_keys($results[2]), array_keys($results[1]));
    fputcsv($csvFile, $headerRow);

    foreach ($result as $row) {

        $row = $headerRow;

        fputcsv($csvFile, $row);
    }
    
    fclose($csvFile);

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $csvFilename . '";');
    readfile($csvChemin);
    exit;
}


?>

<script>
    const data = <?php echo json_encode($data); ?>;
    // Use this data to render charts
</script>
