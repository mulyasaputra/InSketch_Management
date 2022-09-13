<!-- Botom Navigatiaon -->
<section id="navigasiBar" class="navigasiBar">
  <div class="menu-bar2">
    <div class="menu2">
      <ul class="menu-links flex">
        <li class="nav-link2 <?php if (isset($dashboard)) echo $dashboard; ?>">
          <a href="?url=dashboard">
            <i class="bx bx-home-alt icon"></i>
            <span class="text nav-text">Dashboard</span>
          </a>
        </li>

        <li class="nav-link2 <?php if (isset($activities)) echo $activities; ?>">
          <a href="?url=activities">
            <i class="bx bx-bar-chart-alt-2 icon"></i>
            <span class="text nav-text">Activities</span>
          </a>
        </li>

        <li class="nav-link2 <?php if (isset($wallets)) echo $wallets; ?>">
          <a href="?url=wallets">
            <i class="bx bx-wallet icon"></i>
            <span class="text nav-text">Wallets</span>
          </a>
        </li>

        <li class="nav-link2 <?php if (isset($analytics)) echo $analytics; ?>">
          <a href="?url=analytics">
            <i class="bx bx-pie-chart-alt icon"></i>
            <span class="text nav-text">Analytics</span>
          </a>
        </li>

        <li class="nav-link2 <?php if (isset($settings)) echo $settings; ?>">
          <a href="?url=settings">
            <i class="bx bx-cog icon"></i>
            <span class="text nav-text">Settings</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</section>
