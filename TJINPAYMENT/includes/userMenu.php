<?PHP
	$page = basename($_SERVER["PHP_SELF"]);
?>
<aside id="left-panel">
  <div class="login-info"> <span>
    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut"> <span> <?php echo "Welcome " .  $name; ?> </span> </a> </span> </div>
  <nav>
    <ul>	
      

      <li <?php if($page=='profile.php') { echo ('class="active"');}?>> <a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
      <li <?php if($page=='sendmoney.php') { echo ('class="active"');}?>> <a href="sendmoney.php"><i class="fa fa-money"></i>&nbsp;Send Money</a></li>
      <li <?php if($page=='requestmoney.php') { echo ('class="active"');}?>> <a href="requestmoney.php"><i class="fa fa-money"></i>&nbsp;Request Money</a></li>
     

    </ul>
  </nav>
</aside>