<!-- Coding by InSketch | NineCode -->
<?php 
  session_start();
  require 'logic/function.php';
  if (!isset($_SESSION["login"])){
    header("Location: admin.php");
    exit;
  }
  $userActive = $_SESSION["login"];
  $tanggal = [date("m",strtotime("-1 month")), date("Y",strtotime("-1 month"))];
  $month = date('m',strtotime(date('F')));
  $year = date('Y');
  $inMoney = SUM("SELECT SUM(balance) AS total FROM finance WHERE user = '$userActive' AND MONTH(date) = '$month' AND YEAR(date) = '$year'");
  $outMoney = SUM("SELECT SUM(nominal) AS total FROM expenditure WHERE user = '$userActive' AND MONTH(date) = '$month' AND YEAR(date) = '$year'");
  $record = SUM("SELECT * FROM record WHERE user = '$userActive' AND MONTH(date) = '$tanggal[0]' AND YEAR(date) = '$tanggal[1]'");
  $showAlert = "false";
  if ($record == NULL){
    $balanceEx = clean_array($inMoney)["total"];
    $records = 0;
  } else {
    $balanceEx = clean_array($inMoney)["total"]+$record["blance"];
    $records = $record["blance"];
  }
  $financialExpenses = toCurrency(clean_array($outMoney)["total"],0);
  $balanceExpenses = toCurrency($balanceEx,0);
  $record = toCurrency($records,0);
  $span =  !$balanceEx ? 1 : $balanceEx;
  $Tasks = round(clean_array($outMoney)["total"] / $span * 100);
  if($Tasks > 100){
    $Tasks = "100";
    $showAlert = "true";
  };
?>
<!DOCTYPE html>
<html lang="en">
  <?= require 'logic/root.php'; ?>
  <?= require 'section/head.php'; ?>
  <?= require 'section/body.php'; ?>
  <script src="logic/main.js"></script>
</html>
