<?php

/* Include */
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Divisi.class.php");

/* connect db and open */
$objDivisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$objDivisi->open();

$data = null;

/* -------- Get Id Divisi -------- */
if(isset($_GET["idUpdateDivisi"])){
	
	$objDivisi->getByIdDivisi($_GET["idUpdateDivisi"]);
	
	while (list($id_divisi, $nama_divisi) = $objDivisi->getResult()) {
		
		$data .=
		"<input type='text' class='form-control' name='tnamadivisi' value='$nama_divisi' required />";

	}
}

/* -------- Update Divisi -------- */
if (isset($_POST['updateDivisi'])){
	
	$objDivisi->updateDivisi($_GET["idUpdateDivisi"]);

	header("location:tabelDetail.php");
}

$objDivisi->close();


/* Replace Template */
$tpl = new Template("templates/updateDivisi.html");

$tpl->replace("INPUT_DIVISI", $data);

$tpl->write();
