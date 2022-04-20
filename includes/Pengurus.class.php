<?php

class Pengurus extends DB {

    /* Mendapatkan data */
    function getPengurus() {

        $query = "SELECT * FROM pengurus 
        JOIN bidang_divisi ON
        pengurus.id_bidang = bidang_divisi.id_bidang 
        JOIN divisi ON
        bidang_divisi.id_divisi = divisi.id_divisi";

        return $this->execute($query);
    }

    /* Mendapatkan data berdasarkan id */
    function getByIdPengurus($id) {

        $query = "SELECT * FROM pengurus 
        JOIN bidang_divisi ON
        pengurus.id_bidang = bidang_divisi.id_bidang 
        JOIN divisi ON
        bidang_divisi.id_divisi = divisi.id_divisi
        WHERE id_pengurus = '$id'";

        return $this->execute($query);
    }

    /* menambahkan data */
    function addPengurus() {

        $nim = $_POST['tnim'];
        $nama = $_POST['tnama'];
        $semester = $_POST['tsemester'];
        $id_bidang = $_POST['tbidang'];

        $foto = $_FILES["tfoto"]['name'];
        $Tmpname = $_FILES["tfoto"]['tmp_name'];
        $filefoto = "images/". $foto;

	    if(move_uploaded_file($Tmpname, $filefoto)){
            $foto = $_FILES["tfoto"]['name'];
        }
        else{
            $foto = 'anonim.png';
        }

		// Image db insert sql
        $query = "INSERT INTO pengurus (nim, nama, semester, id_bidang, foto)
                 VALUES ('$nim', '$nama', '$semester', '$id_bidang', '$foto')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    /* memperbaharui data */
    function updatePengurus($id) {
        
        $nim = $_POST['tnim'];
        $nama = $_POST['tnama'];
        $semester = $_POST['tsemester'];
        $id_bidang = $_POST['tbidang'];

        $foto = $_FILES["tfoto"]['name'];
        $Tmpname = $_FILES["tfoto"]['tmp_name'];
        $filefoto = "images/". $foto;

	    if(move_uploaded_file($Tmpname, $filefoto)){
            $foto = $_FILES["tfoto"]['name'];
        }
        else{
            $foto = 'anonim.png';
        }

        $query = "UPDATE pengurus 
                SET nim = '$nim', nama = '$nama', semester = '$semester', id_bidang = '$id_bidang' , foto = '$foto' 
                WHERE id_pengurus = '$id'";
        
        return $this->execute($query);
    }
    
    /* menghapus data */
    function deletePengurus($id) {

        $query = "DELETE FROM pengurus WHERE id_pengurus = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
