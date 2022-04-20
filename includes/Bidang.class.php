<?php

class Bidang extends DB {

    /* Method Get Bidang Divisi */
    function getBidangDivisi() {

        $query = "SELECT * FROM bidang_divisi 
        JOIN divisi ON 
        bidang_divisi.id_divisi = divisi.id_divisi ORDER BY divisi.nama_divisi, bidang_divisi.jabatan";

        return $this->execute($query);
    }

    /* Get berdasarkan Id */
    function getByIdBidangDivisi($id) {

        $query = "SELECT * FROM bidang_divisi 
        WHERE id_bidang = '$id'";

        return $this->execute($query);
    }

    /* Menambahkan Data */
	function addBidangDivisi() {

		// tampungan variabel dari form
		$jabatan = $_POST['tjabatan'];
		$divisi = $_POST['tdivisi'];

		// query insert to database
		$query = "INSERT INTO bidang_divisi (jabatan, id_divisi)
					VALUES ('$jabatan', '$divisi')";

		// eksekusi query
		return $this->execute($query);
	}

    /* Menghaopus data */
    function deleteBidangDivisi($id) {

        $query = "DELETE FROM bidang_divisi WHERE id_bidang = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    /* Memperbaharui Data */
    function updateBidangDivisi($id) {

        $jabatan = $_POST['tjabatan'];
        $divisi = $_POST['tdivisi'];

        $query = "UPDATE bidang_divisi SET jabatan = '$jabatan', id_divisi = '$divisi' WHERE id_bidang = '$id'";
        
        return $this->execute($query);
    }
}


?>