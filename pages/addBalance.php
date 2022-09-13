<?php 
if(isset($_POST["addBalance"])){
    if(inputMoney($_POST) > 0 ){
      echo "<script> alert('berhasil');
            document.location.href = '?url=wallets';</script>";
    } else {
      echo mysqli_error($conn);
    }
  }
?>
<link rel="stylesheet" href="css/addActivity.css" />
<section id="addBaance" class="flex">
  <form action="" method="post" id="form-add" class="flex">
    <h3 class="form-title">Input the data</h3>
    <div class="activities">
      <label for="text">Activity</label>
      <input type="text" name="activity" id="text" required />
    </div>
    <div class="date">
      <label for="dateofbirth">Date</label>
      <input type="date" name="date" id="dateofbirth" required/>
    </div>
    <div class="nominal">
      <label for="nominal">Nominal</label>
      <input type="text" name="nominal" id="nominal" required/>
    </div>
    <button type="submit" name="addBalance" class="btn btn-success">Add Balance</button>
  </form>
</section>
<script src="logic/addActivity.js"></script>