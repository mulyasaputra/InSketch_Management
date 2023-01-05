<body id="thames">
  <?= include 'section/slidebar.php'; ?>
  <!-- Main View -->
  <section class="home close">
    <?php include $index; ?>
    <div class="spasi" style="height: 15px"></div>
  </section>
  <?= include 'section/navbottom.php'; ?>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="Modalclose">
            <span>×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary XClose">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Alert Financial Expenses -->
  <div id="overLoad" class="<?= $showAlert; ?>">
    <p>Overspending [ You are too extravagant ]</p>
  </div>
</body>
