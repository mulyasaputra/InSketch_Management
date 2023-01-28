<?php 
session_start();
require 'logic/function.php';
if (!isset($_SESSION["login"])){
  header("Location: admin.php");
  exit;
}
$userActive = $_SESSION["login"];
$year = $_GET["Y"];
$month = $_GET["F"];
$result = query("SELECT * FROM expenditure WHERE user = '$userActive' AND month = '$month' AND year = '$year' ORDER BY expenditure . date ASC");
$income = "";
$i = 1;
foreach($result as $row) {
  $income .='{
    no: "'.$i++.'",
    tanggal: "'.$row['date'].'",
    deskripsi: "'.$row['activities'].'",
    nominal: "Rp. '.number_format($row['nominal'] , 2, ",", ".").'",
  },';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <title>Document</title>
    <style>
      .container{
        height: 100vh;
        padding: 2em;
      }
      .button{
        margin-top: 1.5em;
        display: flex;
        gap: 1em;
      }
      a {
        text-decoration: none !important;
      }
      button i {
        margin-right: 10px;
      }
      embed {
        aspect-ratio: 9 / 11;
        display: inline;
        max-width: 690px;
      }
      @media (max-width: 500px){
        .container{
        padding: 1em;
      }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <embed type="application/pdf" src="print.php?F=<?= $month; ?>&Y=<?= $year; ?>" width="100%"></embed>
      <div class="button">
        <a target="blank" href="print.php?F=<?= $month; ?>&Y=<?= $year; ?>">
          <button class="btn btn-danger"><i class="bx bxs-file-pdf"></i>Print To PDF</button>
        </a>
          <button onclick="dformat()" class="btn btn-success"><i class="bx bx-download"></i>Print To XLSX</button>
      </div>
    </div>
    <!-- Exel -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-0.19.2/package/dist/xlsx.mini.min.js"></script>
    <script>
      function dformat() {
        var createXLSLFormatObj = [];
        var xlsHeader = ["No", "Tanggal", "Deskripsi", "Nominal"];
        var xlsRows = [<?= $income; ?>];
        createXLSLFormatObj.push(xlsHeader);
        $.each(xlsRows, function (index, value) {
          var innerRowData = [];
          $("tbody").append(
            "<tr><td>" +
              value.no +
              "</td><td>" +
              value.tanggal +
              "</td><td>" +
              value.deskripsi +
              "</td></tr>" +
              value.nominal +
              "</td></tr>"
          );
          $.each(value, function (ind, val) {
            innerRowData.push(val);
          });
          createXLSLFormatObj.push(innerRowData);
        });

        /* File Name */
        var filename = "Financial Report <?= $month; ?> <?= $year; ?>.xlsx";
        var ws_name = "Activity";
        if (typeof console !== "undefined") console.log(new Date());
        var wb = XLSX.utils.book_new(),
          ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);
        XLSX.utils.book_append_sheet(wb, ws, ws_name);
        if (typeof console !== "undefined") console.log(new Date());
        XLSX.writeFile(wb, filename);
      }
    </script> 
  </body>
</html>
