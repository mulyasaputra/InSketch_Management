<?php 
$resultDF = query("SELECT * FROM finance WHERE user = '$userActive'");
if ($resultDF == false){
  return false;
} else {
  foreach($resultDF as $row){
    $years[]= substr($row["date"],0,4);
  }
  rsort($years);
  $duplicates = array_unique($years);
}
$bulan = date("F");
if(isset($_POST['submit'])){
  if(!empty($_POST['mounth']) and !empty($_POST['year'])) {
      $month = $_POST['mounth'];
      $year = $_POST['year'];
      $bulan = date("F", mktime(0, 0, 0, $_POST['mounth'], 10));
  }
}
$resultWallet = query("SELECT * FROM finance WHERE user = '$userActive' AND MONTH(date) = '$month' AND YEAR(date) = '$year'  ORDER BY finance . date DESC");
$nextyear  = date('Y', strtotime("+1 year"));
$awal  = date_create($nextyear.'-01-01');
$akhir = date_create();
$diff  = date_diff( $awal, $akhir );
?>
<div class="text">Center Banking</div>

<!-- METADATA SECTION -->
<link rel="stylesheet" href="css/wallets.css" />
<link href="vanilla-calendar.min.css" rel="stylesheet">
<script src="vanilla-calendar.min.js" defer></script>
<style>
  .vanilla-calendar{
      height: 100%;
      width: 100%;
  }
</style>

<!-- HTML SECTION -->
<div class="mainBody">
  <div class="cardInfo">
    <div class="masterCard">
        <div class="svgBackground">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill-opacity="0.2" d="M0,256L120,218.7C240,181,480,107,720,69.3C960,32,1200,32,1320,32L1440,32L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
        </div>
        <div class="saldoBank flex">
          <div class="a">
            <span>Current Balance</span>
            <h3><?= toCurrency($balanceEx-clean_array($outMoney)["total"],0); ?></h3>
          </div>
          <div class="b flex">
            <span></span>
            <span></span>
          </div>
        </div>
        <div class="numberUnique flex">
          <span><?= $_SESSION["info"][2]; ?></span><span></span><span>09/25</span>
        </div>
        <div class="svg">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 752 752">
            <path d="m179.95 215.55c-14.777 0-26.527 11.75-26.527 26.527v74.719h132.61c5.9336-13.645 17.008-24.52 30.773-30.402v-70.844zm146.33 0v73.609h0.003906c-0.003906 2-1.2617 3.7852-3.1445 4.457-13.742 4.8867-24.598 15.699-29.508 29.434-0.007812 0.023437-0.011719 0.050781-0.019531 0.074219-0.45312 1.2695-0.85156 2.5625-1.2031 3.875-0.003906 0-0.015625 0.046875-0.019532 0.066406-0.33203 1.2422-0.60156 2.5117-0.83203 3.793-0.019531 0.10547-0.046875 0.20703-0.066406 0.3125-0.1875 1.0742-0.32031 2.168-0.43359 3.2656-0.03125 0.32812-0.09375 0.64453-0.12109 0.97266-0.11719 1.3594-0.17578 2.7422-0.17578 4.1328v72.906c0 1.3945 0.058594 2.7734 0.17578 4.1328 0.027343 0.32812 0.085937 0.64453 0.12109 0.97266 0.11719 1.0977 0.24609 2.1914 0.43359 3.2656 0.019531 0.10547 0.046875 0.20703 0.066406 0.3125 0.23438 1.2812 0.50391 2.5469 0.83203 3.793 0.003907 0 0.015626 0.046875 0.019532 0.066406 0.35156 1.3125 0.75 2.6055 1.2031 3.875 0.007812 0.019531 0.011719 0.039063 0.019531 0.058594 0.003906 0 0.003906 0 0.007812 0.046875 4.9102 13.727 15.758 24.539 29.496 29.422h0.003906c1.8828 0.67188 3.1406 2.457 3.1445 4.457v73.609h99.453v-73.609h-0.003907c0.003907-2 1.2617-3.7852 3.1484-4.457 13.742-4.8867 24.598-15.699 29.508-29.434h-0.003906c0.007813-0.023437 0.011719-0.050781 0.019532-0.074219 0.45312-1.2695 0.85156-2.5625 1.2031-3.875 0.003907 0 0.015626-0.046874 0.019532-0.066406 0.33203-1.2422 0.60156-2.5117 0.83203-3.793 0.019531-0.10547 0.046875-0.20703 0.066406-0.3125 0.1875-1.0742 0.32031-2.1641 0.43359-3.2656 0.03125-0.32812 0.09375-0.64453 0.12109-0.97266 0.11719-1.3594 0.17578-2.7422 0.17578-4.1328v-72.906c0-1.3945-0.058594-2.7734-0.17578-4.1328-0.027344-0.32812-0.085938-0.64453-0.12109-0.97266-0.11719-1.0977-0.24609-2.1914-0.43359-3.2656-0.019531-0.10547-0.046875-0.20703-0.066406-0.3125-0.23438-1.2812-0.50391-2.5469-0.83203-3.793-0.003906 0-0.015625-0.046875-0.019532-0.066406-0.35156-1.3125-0.75-2.6055-1.2031-3.875-0.007813-0.027344-0.019532-0.054687-0.027344-0.085937-4.9102-13.727-15.758-24.539-29.496-29.422h-0.003906c-1.8828-0.67187-3.1406-2.457-3.1445-4.457v-73.609h-99.453zm108.92 0v70.844c13.766 5.8867 24.84 16.758 30.773 30.402h132.61v-74.719c0-14.777-11.758-26.527-26.539-26.527zm-281.78 110.72v99.453h129.42c-1.0117-4.2539-1.5547-8.6914-1.5547-13.273v-72.906c0-4.582 0.54297-9.0195 1.5547-13.273zm315.75 0c1.0117 4.2539 1.5547 8.6914 1.5547 13.273v72.906c0 4.582-0.54297 9.0195-1.5547 13.273h129.42v-99.453zm-315.75 108.92v74.727c0 14.777 11.75 26.527 26.527 26.527h136.86v-70.852c-13.766-5.8867-24.84-16.758-30.773-30.402zm312.55 0c-5.9336 13.645-17.008 24.516-30.773 30.402v70.852h136.85c14.777 0 26.539-11.75 26.539-26.527v-74.727z"/>
          </svg>
        </div>
    </div>
  </div>
  <div class="tabLeft"><h3><?= $diff->days; ?></h3></div>
  <div class="recent"><div class="vanilla-calendar"></div></div>
</div>

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
        <option value="<?= $month; ?>"><?= $bulan ?></option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
      <button type="submit" name="submit" class="btn btn-primary">GO</button>
    </div>
  </form>
  <a href="?p=wallets">
    <button class="show_alert btn btn-primary">Add balance</button>
  </a>
</div>

<section id="history">
<!-- DataTales history -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">History</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="min-width: 10px">No</th>
            <th style="width: 100%; min-width: 460px">Activities</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach($resultWallet as $row) : ?>
          <?php $date = date("d F Y", strtotime($row["date"])); $balance = number_format($row["balance"],0,',','.'); $activity = $row["activity"]; ?>
          <tr>
            <td style="vertical-align: middle;"><?= $i; ?></td>
            <td style="vertical-align: middle;"><?php echo("[&#128513] Treasurer added a balance on ".$date." of Rp. ".$balance." from ".$activity); ?></td>
            <td style="vertical-align: middle; text-align: center">
              <a href="pages/delete.php?remove=<?= $row["id"]; ?>">
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
</section>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const calendar = new VanillaCalendar('.vanilla-calendar');
    calendar.init();
  });
</script>
<!-- Custom scripts for all pages-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="logic/activities.js"></script>