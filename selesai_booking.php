<?php
  include "koneksi.php";
  $id_user = $_POST["id_user"];
  $kode_unik = $_POST["kode_unik"];

  if($id_user!="" || $kode_unik!=""){
  	$query="select * from transaksi where kode_voucher='$kode_unik' and no_ktp='$id_user' and status='belum'";
  	$hasil=mysql_query($query);
  	if($data=mysql_fetch_array($hasil)){
  		$totalbiaya=$data["total_biaya"];

	$query="update transaksi set status='bayar' where kode_voucher='$kode_unik' and no_ktp='$id_user' and status='belum'";

  	$hasil=mysql_query($query);
  	if($hasil){
	  	$query="update voucher_parkir set status='kosong' where kode_voucher='$kode_unik'";

	  	$hasil=mysql_query($query);
	  	if($hasil){
	  		
	  		$query="SELECT * FROM pengguna where no_ktp='$id_user'";

		  	$hasil=mysql_query($query);
		  	if($data=mysql_fetch_array($hasil)){
		  		
		  		$sisapulsa = $data["pulsa"]-$totalbiaya;
		  		
		  		$query="update user set pulsa=$sisapulsa where no_ktp='$id_user'";

		  		$hasil=mysql_query($query);
		  		if($hasil){
		  		   $result=array('kode' => 200,'message'=>'pembayaran berhasil','biaya_parkir'=>$totalbiaya);  		
		  		}else{
		  		 	$result=array('kode' => 400,'message'=>'input data gagal 2'); 	
		  		}
		  		
			  	//$result=array('kode' => 200,'message'=>'pembayaran berhasil','biaya_parkir'=>$totalbiaya);  	
		  	}else{
			  	$result=array('kode' => 400,'message'=>'input data gagal 1'); 
		  	}
	  	}else{
		  	$result=array('kode' => 400,'message'=>'input data gagal 1'); 
	  	}
  	}else{
		$result=array('kode' => 400,'message'=>'input data gagal 2');  	
  	}

  	}
  }else{
	$result=array('kode' => 400,'message'=>'ada field yang kosong');
  }

  echo json_encode($result);
/*
  echo '{"kode":"200","message":"berhhasil","biaya_parkir":5000}';
*/
?>
