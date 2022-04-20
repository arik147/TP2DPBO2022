<?php

/* --------------- Include --------------- */
include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Bidang.class.php");
include("includes/Divisi.class.php");

/* konek db */
$objBidang = new Bidang($db_host, $db_user, $db_pass, $db_name);
$objDivisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$objSelectDivisi = new Divisi($db_host, $db_user, $db_pass, $db_name);

/* open objek */
$objBidang->open();
$objDivisi->open();
$objSelectDivisi->open();

/* mendapatkan data dari db */
$objBidang->getBidangDivisi();
$objDivisi->getDivisi();
$objSelectDivisi->getDivisi();

/* jika menambahkan data divisi */
if (isset($_POST['addDivisi'])) {

	// pangil
    $objDivisi->addDivisi();

	// kembali ke menu detail tabel
    header("location:tabelDetail.php");
}

/* jika menambahkan data bidang */
if (isset($_POST['addBidang'])) {

	// panggil method
    $objBidang->addBidangDivisi();

    header("location:tabelDetail.php");
}


/* --------------- Menampilkan Data Divisi --------------- */
$data = null;
$no = 1;

while (list($id_divisi, $nama_divisi) = $objDivisi->getResult()) {
		
	$data .=
	"<tr>
		<th>" . $no . "</th>
		<td>" . $nama_divisi . "</td>
		<td>
			<button class='btn btn-primary'>
				<a href='updateDivisi.php?idUpdateDivisi=" . $id_divisi . "' style='color: white; font-weight: bold; text-decoration:none;'>
					Update
				</a>
			</button>
			<button class='btn btn-danger'>
				<a href='tabelDetail.php?idHapusDivisi=" . $id_divisi . "' style='color: white; font-weight: bold; text-decoration:none;'>
					Hapus
				</a>
			</button>
		</td>
	</tr>";

	$no++;
}

// jika menghapus data divisi
if (isset($_GET['idHapusDivisi'])) {
	
	$objDivisi->deleteDivisi($_GET["idHapusDivisi"]);

	header("location:tabelDetail.php");
}


/* --------------- Menampilkan Data Bidang --------------- */
$dataBidang = null;
$no = 1;

while (list($id_bidang, $bidang, $id_divisi, $id_divisi, $divisi) = $objBidang->getResult()) {

    $dataBidang .=
    "<tr>
		<th>" . $no . "</th>
		<td>" . $bidang . "</td>
		<td>" . $divisi . "</td>
		<td>
			<button class='btn btn-primary'>
				<a href='updateBidangDivisi.php?idUpdateBidang=" . $id_bidang . "' style='color: white; font-weight: bold; text-decoration:none;'>
					Update
				</a>
			</button>
			<button class='btn btn-danger'>
				<a href='tabelDetail.php?idHapusBidang=" . $id_bidang . "' style='color: white; font-weight: bold; text-decoration:none;'>
					Hapus
				</a>
			</button>
		</td>
	</tr>";

	$no++;
}

// jika menghapus data bidang
if (isset($_GET['idHapusBidang'])) {
	
	$objBidang->deleteBidangDivisi($_GET["idHapusBidang"]);

	header("location:tabelDetail.php");
}


/* Menampilkan Data Divisi --------------- */
/* Pada Formulir Add Bidang Divisi --------------- */
$dataDivisi = null;

//mengambil data option pada tabel divisi
while (list($id_divisi, $nama_divisi) = $objSelectDivisi->getResult()) {

    $dataDivisi .= 
    "<option value=". $id_divisi .">". $nama_divisi ."</option>";
}

/* Close */
$objBidang->close();
$objDivisi->close();
$objSelectDivisi->close();


/* --------------- Replace Template --------------- */
$tpl = new Template("templates/tabelDetail.html");

$tpl->replace("DATA_DIVISI", $data);
$tpl->replace("DATA_BIDANG", $dataBidang);
$tpl->replace("SELECT_DIVISI", $dataDivisi);

$tpl->write();
