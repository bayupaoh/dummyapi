<?php
include "koneksi.php";
  $id_user = $_POST["id_user"];
  $saldo = $_POST["kode_voucher"];

  if($id_user !="" || $saldo !=""){

  	$query="select * from pengguna where no_ktp='$id_user'";
  	$hasil=mysql_query($query);

  	if($data = mysql_fetch_array($hasil)){
		$pulsa_user = $data["pulsa"];

		$query="select * from voucher_pulsa where kode_voucher='$saldo'";
  	$hasil=mysql_query($query);

  	if($data = mysql_fetch_array($hasil)){
  			$besar_pulsa = $data["besar_pulsa"];
  			$pulsa_total= $pulsa_user + $besar_pulsa;


  		  $query="update pengguna set pulsa=$pulsa_total where no_ktp='$id_user'";

        $hasil=mysql_query($query);

        if($hasil){
          $result=array('kode' => 200,'message'=>'voucher berhasil di isi','jumlah_voucher'=>$pulsa_total);
        }else{
          $result=array('kode' => 400,'message'=>'data gagal');          
        }
  	}else{
          $result=array('kode' => 400,'message'=>'data gagal');
    }
	}else{
  		$result=array('kode' => 400,'message'=>'data gagal');
  	}

  }else{
		$result=array('kode' => 400,'message'=>'ada field yang kosong');
  }

	echo json_encode($result);	

/*
  echo '{"kode":"200","message":"voucher berhasil di isi","jumlah_voucher": 5000}';
  */
?>
