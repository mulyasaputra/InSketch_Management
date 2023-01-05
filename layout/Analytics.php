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
function earnings($month, $year){
  global $userActive;
  global $conn;
  $result = SUM("SELECT SUM(nominal) AS total FROM expenditure WHERE user = '$userActive' AND month = '$month' AND year = '$year'");
  return $result['total']; 
}
foreach ($month as $value) {
  $year = date("Y");
  $lyear = date('Y', strtotime("-1 year"));
  $thisYear[] = post($value, $year);
  $lastYear[] = post($value, $lyear);
  $thisEarnings[] = earnings($value, $year);
  $lasEarnings[] = earnings($value, $lyear);
}
$months = json_encode($month);
$thisYear = json_encode($thisYear); $lastYear = json_encode($lastYear);
$thisEarnings = json_encode($thisEarnings); $lasEarnings = json_encode($lasEarnings);
?>


<!-- CSS Section -->
<style>
  #lineScale{
    border-radius: 6px;
    width: 100%;
    height: 24em;
  }
  #main{
    width: 100%;
    gap: 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  @media (max-width: 1108px) {
    #main{
      grid-template-columns: 1fr;
    }
    #lineScale{
      height: 35em;
    }
  }
</style>
<!-- HTML Section -->
<div class="text">Analytics Sidebar</div>
<section id="main">
  <div id="lineScale" class="shadow">
    <canvas id="expensesValue"></canvas>
  </div>
  <div id="lineScale" class="shadow">
    <canvas id="amountValue"></canvas>
  </div>
</section>

<!-- Script Section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
<!-- Jumlah pengeluaran -->
<script>
const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
lastYear = <?= $lastYear; ?>,
thisYear = <?= $thisYear; ?>,
thisEarnings = <?= $thisEarnings; ?>,
lasEarnings = <?= $lasEarnings; ?>;
</script>
<script src="logic/analytics.js"></script>