<?php
include('db-details.php');
$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);

$name = $_POST["name"];
$email = $_POST["email"];
$age = $_POST["age"];
$sex = $_POST["sex"];
$qual = $_POST["qualification"];
$inst = $_POST["institute"];
$occ = $_POST["occupation"];

$val = $name.",".$email.",".$age.",".$sex.",".$qual.",".$inst.",".$occ;

$r = mysqli_query($conn, "insert into users (response) values('".$val."')");
//echo $r;
if($r){
	$w = mysqli_fetch_all(mysqli_query($conn, "select * from users order by id desc limit 1"), MYSQLI_NUM);
	$e = $w[0][0];
	$z = mysqli_fetch_all(mysqli_query($conn, "select * from questions order by id limit 1 "), MYSQLI_NUM);
	$c = $z[0][1];
	$arr = array('q'=>$c, 'id'=>$e, 'current'=>1 ,'total'=>mysqli_num_rows(mysqli_query($conn, "select * from questions")));
	echo json_encode($arr);
}
//echo "insert into users (response) values('".$val."')";

?>