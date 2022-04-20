<?php

class Divisi extends DB {

    /* Mendapatkan Data */
    function getDivisi() {

        $query = "SELECT * FROM divisi";

        return $this->execute($query);
    }

    /* Mendapatkan data berdasarkan ID */
    function getByIdDivisi($id) {

        $query = "SELECT * FROM divisi
        WHERE id_divisi = '$id'";

        return $this->execute($query);
    }

    // menambah data Divisi
	function addDivisi() {
        
        // tampungan variabel dari form
		$divisi = $_POST['tnamadivisi'];

		// query insert to database
		$query = "INSERT INTO divisi VALUES ('', '$divisi')";

        // eksekusi query
        return $this->execute($query);
    }

    // menhapus data
    function deleteDivisi($id) {
        
        $query = "DELETE FROM divisi WHERE id_divisi = '$id'";
        
        // Mengeksekusi query
        return $this->execute($query);
    }
    
    // memperbaharui data
    function updateDivisi($id) {

        $nama_divisi = $_POST['tnamadivisi'];

        $query = "UPDATE divisi SET nama_divisi = '$nama_divisi' WHERE id_divisi = '$id'";
        
        return $this->execute($query);
    }
}

?>