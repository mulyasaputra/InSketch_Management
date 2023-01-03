<?php 
$month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
$thisYear = array(); $lastYear = array();
function post($month, $year){
    global $userActive;
    global $conn;
    $result = $conn ->
    query("SELECT * FROM expenditure WHERE user = '$userActive' AND month = '$month' AND year = '$year'"); $a = $result->num_rows;
    return$a; 
}
foreach ($month as $value) {
  $year = date("Y");
  $thisYear[] = post($value, $year);
}
foreach ($month as $value) {
  $year = date('Y', strtotime("-1 year"));
  $lastYear[] = post($value, $year);
}
$thisYear = json_encode($thisYear); $lastYear = json_encode($lastYear); $months = json_encode($month);
?>


<!-- CSS Section -->
<style>
  #lineScale{
    border-radius: 6px;
  }
</style>
<!-- HTML Section -->
<div class="text">Analytics Sidebar</div>
<section id="lineScale" class="shadow">
  <canvas id="chartDoughnut"></canvas>
</section>

<!-- Script Section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
<script>
  const labels = <?= $months; ?>;
  const data = {
    labels: labels,
    datasets: [
      {
        label: new Date().getFullYear(),
        backgroundColor: "rgb(249, 19, 147)",
        borderColor: "rgb(249, 19, 147)",
        data: <?= $thisYear; ?>,
      },
      {
        label: Tahun = new Date().getFullYear() - 1,
        backgroundColor: "rgb(148, 0, 211)",
        borderColor: "rgb(148, 0, 211)",
        data: <?= $lastYear; ?>,
      },
    ],
  };
  const config = {
    type: "line",
    data,
    options: {
      scales: {
        x: {
          grid: {
            borderColor: "red",
          },
        },
      },
    },
  };
  const myChart = new Chart(document.getElementById("chartDoughnut"), config);
</script>