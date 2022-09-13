<!-- PHP -->
<?php 
// Add Data
if(isset($_POST["addButton"])){
  if(adddataTabel($_POST) > 0 ){
    echo "<script> alert('berhasil');
          document.location.href = '?url=activities';</script>";
  } else {
    echo mysqli_error($conn);
  }
}

// Update Data
if(isset($_POST["editButton"])){
  if(updatedataTabel($_POST) > 0 ){
    echo "<script> alert('berhasil');
          document.location.href = '?url=activities';</script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>
<!-- Metadata -->
<link rel="stylesheet" href="css/addActivity.css" />
<section id="addActivity" class="flex">
<!-- Body -->
<?php  $a=$_GET['a']; ?>
<?php if($a == "edit") : ?>
  <?php 
    if(isset($_GET["id"])){
      $id = $_GET['id'];
      $data = query("SELECT * FROM expenditure WHERE id = $id")[0];
    } else {
      echo "<script>document.location.href = '?url=activities';</script>";
      return;
    }
  ?>
  <form action="" method="post" id="form-add" class="flex">
    <h3 class="form-title">Enter today's activity</h3>
    <div class="activities">
      <label for="text">Activity</label>
      <input type="text" name="activity" id="text" required value="<?= $data["activities"]; ?>"/>
    </div>
    <div class="date">
      <label for="dateofbirth">Date</label>
      <input type="date" name="date" id="dateofbirth" required value="<?= $data["date"]; ?>"/>
    </div>
    <div class="nominal">
      <label for="nominal">Nominal</label>
      <input type="text" name="nominal" id="nominal" required value="Rp. <?=number_format($data["nominal"],0,',','.'); ?>"/>
    </div>
    <input type="hidden" name="id" value="<?= $data["id"]; ?>">
    <button type="submit" name="editButton" class="btn btn-warning">Update Data</button>
  </form>
<?php else : ?>
  <form action="" method="post" id="form-add" class="flex">
    <h3 class="form-title">Enter today's activity</h3>
    <div class="activities">
      <label for="text">Activity</label>
      <input type="text" name="activity" id="text" required/>
    </div>
    <div class="date">
      <label for="dateofbirth">Date</label>
      <input type="date" name="date" id="dateofbirth" required/>
    </div>
    <div class="nominal">
      <label for="nominal">Nominal</label>
      <input type="text" name="nominal" id="nominal" required/>
    </div>
    <button type="submit" name="addButton" class="btn btn-primary">Add Data</button>
  </form>
<?php endif; ?>
</section>
<!-- Script -->
<script src="logic/addActivity.js"></script>
