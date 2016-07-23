<?php
include "koneksi.php";
  $nama=$_POST["nama"];
  $no_ktp=$_POST["no_ktp"];
  $no_plat='';
  $email=$_POST["email"];
  $password=$_POST["password"];



  if($no_ktp != "" || $nama !="" || $email !="" || $password !=""){
  	$query="insert into pengguna values ('$no_ktp','$nama','$email','$password','','','http://www.cheap-accountants-in-london.co.uk/wp-content/uploads/2015/07/User-Avatar.png',0)";
  	$hasil=mysql_query($query);
  	if(mysql_affected_rows() > 0){
		$result=array('kode' => 200,'message'=>'register berhasil','id_user'=> $no_ktp,'nama'=>$nama,'saldo'=>0);
  	}else{
  		$result=array('kode' => 400,'message'=>'input data gagal');
  	}
  }else{
		$result=array('kode' => 400,'message'=>'ada field yang kosong');
  }

	echo json_encode($result);	
/*
  echo '{"kode":"200","message":"register berhasil","id_user":"1","nama":"Ahmad Sobirin","saldo":"50000"}';
  */
?>
