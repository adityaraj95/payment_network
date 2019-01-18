<div class="page-footer">
  <div class="row">
    <div class="col-xs-12 col-sm-6" style="width:100%"><span class="txt-color-white"><?PHP echo SITE_TITLE; ?> &copy; <?PHP echo date('Y'); ?></span> </div>
  </div>
</div>

<?PHP
	$login = $general_cls_call->select_query("*", USERS, "WHERE id=:id", array(':id'=>$_SESSION['USER_ID']), 1);
	$sift = $general_cls_call->select_query("*", SIFT, "WHERE id=:id", array(':id'=>$login->sift), 1);
	
	//echo date('H:i').'=====<br>';
	$time = explode(' ',$sift->time);
	$hour = explode(':',$time[0]);
	
	if($time[1] == 'PM')
	{
		$totalHour = $hour[0] + 12;
		$checkTime = $totalHour.':'.$hour[1];
	}
	else
	{
		$checkTime = $time[0];
	}
	if(date('H:i') >= $checkTime)
	{
?>
	<script type="text/javascript">
	<!--
		window.location.href='logout.php';
	//-->
	</script>
<?PHP
	}
?>