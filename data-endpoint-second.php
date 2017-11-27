<?php
include('db-details.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

$val = $_POST["Value"];
$id = $_POST["Id"];

$r = mysqli_query($conn, "select * from users where id = ".$id);
$t = mysqli_fetch_all($r, MYSQLI_NUM);
if($r){
	$ctr = $t[0][2]+1;
	$d = $t[0][1].",".$val;
	$p = mysqli_query($conn, "update users set ctr = ".$ctr.", response = '".$d."' where id = ".$id);

	if($ctr<mysqli_num_rows(mysqli_query($conn, "select * from questions"))){
		$z = mysqli_fetch_all(mysqli_query($conn, "select * from questions order by id limit 1 offset ".$ctr), MYSQLI_NUM);
		$c = $z[0][1];
		$arr = array('q'=>$c, 'id'=>$id, 'current'=>$ctr+1 ,'total'=>mysqli_num_rows(mysqli_query($conn, "select * from questions")));
		echo json_encode($arr);	
	}
	else{
		echo json_encode(array('q'=>"Finished", 'id'=>1000));
	}
	
}

?>