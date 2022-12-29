<?php 
if (isset($_GET['url'])){
    $url=$_GET['url'];
    switch($url){
        case 'dashboard': include 'logic/inproper.php';
        $index = 'layout/Dashboard.php';
        $dashboard = "activeBtn";
        $title = "Financial Management";
        break;

        case 'activities': $index = 'layout/Activities.php';
        $activities = "activeBtn";
        $title = "Aktifitas";
        break;

        case 'savings': $index = 'layout/Savings.php';
        $savings = "activeBtn";
        $title = "savings";
        break;

        case 'analytics': $index = 'layout/Analytics.php';
        $analytics = "activeBtn";
        $title = "Analytics";
        break;

        case 'settings': $index = 'layout/Settings.php';
        $settings= "activeBtn";
        $title = "Settings";
        break;

        case 'wallets': $index = 'layout/Wallets.php';
        $wallets = "activeBtn";
        $title = "Wallets";
        break;
    }
} elseif (isset($_GET['p'])){
    $p=$_GET['p'];
    switch($p){
        case 'activities': $index = 'pages/add.php';
        $activities = "activeBtn";
        $title = "Activities";
        break;

        case 'wallets': $index = 'pages/addBalance.php';
        $wallets = "activeBtn";
        $title = "Add balance";
        break;

        case 'spendsaving': $index = 'pages/spendsaving.php';
        $spendsaving = "activeBtn";
        $title = "Spending activity";
        break;
    }
} else {
    header("Location: ?url=dashboard");
}
?>