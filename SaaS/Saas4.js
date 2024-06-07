//Affichage des graphiques

// Convert PHP arrays to JavaScript arrays
var timeLabels = <? php echo json_encode($timeLabels); ?>;
var cadenceData = <? php echo json_encode($cadenceData); ?>;
var quantityData = <? php echo json_encode($quantityData); ?>;
var operatorCost = <? php echo $operatorCost; ?>;
var productCost = <? php echo $productCost; ?>;
var rendement = <? php echo $rendement; ?>;
var totalPausePercentage = <? php echo ($totalPause / $totalTime) * 100; ?>;

var timeLabels = <? php echo json_encode($timeLabels); ?>;
var cadenceData = <? php echo json_encode($cadenceData); ?>;
var quantityData = <? php echo json_encode($quantityData); ?>;
var operatorCost = <? php echo $operatorCost; ?>;
var productCost = <? php echo $productCost; ?>;
var rendement = <? php echo $rendement; ?>;
var totalPausePercentage = <? php echo ($totalPause / $totalTime) * 100; ?>;

var workedTimePercentage = 100 - totalPausePercentage;

// Cadence Chart
var ctxCadence = document.getElementById('cadenceChart').getContext('2d');
var cadenceChart = new Chart(ctxCadence, {
    type: 'line',
    data: {
        labels: timeLabels,
        datasets: [{
            label: 'Cadence',
            data: cadenceData,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Rendement Chart
var ctxRendement = document.getElementById('rendementChart').getContext('2d');
var rendementChart = new Chart(ctxRendement, {
    type: 'bar',
    data: {
        labels: ['Rendement'],
        datasets: [{
            label: 'Rendement',
            data: [rendement],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Lost Time Chart
var ctxLostTime = document.getElementById('lostTimeChart').getContext('2d');
var lostTimeChart = new Chart(ctxLostTime, {
    type: 'pie',
    data: {
        labels: ['Worked Time', 'Pause Time'],
        datasets: [{
            label: 'Lost Time',
            data: [workedTimePercentage, totalPausePercentage],
            backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Quantity Over Time Chart
var ctxQuantity = document.getElementById('quantityChart').getContext('2d');
var quantityChart = new Chart(ctxQuantity, {
    type: 'line',
    data: {
        labels: timeLabels,
        datasets: [{
            label: 'Quantity Produced',
            data: quantityData,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

