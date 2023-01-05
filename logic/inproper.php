<?php
// Logic Activity
$resultDF = query("SELECT * FROM expenditure WHERE user = '$userActive'");
function resultData($user, $month, $year){
  $result = query("SELECT * FROM expenditure WHERE user = '$user' AND month = '$month' AND year = '$year' ORDER BY expenditure . date ASC");
  return $result;
}
$month = date("F");
if(isset($_POST['submit'])){
  if(!empty($_POST['mounth']) and !empty($_POST['year'])) {
      $month = $_POST['mounth'];
      $year = $_POST['year'];
  }
}
$result = resultData($userActive, $month, $year);
if ($resultDF == false){
  header("Location: index.php?p=activities&a=add");
  return false;
} else {
  foreach($resultDF as $row){
    $years[]= $row["year"];
  }
  rsort($years);
  $duplicates = array_unique($years);
}


if(isset($_POST["inputMoney"])){
  if(inputMoney($_POST) > 0 ){
    echo "<script> alert('berhasil');</script>";
  } else {
    echo mysqli_error($conn);
  }
}