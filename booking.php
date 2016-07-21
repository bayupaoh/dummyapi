<?php
  include "koneksi.php";
  $id_user = $_POST["id_user"];
  $id_tempat=$_POST["id_tempat"];
  $waktu_awal=date("Y/m/d")." ".$_POST["waktu_booking"];
  $merk=$_POST["merk"];
  $tipe=$_POST["tipe"];

  if($id_user != "" || $durasi !="" || $waktu_awal!="" || $waktu_akhir!=""){
  	
  	$query="select * from voucher_parkir where status='kosong'";
  	$hasil=mysql_query($query);

  	if($data=mysql_fetch_array($hasil)){
  		$kode = $data["kode_voucher"];
  		
 		$query="insert into transaksi values(null,'$id_user','$kode','$waktu_awal','',0,0,'belum','$merk','$tipe')";

  		$hasil=mysql_query($query);
  		if($hasil){
  
  		 		$query="update voucher_parkir set status='pakai' where kode_voucher='$kode'";
 				
 				$hasil=mysql_query($query);

 				if($hasil){ 		
		  		$result=array('kode' => 200,'message'=>'Booking berhasil','kode_unik'=>$kode);
		  		
		  		}else{
		  		$result=array('kode' => 400,'message'=>'input data gagal 3');  			
		  		}
		  		
  		}else{
  		$result=array('kode' => 400,'message'=>'input data gagal 2');
  		}
  	}else{
  		$result=array('kode' => 400,'message'=>'input data gagal 1');
  	}
  }else{
	$result=array('kode' => 400,'message'=>'ada field yang kosong');
  }

  echo json_encode($result);	
/*
  echo '{"kode":"200","message":"booking berhasil","kode_unik":"AB4RFT"}';
*/
?>
