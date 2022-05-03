<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>teste chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
</head>
<body>
<div class="row">
    <div class="container">
        <div class="col-md-4">
            <canvas id="vertical" ></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="horizontal" ></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="gauge" ></canvas>
        </div>


    </div>
</div>
<script>
    const ctx = document.getElementById('vertical').getContext('2d');
    const ctx2 = document.getElementById('horizontal').getContext('2d');
    const ctx3 = document.getElementById('gauge').getContext('2d');
    const mixedChart = new Chart(ctx, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'CA du mois',
                data: [6000, 5900, 8000, 8100,6000, 5900, 8000, 8100,7600, 4509, 8120, 8441],
                backgroundColor: '#5b9bd5',
                // this dataset is drawn below
                order: 2
            }, {
                label: 'Moyenne CA',
                data: [600, 590, 800, 810,600, 590, 800, 810,600, 1590, 800, 810],
                backgroundColor: '#ed7d31',
                         borderColor: '#ed7d31',
                type: 'line',
                // this dataset is drawn on top
                order: 1
            }],
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout','Septembre','Octobre','Novembre','Décembre']
        },
        options: {}
    });
const mixedChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'CA du mois',
                data: [6000, 5900, 8000, 8100,6000, 5900, 8000, 8100,7600, 4509, 8120, 8441],
                backgroundColor: '#5b9bd5',
                // this dataset is drawn below
                order: 2
            }, {
                label: 'Moyenne CA',
                data: [600, 590, 800, 810,600, 590, 800, 810,600, 1590, 800, 810],
                backgroundColor: '#ed7d31',
                         borderColor: '#ed7d31',
                type: 'line',
                // this dataset is drawn on top
                order: 1
            }],
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout','Septembre','Octobre','Novembre','Décembre']
        },
        options: {indexAxis: 'y'}
    });

const mixedChart3 = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'CA du mois',
                data: [6000, 5900, 8000, 8100,6000, 5900, 8000, 8100,7600, 4509, 8120, 8441],
                backgroundColor: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                // this dataset is drawn below

            }],
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout','Septembre','Octobre','Novembre','Décembre']
        },
        options: {
            rotation: 270,
            circumference: 180
        },
    });

    //
    //
    // var options = {
    //     type: 'doughnut',
    //     data: {
    //         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"]
    //         }]
    //     },
    //     options: {
    //         rotation: 270, // start angle in degrees
    //         circumference: 180, // sweep angle in degrees
    //     }
    // }
    //
    // new Chart(ctx3, options);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>