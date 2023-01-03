<?php 
if(isset($_GET['th'])){
    $th = $_GET['th'];
} else {
    header('Location: ?url=savings&th='.$year);
};
function resultData($user, $th, $table){
  $result = query("SELECT * FROM $table WHERE user = '$user' AND YEAR(date) ='$th'");
  return $result;
};
function saving($user, $th, $table) {
    return SUM("SELECT SUM(nominal) AS total FROM $table WHERE user = '$user' AND YEAR(date) ='$th'")['total'];
};
function financialBackup($user, $table){
  return SUM("SELECT SUM(nominal) AS total FROM $table WHERE user = '$user'")['total'];
}
$financialBackup = financialBackup($userActive, "savings") - financialBackup($userActive, "savings_out");
$incomeResult = resultData($userActive, $th, "savings");
$spendingResult = resultData($userActive, $th, "savings_out");
?>
<!-- Html Section -->
<div class="text">Financial Backup Tube</div>

<!-- Data script start -->
<link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet"
/>
<link href="css/activities.css" rel="stylesheet" />
<link href="css/savings.css" rel="stylesheet" />

<!-- BarInfo data -->
<div class="box-container flex">
  <div class="container flex shadow" style="--color-thames: #e74a3b">
    <h5>Total savings</h5>
    <div class="box-desk flex">
      <span>Rp. <?= toCurrency($financialBackup,0); ?></span>
      <i class="box-icon bx bx-shield-alt-2"></i>
    </div>
  </div>
  <div class="container flex shadow" style="--color-thames: #1cc88a">
    <h5>Savings in <?= $th; ?></h5>
    <div class="box-desk flex">
      <span>Rp. <?= toCurrency(saving($userActive, $th, "savings"),0); ?></span>
      <i class="bx bx-credit-card box-icon"></i>
    </div>
  </div>
  <div class="container flex shadow" style="--color-thames: #f6c23e">
    <h5>Saving out in <?= $th; ?></h5>
    <div class="box-desk flex">
      <span>Rp. <?= toCurrency(saving($userActive, $th, "savings_out"),0); ?></span>
      <i class="bx bx-dollar box-icon"></i>
    </div>
  </div>
</div>
<!-- DataTales Example -->
<div class="container tabel-grid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 flex">
            <h6 class="m-0 font-weight-bold text-primary">Income activity</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="header-td1">No</th>
                            <th class="header-td2">Date</th>
                            <th class="header-td3">Activities</th>
                            <th class="header-td4">Nominal</th>
                            <th class="header-td5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($incomeResult as $row) : ?>
                        <tr>
                            <td style="vertical-align: middle;"><?= $i; ?></td>
                            <td style="vertical-align: middle;"><?= $row["date"]; ?></td>
                            <td style="vertical-align: middle;"><?= $row["activities"]; ?></td>
                            <td style="vertical-align: middle;">Rp. <?= toCurrency($row["nominal"],2); ?></td>
                            <td style="text-align: center;">
                              <a href="pages/delete.php?fbIncome=<?= $row["id"]; ?>">
                                <button class="btn btn-danger delete"><i class="bx bx-trash"></i></button>
                              </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 flex">
            <h6 class="m-0 font-weight-bold text-primary">Spending activity</h6>
            <a href="?p=spendsaving">
                <button class="btn btn-danger flex"><i class="bx bx-plus"></i> Add</button>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th class="header-td1">No</th>
                          <th class="header-td2">Date</th>
                          <th class="header-td3">Nominal</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($spendingResult as $row) : ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $i; ?></td>
                                <td style="vertical-align: middle;"><?= $row["date"]; ?></td>
                                <td style="vertical-align: middle;">Rp. <?= toCurrency($row["nominal"],2); ?></td>
                                <td style="text-align: center;">
                                  <a href="pages/delete.php?spend=<?= $row["id"]; ?>">
                                    <button class="btn btn-danger delete"><i class="bx bx-trash"></i></button>
                                  </a>
                                </td>
                            </tr>
                        <?php $i++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom scripts for all pages-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="logic/activities.js"></script>
