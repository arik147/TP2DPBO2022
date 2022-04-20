<?php

/* --------------- INCLUDE --------------- */
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Pengurus.class.php");
include("includes/Bidang.class.php");

// konek db
$objPengurus = new Pengurus($db_host, $db_user, $db_pass, $db_name);
$objBidang = new Bidang($db_host, $db_user, $db_pass, $db_name);

$objPengurus->open();
$objBidang->open();

// mendapatkan data
$objPengurus->getPengurus();
$objBidang->getBidangDivisi();

$data = null;
$dataUpdate = null;
$dataBidang = null;

// Jika terdapat idpengurus yang dipilih
if(isset($_GET["idPengurus"])){

	// memanggil methos pengurus berdasarkan id
	$objPengurus->getByIdPengurus($_GET["idPengurus"]);

	// mendapatkan data
	while (list($id_pengurus, $nim, $nama, $semester, $id_bidang, $foto, $id_bidang, $bidang, $id_divisi, $id_divisi, $divisi) = $objPengurus->getResult()) {

		/* --------------- Data Pengurus Detail --------------- */
		$data .=
		"<div class='card shadow' style='text-decoration: none; color: black; max-width: 17rem;'>
			
			<img src='./images/" . $foto . "'  alt='./images/" . $foto . "' class='card-img-top'> 
			<div class='card-body'>
				<h4 class='mb-1 text-uppercase fs-6 text-start text-muted'>". $bidang . " " . $divisi . "</h4>
				<h2 class='fs-3 mt-2 mb-1 text-capitalize card-title text-center fw-bold'>". $nama . "</h2>
				<h4 class='mb-1 text-uppercase fs-6 text-start'>". $nim . " </h4>
				<h4 class='mb-1 text-uppercase fs-6 text-start'>" . "Semester " . $semester . " </h4>
			</div>

			<div class='card-footer'>
				<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Update</button>
				<button class='btn btn-danger my-0 mx-0'>
				<a href='detailPengurus.php?idHapus=" . $id_pengurus . "' class='my-0 mx-0' style='color: white; text-decoration:none;'>Hapus</a>
				</button>
			</div>
			
		</div>";

		/* --------------- Formulir Update --------------- */
		$dataUpdate .= 
		"<form action='' method='POST' enctype='multipart/form-data' autocomplete='on'>
		<div class='mb-3'>
			<label class='form-label' for='tnim'>NIM</label>
			<input type='text' class='form-control' name='tnim' value='$nim' required />
		</div>

		<div class='mb-3'>
			<label class='form-label' for='tnama'>Nama</label>
			<input type='text' class='form-control' name='tnama' value='$nama' required />
		</div>

		<div class='mb-3'>
			<label class='form-label' for='tsemester'>Semester</label>
			<input type='number' class='form-control' name='tsemester' value='$semester' required />
		</div>

		<div class='mb-3'>
			<label class='form-label' for='tbidang'>Bidang</label>
			<select name='tbidang' class='form-control'>
			DATA_BIDANG
			</select>
		</div>

		<div class='mb-3'>
			<label class='form-label' for='tfoto'>Upload File</label>
			<input type='file' name='tfoto' accept='image/jpg, image/jpeg, image/png' class='form-control' required>
		</div>

		<button type='submit' name='updatePengurus' class='btn btn-primary'>Update</button>
	</form>
	</div>";
	}

}

// mengambil data option pada tabel bidang
while (list($id_bidang, $bidang, $id_divisi, $id_divisi, $divisi) = $objBidang->getResult()) {

    $dataBidang .= 
    "<option value=". $id_bidang .">". $bidang . " - " . $divisi."</option>";
}

// jika update
if (isset($_POST['updatePengurus'])){
	
	$objPengurus->updatePengurus($_GET["idPengurus"]);

	header("location:index.php");
}

// jika hapus
if (isset($_GET['idHapus'])){
	
	$objPengurus->deletePengurus($_GET["idHapus"]);

	header("location:index.php");
}

// close
$objPengurus->close();
$objBidang->close();

// template
$tpl = new Template("templates/detailPengurus.html");

// replace data
if(isset($_GET["idPengurus"])){
	$tpl->replace("DATA_DETAIL", $data);
	$tpl->replace("DATA_UPDATE", $dataUpdate);
	$tpl->replace("DATA_BIDANG", $dataBidang);
}

// write
$tpl->write();
