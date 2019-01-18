<?PHP
	$page = basename($_SERVER["PHP_SELF"]);
?>
<aside id="left-panel">
  <div class="login-info"> <span>
    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut"> <img src="img/avatars/avatar.png" alt="me" class="online" /> <span> Administrator </span> </a> </span> </div>
  <nav>
    <ul>	
      <li <?php if($page=='my_account.php') { echo ('class="active"');}?>> <a href="my_account.php"><i class="fa fa-lg fa-fw fa-home"></i>&nbsp;Dashboard</a></li>

      <li <?php if($page=='valve.php') { echo ('class="active"');}?>> <a href="valve.php"><i class="fa fa-lg fa-fw fa-cogs"></i>&nbsp;Valve Type</a></li>
      <li <?php if($page=='email.php') { echo ('class="active"');}?>> <a href="email.php"><i class="fa fa-lg fa-fw fa-envelope"></i>&nbsp;E-mail Address</a></li>
      <li <?php if($page=='question.php') { echo ('class="active"');}?>> <a href="question.php"><i class="fa fa-lg fa-fw fa-question-circle"></i>&nbsp;Check Point</a></li>
      <li <?php if($page=='user.php') { echo ('class="active"');}?>> <a href="user.php"><i class="fa fa-lg fa-fw fa-user-plus"></i>&nbsp;User</a></li>
      <li <?php if($page=='sift.php') { echo ('class="active"');}?>> <a href="sift.php"><i class="fa fa-lg fa-fw fa-bell"></i>&nbsp;Shift</a></li>
      <li <?php if($page=='csv.php') { echo ('class="active"');}?>> <a href="csv.php"><i class="fa fa-lg fa-fw fa-file-excel-o"></i>&nbsp;Order Report</a></li>
      <li <?php if($page=='full_report.php') { echo ('class="active"');}?>> <a href="full_report.php"><i class="fa fa-lg fa-fw fa-file-excel-o"></i>&nbsp;Full Report</a></li>
      <li <?php if($page=='qu_report.php') { echo ('class="active"');}?>> <a href="qu_report.php"><i class="fa fa-lg fa-fw fa-file-excel-o"></i>&nbsp;Question Report</a></li>

    </ul>
  </nav>
</aside>