<?php 
session_start();
require '../logic/function.php';

// Function tabel print
if (!isset($_SESSION["login"])){
  header("Location: admin.php");
  exit;
}
function phpAlert($date) {
  echo '<script> alert("Month '.$date.' succeed Cut off");
  document.location.href = "../?url=activities";</script>';
};
$userActive = $_SESSION["login"];
$tahun = $_GET["Y"];
$bulan = date('m', strtotime($_GET["F"]. "1"));
$tanggal = $tahun.'-'.$bulan.'-'.date('t', strtotime($_GET["F"]. "1"));
$jumlahPengeluaran = SUM("SELECT SUM(nominal) AS total FROM expenditure WHERE user = '$userActive' AND MONTH(date) = '$bulan' AND YEAR(date) = '$tahun'");
$jumlahSaldo = SUM("SELECT SUM(balance) AS total FROM finance WHERE user = '$userActive' AND MONTH(date) = '$bulan' AND YEAR(date) = '$tahun'");
$beforDate = [date("m", strtotime("-1 month", strtotime($_GET["F"]  . "1"))), $_GET["Y"]];
if ($bulan == 01){
  $beforDate = [date("m", strtotime("-1 month", strtotime($_GET["F"]  . "1"))), $_GET["Y"] - 1];
}
$record = mysqli_query($conn, "SELECT * FROM record WHERE user = '$userActive' AND MONTH(date) = '$beforDate[0]' AND YEAR(date) = '$beforDate[1]'");
$a = mysqli_fetch_assoc($record);
$total = $jumlahSaldo['total']-$jumlahPengeluaran['total'];
if ($a){
  $total = $jumlahSaldo['total']+$a['blance']-$jumlahPengeluaran['total'];
}


$jumlahPengeluaran = mysqli_query($conn, "SELECT * FROM record WHERE user = '$userActive' AND MONTH(date) = '$bulan' AND YEAR(date) = '$tahun'");
if (!mysqli_fetch_assoc($jumlahPengeluaran)){
    mysqli_query($conn, "INSERT INTO record VALUE('','$userActive', '$tanggal', '$total')");
    phpAlert($_GET["F"]);
    return mysqli_affected_rows($conn);
} else {
  $update = "UPDATE record SET blance = '$total' WHERE user = '$userActive' AND MONTH(date) = '$bulan' AND YEAR(date) = '$tahun'";
  mysqli_query($conn, $update);
  phpAlert($_GET["F"]);
  return mysqli_affected_rows($conn);
}