<?php

/* --------------- INclude --------------- */
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Bidang.class.php");
include("includes/Divisi.class.php");

/* --------------- KOnek Db dan Open --------------- */
$objBidang = new Bidang($db_host, $db_user, $db_pass, $db_name);
$objDivisi = new Divisi($db_host, $db_user, $db_pass, $db_name);

$objBidang->open();
$objDivisi->open();

/*  Mendapatkan data divisi */
$objDivisi->getDivisi();

$data = null;

/* -------- Get Id Bidang Divisi -------- */
if(isset($_GET["idUpdateBidang"])){
	
	$objBidang->getByIdBidangDivisi($_GET["idUpdateBidang"]);
	
	while (list($id_bidang, $bidang, $id_divisi) = $objBidang->getResult()) {
		
		$data .=
		"<input type='text' class='form-control' name='tjabatan' value='$bidang' required />";
		
	}
}

/* Menampilkan option Divisi Pada formulir */
$dataDivisi = null;

while (list($id_divisi, $nama_divisi) = $objDivisi->getResult()) {

    $dataDivisi .= 
    "<option value=". $id_divisi .">". $nama_divisi ."</option>";
}

/* -------- Update Bidang -------- */
if (isset($_POST['updateBidang'])) {
	
	$objBidang->updateBidangDivisi($_GET["idUpdateBidang"]);

	header("location:tabelDetail.php");
}

// close
$objBidang->close();
$objDivisi->close();


/* --------------- Replace Template --------------- */
$tpl = new Template("templates/updateBidangDivisi.html");

$tpl->replace("INPUT_BIDANG", $data);
$tpl->replace("SELECT_DIVISI", $dataDivisi);

$tpl->write();
