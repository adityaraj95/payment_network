<?PHP
	$page = basename($_SERVER["PHP_SELF"]);
?>
<aside id="left-panel">
  <div class="login-info"> <span>
    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut"> <img src="img/avatars/avatar.png" alt="me" class="online" /> <span> User </span> </a> </span> </div>
  <nav>
    <ul>	
      <li <?php if($page=='my_account.php') { echo ('class="active"');}?>> <a href="my_account.php"><i class="fa fa-lg fa-fw fa-home"></i>&nbsp;PayNow</a></li>

      <li <?php if($page=='form.php') { echo ('class="active"');}?>> <a href="form.php"><i class="fa fa-lg fa-fw fa-cogs"></i>&nbsp;Fillup Form</a></li>


    </ul>
  </nav>
</aside>