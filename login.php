<?php
include "koneksi.php";
  $email=$_POST["email"];
  $password=$_POST["password"];

if($email !="" || $password !=""){
  	$query="select * from pengguna where email='$email' and password='$password'";
  	$hasil=mysql_query($query);

  	if($data = mysql_fetch_array($hasil)){
		$result=array('kode' => 200,'message'=>'register berhasil','id_user'=> $data['no_ktp'],'nama'=>$data['nama_user'],'saldo'=>$data['pulsa'],'url_foto'=>$data['url_foto']);
  	}else{
  		$result=array('kode' => 400,'message'=>'data gagal');
  	}

  }else{
		$result=array('kode' => 400,'message'=>'ada field yang kosong');
  }

	echo json_encode($result);	
/*
  echo '{"kode":200,"message":"Login berhasil","id_user":"1","nama":"Ahmad Sobirin","saldo":"50000"}';
  */
?>
