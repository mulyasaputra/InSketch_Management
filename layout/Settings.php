<?php
// Update Data User
if(isset($_POST["updateProfile"])){
  updateProfile($_POST);
  $_SESSION["info"][0] = $_POST["instansi"];
  echo "<script> alert('Update Berhasil');</script>";
}
$user = query("SELECT * FROM users WHERE username = '$userActive'")[0];


// Delet Data User
if(isset($_POST["deletUser"])){
  $password = $_POST['password'];
  if(password_verify($password, $user["password"])){
    echo "<script> alert('User successfully deleted');</script>";
    echo "<script> alert('Have a nice day');</script>";
    deletUser();
    echo "<script>document.location.href = 'logout.php';</script>";
  } else {
    echo "<script> alert('Password wrong');
    document.location.href = '?url=settings'</script>";
  }
}
?>

<div class="text">Settings Sidebar</div>
<title>Apps Settings</title>
<link rel="stylesheet" href="css/Settings.css" />

<section id="mainSection">
  <div class="topBar flex">
    <div class="profile flex">
      <h2>S</h2>
      <div>
        <h4><?= $user['name']; ?></h4>
        <span>@<?= $userActive; ?></span>
      </div>
    </div>
    <div class="buttonAction flex">
      <i class="bx-icon bx bx-pencil editButton"></i>
      <i class="bx-icon bx bx-trash-alt deletButton"></i>
      <i class="bx-icon bx bx-user"></i>
      <i class="bx-icon bx bx-dots-horizontal-rounded"></i>
    </div>
  </div>
  <div class="mainaps mt">
    <div class="noty">
      <h3>Notyfication setting</h3>
      <p>
        By default, designers will be notified by your company's preferred dark patterns.<br />
        Employees can also customize their notification preferences by logging into the <span>Setproduct dashboard</span>
      </p>
    </div>
    <div class="suport">
      <!-- <h3>Suport</h3> -->
    </div>
  </div>
  <div class="info mt">
    <h3>Profile</h3>
    <form action="" method="post">
      <ul>
        <li class="Fieldset">
          <div class="fileds">
            <h3 class="Fs-H"><span>Name</span></h3>
            <input value="<?= $user['name']; ?>" type="text" name="names" id="name" class="before-Fs" required disabled />
          </div>
        </li>
        <li class="Fieldset">
          <div class="fileds">
            <h3 class="Fs-H"><span>Contact</span></h3>
            <input value="<?= $user['contact']; ?>" type="text" name="contact" id="contact" class="before-Fs" required disabled />
          </div>
        </li>
        <li class="Fieldset">
          <div class="fileds">
            <h3 class="Fs-H"><span>Email</span></h3>
            <input value="<?= $user['email']; ?>" type="email" name="email" id="email" class="before-Fs" required disabled />
          </div>
        </li>
        <li class="Fieldset">
          <div class="fileds">
            <h3 class="Fs-H"><span>Location</span></h3>
            <input value="<?= $user['location']; ?>" type="text" name="location" id="location" class="before-Fs" required disabled />
          </div>
        </li>
        <li class="Fieldset">
          <div class="fileds">
            <h3 class="Fs-H"><span>Instansi</span></h3>
            <input value="<?= $user['Instansi']; ?>" type="text" name="instansi" id="instansi" class="before-Fs" required disabled />
          </div>
        </li>
        <li class="Fieldset">
          <div class="fileds">
            <h3 class="Fs-H"><span>Master key</span></h3>
            <input value="Can't be changed" type="text" name="password" id="password" class="before-Fs" required disabled />
          </div>
        </li>
      </ul>
      <button type="submit" name="updateProfile" class="btn btn-success buttonSubmit" disabled>Submit</button>
    </form>
  </div>
  <div class="primarySetting mt">
    <h4>primary setting</h4>
    <div class="flex">
      <div class="buttonThames darkMode flex">
        <div class="sun-moon">
          <i class="bx bx-moon icon moon"></i>
          <i class="bx bx-sun icon sun"></i>
        </div>
        <div class="label">
          <h5>Dark mode</h5>
          <p class="textMode">Enable dark theme</p>
        </div>
        <div class="toggle-switch2">
          <span class="switch2"></span>
        </div>
      </div>
      <div class="darkMode flex">
        <div class="label">
          <h5>Dark mode</h5>
          <p>Enable dark theme</p>
        </div>
        <div class="toggle-switch2">
          <span class="switch2"></span>
        </div>
      </div>
    </div>
  </div>
  <div class="optionSetting mt">
    <h4>Secondary option</h4>
    <div class="years">
      <p>delete job by</p>
      <button class="btn btn-primary">2022</button>
      <button class="btn btn-primary">2023</button>
    </div>
    <div class="pdf-menu">
      <p>Seting file output from PDF</p>
      <form action="#" method="get">
        <div class="input-form">
          <label for="size">Paper size [Milimeter]</label>
          <div class="paper-size">
            <input type="text" name="size-width" id="size-width"  placeholder="Width">
            <input type="text" name="size-height" id="size-height" placeholder="Height">
          </div>
        </div>
        <div class="input-form">
          <label for="Margin">Margin [Top, Right, Bottom, Left]</label>
          <div class="margin-size">
            <input type="text" name="margin-top" id="margin-top" placeholder="Top">
            <input type="text" name="margin-right" id="margin-right" placeholder="Right">
            <input type="text" name="margin-bottom" id="margin-bottom" placeholder="Bottom">
            <input type="text" name="margin-left" id="margin-left" placeholder="Left">
          </div>
        </div>
        <button class="btn btn-success" type="submit">Save</button>
      </form>
    </div>
  </div>
  <div class="cekPassword">
    <form action="" method="POST">
      <label for="username">Enter password to confirm</label>
      <input type="text" name="password" id="username">
      <button type="submit" name="deletUser" class="btn btn-danger">Forget me!!!</button>
    </form>
  </div>
</section>
<script>
  let editButton = document.querySelector(".editButton"),
      buttonSubmit = document.querySelector(".buttonSubmit"),
      cekPassword = document.querySelector(".cekPassword"),
      deletButton = document.querySelector(".deletButton"),
      input = document.querySelectorAll(".fileds input"),
      buttonThames = document.querySelector(".buttonThames"),
      textMode = document.querySelector(".textMode"),
      idBody = document.querySelector("#thames"),
      log = JSON.parse(localStorage.getItem("mode"));

  editButton.addEventListener('click', () => {
    editButton.classList.toggle("active");
    buttonSubmit.toggleAttribute('disabled');
    for (var i = 0; i < input.length; i++) {
      input[i].toggleAttribute('disabled');
    }
  })
  deletButton.addEventListener('click', (e) => {
    cekPassword.classList.add("true");
  })
  
  if (log !== null){
    textMode.innerText = log[1];
  }

  const darksMode = () => {
    idBody.classList.add("dark");
    buttonThames.classList.add("darkM");
    localStorage.setItem("thames", "dark");
    localStorage.setItem("mode", JSON.stringify(["Light mode", "Disable dark theme"]));
  };
  const lightsMode = () => {
    idBody.classList.remove("dark");
    buttonThames.classList.remove("darkM");
    localStorage.setItem("thames", "light");
    localStorage.setItem("mode", JSON.stringify(["Dark mode", "Enable dark theme"]));
  };
  buttonThames.addEventListener("click", function () {
    thames = localStorage.getItem("thames");
    if (thames === "light") {
      darksMode();
      textMode.innerText = "Disable dark theme";
    } else {
      lightsMode();
      textMode.innerText = "Enable dark theme";
    }
  });
</script>
