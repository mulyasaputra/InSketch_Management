<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require 'logic/function.php';
if (!isset($_SESSION["login"])){
  header("Location: admin.php");
  exit;
}
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf([
  'format' => [215, 330],
  'margin_top' => 10,
  'margin_left' => 20,
  'margin_right' => 10,
  'margin_bottom' => 0,
]);


// Function tabel print
$userActive = $_SESSION["login"];
$year = $_GET["Y"];
$month = $_GET["F"];
$tanggal = [date("m", strtotime("-1 month", strtotime($month . "1"))), date("Y", strtotime("-1 month", strtotime($month . "1"))), date("F", strtotime("-1 month", strtotime($month . "1")))];
if ((int)date("m", strtotime($month)) > 2){$tanggal[1] = $year;};
$moneyDate = date('m',strtotime($month. "1"));
$income = 0; $include = 0;
$record = query("SELECT * FROM record WHERE user = '$userActive' AND MONTH(date) = '$tanggal[0]' AND YEAR(date) = '$tanggal[1]'")[0];
if($month == "all"){
  $moneys = query("SELECT * FROM finance WHERE user = '$userActive' AND YEAR(date) = '$year' ORDER BY finance . date ASC");
  $result = query("SELECT * FROM expenditure WHERE user = '$userActive' AND year = '$year' ORDER BY expenditure . date ASC");
} else {
  $moneys = query("SELECT * FROM finance WHERE user = '$userActive' AND MONTH(date) = '$moneyDate' AND YEAR(date) = '$year' ORDER BY finance . date ASC");
  $result = query("SELECT * FROM expenditure WHERE user = '$userActive' AND month = '$month' AND year = '$year' ORDER BY expenditure . date ASC");
}
foreach($result as $row){
  $income += $row["nominal"];
}
foreach($moneys as $row){
  $include += $row["balance"];
}


// End Function tabel print

$mpdf->SetTitle('Financial Report');
$mpdf->SetSubject('Be an honest and trustworthy treasurer');
$mpdf->SetKeywords('Financial Report, finance,  Cash book');
$mpdf->SetAuthor($userActive.' [Treasurer]');
$mpdf->SetCreator('InSketch Finance Management');

$html = '<style>
h1 {
  font-size: 20px;
  text-transform: uppercase;
  text-align: center;
}
body table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 2px;
}
table tbody :where(.in, .out) {
  text-align: right;
}
th {
  background-color: #dedede;
  color: #333;
  font-weight: bold;
  font-size: 18px;
}
table td {
  padding: 8px;
}
table th {
  padding: 10px;
}
.sig {
  margin: 2rem 0;
  text-align: left;
  font-size: 1.2rem;
}
.sig .buttom {
  margin-top: 30px;
  font-size: 1.05em;
  font-weight: bold;
  text-decoration: underline;
}
border, td, tr, th{
    border-collapse: collapse;
    border: 1px solid;
}
</style>';
$html .= '<body>
<h1>'.$_SESSION["info"][0].' FINANCIAL REPORT <br/> FOR '.$month.' '.$year.'</h1> <br/>';
$html .= '<table>
  <tbody>
    <tr >
      <th width= "20px">NO</th>
      <th colspan="2" style="letter-spacing: 8px">DESCRIPTION</th>
      <th width= "100px">INCOME</th>
      <th width= "100px">COST</th>
    </tr>
  </tbody>
  <tbody>
    <tr style="line-height: 1.5rem;">
      <td></td>
      <td colspan="2" valign="top" align="left">Sisa saldo bulan '.$tanggal[2].' '.$tanggal[1].'<br />';
        foreach($moneys as $row){
            $html .= $row["activity"].'<br />';
        };
$html .= '</td><td valign="top" align="right">'.number_format($record["blance"] , 0, ",", ".").',-<br />';
        foreach($moneys as $row){
            $html .= number_format($row["balance"] , 0, ",", ".").',-<br />';
        }
$html .= '</td>
      <td align="right"></td>
    </tr>
  </tbody>
  <tbody>
    <tr>
      <th colspan="3" style="letter-spacing: 8px">AMOUNT</th>
      <th align="right" style="font-weight: normal; font-size: 15px;">'.number_format($include + $record["blance"] , 0, ",", ".").',-</th>
      <th></th>
    </tr>
  </tbody>
  <tbody>';
  $i = 1;
  foreach($result as $row){
    $html .= '<tr align="right" style="line-height: 1.5rem; font-size: 17px">
        <td align="center">'.$i++.'</td>
        <td align="center" style="width: 100px">'.$row["date"].'</td>
        <td align="left">'.$row["activities"].'</td>
        <td></td>
        <td align="right">'.number_format($row["nominal"], 0, ",", ".").',-</td>
        </tr>';
  }
$html .= '</tbody>
  <tfoot>
    <tr>
      <td align="center" colspan="3" rowspan="2" style="font-size: 18px">'.$month.' '.$year.' balance (Cash)</td>
      <td align="right">'.number_format($include + $record["blance"] , 0, ",", ".").',-</td>
      <td align="right">'.number_format($income , 0, ",", ".").',-</td>
    </tr>
    <tr>
      <td></td>
      <td align="right">'.number_format($include + $record["blance"] - $income , 0, ",", ".").',-</td>
    </tr>
    <tr style="font-weight: bold; font-size: 18px; padding: 10px">
      <td colspan="3" style="padding: 13px; letter-spacing: 8px; font-weight: bold" align="center">AMOUNT</td>
      <td align="right">'.number_format($include + $record["blance"] , 0, ",", ".").',-</td>
      <td align="right">'.number_format($include + $record["blance"] , 0, ",", ".").',-</td>
    </tr>
  </tfoot>
</table>
<div class="sig">
  <div class="top">
    <p>'.$_SESSION["info"][1].', '.date("d F Y").'<br/>Treasurer</p>
  </div>
  <div class="buttom"><p>'.$userActive.'</p></div>
</div>
</body>';
$mpdf->WriteHTML($html);
$mpdf->Output('Financial Report For '.$month.'['.$year.'].pdf', 'I');