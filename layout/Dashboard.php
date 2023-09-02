<?php
function post($month)
{
   global $userActive;
   $year = date("Y");
   global $conn;
   $result = $conn->query("SELECT * FROM expenditure WHERE user = '$userActive' AND month = '$month' AND year = '$year'");
   $a = $result->num_rows;
   return $a;
}
function post_earnings($month)
{
   global $userActive;
   $year = date("Y");
   global $conn;
   $result = SUM("SELECT SUM(nominal) AS total FROM expenditure WHERE user = '$userActive' AND month = '$month' AND year = '$year'");
   return $result['total'];
}
$chart_doughnut = [post('January'), post('February'), post('March'), post('April'), post('May'), post('June'), post('July'), post('August'), post('September'), post('October'), post('November'), post('December')];
$chart_line = [post_earnings('January'), post_earnings('February'), post_earnings('March'), post_earnings('April'), post_earnings('May'), post_earnings('June'), post_earnings('July'), post_earnings('August'), post_earnings('September'), post_earnings('October'), post_earnings('November'), post_earnings('December')];
?>
<div class="text">Dashboard</div>
<!-- Meta Data -->
<link rel="stylesheet" href="css/dashboard.css" />

<!-- Body -->
<div class="box-container flex">
   <div class="container flex shadow" style="--color-thames: #e74a3b">
      <h5>Balance (monthly)</h5>
      <div class="box-desk flex">
         <span>Rp. <?= $balanceExpenses; ?></span>
         <i class="bx bx-credit-card box-icon"></i>
      </div>
   </div>
   <div class="container flex shadow" style="--color-thames: #1cc88a">
      <h5>Financial expenses</h5>
      <div class="box-desk flex">
         <span>Rp. <?= $financialExpenses; ?></span>
         <i class="bx bx-dollar box-icon"></i>
      </div>
   </div>
   <div class="container flex shadow" style="--color-thames: #4e73df">
      <h5>cost percentage</h5>
      <div class="box-desk flex">
         <div class=" task flex">
            <progress value="<?= $Tasks; ?>" max="100"></progress>
            <span class="result" style="font-size: 20px;"><?= $Tasks . "%" ?></span>
         </div>
         <i class="bx bx-calendar box-icon"></i>
      </div>
   </div>
   <div class="container flex shadow" style="--color-thames: #f6c23e">
      <h5>Record (<?= date("F", strtotime("-1 month")); ?>)</h5>
      <div class="box-desk flex">
         <span>Rp. <?= $record; ?></span>
         <i class="bx bx-leaf box-icon"></i>
      </div>
   </div>
</div>
<div class="chart-data flex mt">
   <div class="container-chart shadow">
      <div class="chartTitle card-header flex">
         <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
      </div>
      <div class="grafik">
         <canvas id="myAreaChart"></canvas>
      </div>
   </div>
   <div class="container-chart shadow">
      <div class="chartTitle card-header flex">
         <h6 class="m-0 font-weight-bold text-primary">Total Expenses(Month)</h6>
      </div>
      <div class="doughnut">
         <h3 class="years-balance"><?= date("Y");; ?></h3>
         <canvas id="chartDoughnut"></canvas>
      </div>
   </div>
</div>
<div class="recent mt">
   <div class="transaction shadow">
      <div class="card-header flex">
         <h6 class="m-0 font-weight-bold text-primary">Transaction (<?= date("F  Y"); ?>)</h6>
      </div>
      <div class="contains">
         <?php $i = 1; ?>
         <?php foreach ($result as $row) : ?>
            <div class="flex ddd a">
               <span><?= $i; ?>.&nbsp;</span>
               <p><?= $row["activities"]; ?> for Rp. <?= toCurrency($row["nominal"], 0); ?></p>
            </div>
            <?php $i++ ?>
         <?php endforeach ?>
      </div>
   </div>
   <div class="addmony shadow">
      <div class="card-header flex">
         <h6 class="m-0 font-weight-bold text-primary">Add Balance (<?= date("F  Y"); ?>)</h6>
      </div>
      <div class="contains">
         <?php $resultWallet = query("SELECT * FROM finance WHERE user = '$userActive' AND MONTH(date) = date('m') AND YEAR(date) = '$year'  ORDER BY finance . date DESC"); ?>
         <?php $i = 1; ?>
         <?php foreach ($resultWallet as $row) : ?>
            <?php $balance = number_format($row["balance"], 0, ',', '.');
            $activity = $row["activity"]; ?>
            <div class="flex ddd">
               <span><?= $i; ?>.&nbsp;</span>
               <p><?php echo ("Treasurer added a balance of Rp. " . $balance); ?></p>
            </div>
            <?php $i++ ?>
         <?php endforeach ?>
      </div>
   </div>
</div>

<!-- Script -->
<script src="JavaScript/Chart.min.js"></script>
<!-- Script Doughnut Chart -->
<script>
   const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
   const color = ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "RGB(255,115,170)", "rgb(255,101,80)", "RGB(31,0,170)", "rgb(116, 186, 47)", "rgb(189, 103, 66)", "rgb(101, 2, 224)", "rgb(1, 23, 246)", "rgb(66, 202, 222)", "rgb(75, 221, 160)", "rgb(198, 42, 154)"];
   let dataSet = [<?php foreach ($chart_doughnut as $chart) : ?><?= $chart; ?>, <?php endforeach ?>];
   var ctx = document.getElementById("chartDoughnut");
   var myChart = new Chart(ctx, {
      type: "doughnut",
      data: {
         labels: labels,
         datasets: [{
            data: dataSet,
            backgroundColor: color,
         }, ],
      },
      options: {
         maintainAspectRatio: false,
         tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
         },
         legend: {
            display: false,
         },
         cutoutPercentage: 70,
      },
   });
</script>
<!-- Script Area Chart -->
<script>
   function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
         prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
         sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
         dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
         s = '',
         toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
         };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
         s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
         s[1] = s[1] || '';
         s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
   }

   var ctx = document.getElementById("myAreaChart");
   let lineDataSet = [<?php foreach (clean_array($chart_line) as $line) : ?><?= $line; ?>, <?php endforeach ?>];
   var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
         datasets: [{
            label: "Outlay",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: lineDataSet,
         }],
      },
      options: {
         maintainAspectRatio: false,
         layout: {
            padding: {
               left: 10,
               right: 25,
               top: 25,
               bottom: 0
            }
         },
         scales: {
            xAxes: [{
               time: {
                  unit: 'date'
               },
               gridLines: {
                  display: false,
                  drawBorder: false
               },
               ticks: {
                  maxTicksLimit: 7
               }
            }],
            yAxes: [{
               ticks: {
                  maxTicksLimit: 5,
                  padding: 10,
                  // Include a dollar sign in the ticks
                  callback: function(value, index, values) {
                     return 'Rp. ' + number_format(value);
                  }
               },
               gridLines: {
                  color: "rgb(234, 236, 244)",
                  zeroLineColor: "rgb(234, 236, 244)",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
               }
            }],
         },
         legend: {
            display: false
         },
         tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
               label: function(tooltipItem, chart) {
                  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                  return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
               }
            }
         }
      }
   });
</script>