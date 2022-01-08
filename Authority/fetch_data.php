<?php
require("SimpleXLSX.php");
require("../Connection.php");

$cm = new Connection;

if(isset($_REQUEST['cate']) && isset($_REQUEST['file']))
{
	$cate = $_REQUEST['cate'];
	$file = $_REQUEST['file'];
	
	if($xlsx = SimpleXLSX::parse(''.$file.'')){
		$arr = $xlsx->rows();
		$length = sizeof($arr);
		for($i = 1; $i < $length; $i++){
			$pid = $arr[$i][0];
			$mrp = $arr[$i][2];
			$rate = $arr[$i][3];
			$qunt = $arr[$i][4];
			
			$update = "update ".$cate." set quantity = '$qunt', product_mrp = '$mrp', product_rate ='$rate' where product_id = '$pid'";
			$cm->curd($update);
		}
		if(unlink($file))
			header("Location:../stock_mgmt.php?msg=1");
		else
			header("Location:../stock_mgmt.php?msg=2");
	} 
	else{
		echo SimpleXLSX::parseError();
	}
}
else
	header("Location:../stock_mgmt.php");
?>