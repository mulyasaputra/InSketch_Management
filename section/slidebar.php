<nav class="sidebar close">
  <header>
    <div class="image-text">
      <span class="image pic">
        <!-- <img src="logo.png" alt="" /> -->
        <h5><?= substr($userActive,0,1); ?></h5>
      </span>

      <div class="text logo-text">
        <span class="name"><?= $userActive; ?></span>
        <span class="profession">Management</span>
      </div>
    </div>

    <i class="bx bx-chevron-right toggle"></i>
  </header>

  <div class="menu-bar">
    <div class="menu">
      <li class="search-box">
        <i class="bx bx-search icon"></i>
        <input type="text" placeholder="Search..." />
      </li>

      <ul class="menu-links inx">
        <li class="nav-link <?php if (isset($dashboard)) echo $dashboard; ?>">
          <a href="?url=dashboard">
            <i class="bx bx-home-alt icon"></i>
            <span class="text nav-text">Dashboard</span>
          </a>
        </li>

        <li class="nav-link <?php if (isset($activities)) echo $activities; ?>">
          <a href="?url=activities">
            <i class="bx bx-bar-chart-alt-2 icon"></i>
            <span class="text nav-text">Activities</span>
          </a>
        </li>

        <li class="nav-link <?php if (isset($savings)) echo $savings; ?>">
          <a href="?url=savings&th=<?= $year; ?>">
          <i class='bx bx-shield-alt-2 icon'></i>
            <span class="text nav-text">Savings</span>
          </a>
        </li>

        <li class="nav-link <?php if (isset($analytics)) echo $analytics; ?>">
          <a href="?url=analytics">
            <i class="bx bx-pie-chart-alt icon"></i>
            <span class="text nav-text">Analytics</span>
          </a>
        </li>

        <li class="nav-link <?php if (isset($wallets)) echo $wallets; ?>">
          <a href="?url=wallets">
            <i class="bx bx-wallet icon"></i>
            <span class="text nav-text">Wallets</span>
          </a>
        </li>

        <li class="nav-link <?php if (isset($settings)) echo $settings; ?>">
          <a href="?url=settings">
            <i class="bx bx-cog icon"></i>
            <span class="text nav-text">Settings</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="bottom-content">
      <li class="logout">
        <a href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="bx bx-log-out icon"></i>
          <span class="text nav-text">Logout</span>
        </a>
      </li>

      <li class="mode btn-thames">
        <div class="sun-moon">
          <i class="bx bx-moon icon moon"></i>
          <i class="bx bx-sun icon sun"></i>
        </div>
        <span class="mode-text text">Dark mode</span>

        <div class="toggle-switch">
          <span class="switch"></span>
        </div>
      </li>
    </div>
  </div>
</nav>
