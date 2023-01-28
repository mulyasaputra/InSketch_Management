<?php 
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
?>
<!-- Html Section -->
<div class="text"><?= $month; ?> Activity</div>

<!-- Data script start -->
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet"
/>
<link href="css/activities.css" rel="stylesheet" />

<!-- Navigasi DataTabel -->
<div class="container-nav flex">
  <form action="" method="post">
    <div class="short flex">
        <select id="year" name="year">
          <option value="<?= $year; ?>"><?= $year; ?></option>
          <?php foreach ($duplicates as $value) : ?>
            <option value="<?= $value; ?>"><?= $value; ?></option>
          <?php endforeach ?>
        </select>
        <select id="mounth" name="mounth">
          <option value="<?= $month; ?>"><?= $month; ?></option>
          <option value="January">January</option>
          <option value="February">February</option>
          <option value="March">March</option>
          <option value="April">April</option>
          <option value="May">May</option>
          <option value="June">June</option>
          <option value="July">July</option>
          <option value="August">August</option>
          <option value="September">September</option>
          <option value="October">October</option>
          <option value="November">November</option>
          <option value="December">December</option>
        </select>
        <button type="submit" name="submit" class="btn btn-primary">GO</button>
      </div>
  </form>
  <div class="button-action-nav flex">
    <a href="section/returnRecord.php?F=<?= $month;?>&Y=<?= $year; ?>"
      ><button class="btn btn-warning flex"><i class='bx bx-lock-alt'></i> Cut off</button></a
    >
    <a target="_blank" href="preview.php?F=<?= $month;?>&Y=<?= $year; ?>"
      ><button class="btn btn-success flex"><i class="bx bx-printer"></i> Print</button></a
    >
    <a href="?p=activities&a=add"
      ><button class="btn btn-danger flex"><i class="bx bx-plus"></i> Add</button></a
    >
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="min-width: 10px">No</th>
            <th style="min-width: 140px">Date</th>
            <th style="width: 100%; min-width: 500px">Activities</th>
            <th style="min-width: 160px">Nominal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach($result as $row) : ?>
          <tr>
            <td style="vertical-align: middle;"><?= $i; ?></td>
            <td style="vertical-align: middle;"><?= $row["date"]; ?></td>
            <td style="vertical-align: middle;"><?= $row["activities"]; ?></td>
            <td style="vertical-align: middle;">Rp. <?= toCurrency($row["nominal"],2); ?></td>
            <td style="vertical-align: middle;">
              <div class="flex btn-action-tabel">
                <a href="?p=activities&a=edit&id=<?= $row["id"]; ?>">
                  <button class="btn btn-primary"><i class="bx bx-edit"></i></button>
                </a>
                <a href="pages/delete.php?id=<?= $row["id"]; ?>">
                  <button class="btn btn-danger delete"><i class="bx bx-trash"></i></button>
                </a>
              </div>
            </td>
          </tr>
          <?php $i++ ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Custom scripts for all pages-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="logic/activities.js"></script>
