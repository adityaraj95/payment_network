<?php
	include_once("init.php");
	$action = $_REQUEST['action'];	

	switch($action)
	{
		case "box_number":
			$valveType = $general_cls_call->select_query("type", VALVES, "WHERE id=:id", array(':id'=>$_POST['valve']), 1);

			$lastBox = $general_cls_call->select_query("number,box_no", FORMS, "WHERE valve_id=:valve_id AND user_id=:user_id AND status=:status ORDER BY id DESC LIMIT 0, 1", array(':valve_id'=>$_POST['valve'], ':user_id'=>$_SESSION['USER_ID'], ':status'=>1), 1);

			$typeSql = $general_cls_call->select_query("DISTINCT(type)", ANSWERS, "WHERE user_id=:user_id AND valve_id=:valve_id AND box_number=:box_number", array(':user_id'=>$_SESSION['USER_ID'], ':valve_id'=>$_POST['valve'], ':box_number'=>$lastBox->box_no), 2);		
			foreach($typeSql as $typeVal)
			{
				$wrongAnsSql1 = $general_cls_call->select_query_to_do_count(ANSWERS, "WHERE user_id=:user_id AND valve_id=:valve_id AND type=:type AND image_answer=:image_answer AND box_number=:box_number", array(':user_id'=>$_SESSION['USER_ID'], ':valve_id'=>$_POST['valve'], ':type'=>$typeVal->type, ':image_answer'=>2, ':box_number'=>$lastBox->box_no));	

				if($wrongAnsSql1 != '0')
				{
					$wrongAns =$wrongAns+$wrongAnsSql1;
				}			
			}
			if($wrongAns > 0)
			{
				$typeCount = $valveType->type + $wrongAns;
			}
			else
			{			
				$typeCount = $valveType->type;
			}

			if(($typeCount > $lastBox->number))
			{			
				if($lastBox->box_no != '')
				{
					echo $lastBox->box_no;
				}
				else
				{
					echo '1';
				}
			}
			else
			{
				echo $lastBox->box_no + 1;
			}
		break;
	}
?>