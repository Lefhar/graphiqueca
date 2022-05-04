<?php
include("Database.php");
$db = Database::connect();
setlocale(LC_ALL, 'fr_FR', 'fra_FRA');

$datedebut ='2018-01-01';
$dateDepartTimestamp = strtotime($datedebut);
for($i=1;$i<53;$i++)
{
   // echo date('Y-m-d',strtotime('+'.$i.' month',$dateDepartTimestamp)).'<br>';
//
//    echo 'INSERT INTO `ca` (`ca`,`date`)
//VALUES
//  ("'.rand(100000,999000).'","'.date('Y-m-d',strtotime('+'.$i.' month',$dateDepartTimestamp)).'");';
}



$req = $db->prepare('SELECT date, ca FROM `ca`  where Date <= NOW() and Date >= Date_add(Now(),interval - 12 month) ORDER by date');
$req->execute();
$TabCa = $req->fetchAll();
$TabMoyenne = array();
//var_dump($TabCa);
foreach ($TabCa as $row){

    //à tester SELECT  avg(ca)
    //FROM ca
    //where Date <= "2022-12-01" and Date >= Date_add("2022-12-01",interval - 12 month)
    $req = $db->prepare(' SELECT  avg(ca) as moyenne
    FROM ca
    where Date <= ? and Date >= Date_add(?,interval - 12 month)');

//    echo ' SELECT  avg(ca) as moyenne
//    FROM ca
//    where Date <= '.$row['date'].' and Date >= Date_add('.$row['date'].',interval - 12 month)';

    $req->execute(array($row['date'],$row['date']));
    $moyenne = $req->fetch();
    $TabMoyenne[]= $moyenne['moyenne'];

}
//var_dump($TabMoyenne);
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>teste chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
</head>
<body>
<div class="row">
    <div class="container">
        <div class="col-md-4 col-xl-4 col-4">
            <canvas id="vertical"></canvas>
        </div>
        <div class="col-md-4 col-xl-4 col-4">
            <canvas id="horizontal"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="gauge"></canvas>
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
                data: [<?php foreach ($TabCa as $row){?>
               <?=$row['ca'];?>,
                <?php }?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                "borderWidth": 1,
                // this dataset is drawn below
                order: 2
            }, {
                label: 'Moyenne CA 12 mois précédent',
                data: [<?php foreach ($TabMoyenne as $row){?>
                    <?=$row;?>,
                    <?php }?>],




                backgroundColor: '#ed7d31',
                borderColor: '#ed7d31',
                type: 'line',
                // this dataset is drawn on top
                order: 1
            }],
            labels: [<?php foreach ($TabCa as $row){?>
                '<?=utf8_encode(ucfirst(strftime('%B %Y', strtotime($row['date']))));?>',
                <?php }?>]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';

                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });



    const mixedChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'CA du mois',
                data: [<?php foreach ($TabCa as $row){?>
                    <?=$row['ca'];?>,
                    <?php }?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                "borderWidth": 1,
                // this dataset is drawn below
                order: 2
            }, {
                label: 'Moyenne CA 12 mois précédent',
                data: [<?php foreach ($TabMoyenne as $row){?>
                    <?=$row;?>,
                    <?php }?>],
                backgroundColor: '#ed7d31',
                borderColor: '#ed7d31',
                type: 'line',
                // this dataset is drawn on top
                order: 1
            }],
            labels: [<?php foreach ($TabCa as $row){?>
                '<?=utf8_encode(ucfirst(strftime('%B %Y', strtotime($row['date']))));?>',
                <?php }?>]
        },
        options: {indexAxis: 'y',plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';

                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(context.parsed.x);
                            }
                            return label;
                        }
                    }
                }
            }}
    });

    const mixedChart3 = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'CA du mois',
                data: [6000, 5900, 8000, 8100, 6000, 5900, 8000, 8100, 7600, 4509, 8120, 8441],
                backgroundColor: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                // this dataset is drawn below

            }],
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre']
        },
        options: {
            rotation: 270,
            circumference: 180
        },
    });



    var options = {
        type: 'doughnut',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"]
            }]
        },
        options: {
            rotation: 270, // start angle in degrees
            circumference: 180, // sweep angle in degrees
        }
    }

    new Chart(ctx3, options);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>