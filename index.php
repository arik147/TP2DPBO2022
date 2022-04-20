<?php

/* --------------- INCLUDE --------------- */
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Pengurus.class.php");
include("includes/Bidang.class.php");

// buka db
$objPengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$objBidang = new Bidang($db_host, $db_user, $db_pass, $db_name);

// open objek
$objPengurus->open();
$objBidang->open();

// get data
$objPengurus->getPengurus();
$objBidang->getBidangDivisi();

// Jika submit add pengurus
if (isset($_POST['addPengurus'])) {

	// panggil method add
    $objPengurus->addPengurus();

	// kembali ke home
    header("location:index.php");
}

// mengisi data bidang pada form add pengurus
$dataBidang = null;

// mengambil data bidang
while (list($id_bidang, $bidang, $id_divisi, $id_divisi, $divisi) = $objBidang->getResult()) {

    $dataBidang .= 
    "<option value=". $id_bidang .">". $bidang . " - " . $divisi."</option>";
}


/* --------------- Menampilkan Data Pengurus --------------- */
$data = null;

while (list($id_pengurus, $nim, $nama, $semester, $id_bidang, $foto, $id_bidang, $bidang, $id_divisi, $id_divisi, $divisi) = $objPengurus->getResult()) {
		
	$data .= 
	"<a href='detailPengurus.php?idPengurus=" . $id_pengurus . "' class='card shadow' style='text-decoration: none; color: black; max-width: 15rem;'>
		
		<img src='./images/" . $foto . "'  alt='./images/" . $foto . "' class='card-img-top'> 
		<div class='card-body'>
			<h4 class='mb-1 text-uppercase fs-6 text-start text-muted'>". $bidang . " " . $divisi . "</h4>
			<h2 class='fs-3 mt-2 mb-1 text-capitalize card-title text-center fw-bold'>". $nama . "</h2>
		</div>
		
	</a>";
}

// menutup objek
$objPengurus->close();
$objBidang->close();

// template
$tpl = new Template("templates/index.html");

// menreplace template
$tpl->replace("DATA_PENGURUS", $data);
$tpl->replace("DATA_BIDANG", $dataBidang);

// write
$tpl->write();
