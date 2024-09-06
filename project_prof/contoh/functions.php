<?php 
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// function ini menerima query dari halaman lain
function query($query) {
	global $conn;
	// $result adalah lemarinya
	$result = mysqli_query($conn, $query);
	// siapkan wadah untuk meletakkan bajunya
	$rows = [];
	// ambil data dengan looping
	while ( $row = mysqli_fetch_assoc($result)) {
		$rows[] = $row; // ambil baju simpan ke kotak
	} // kembalikan kotaknya
	return $rows;
}



function  tambah($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);


	// upload gambar
	$gambar = upload();
	if( !$gambar ) {
		return false;
	}


	// query insert data
	$query = "INSERT INTO mahasiswa
				VALUES
			('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    $user = $_SESSION["userId"];

    // cek apakah tidak ada gambar yang di upload
    if ( $error === 4 ) {
        echo "<script>
                alert('please choose your file!');
        </script>";
        return false;
    }

    // cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf', 'ppt', 'pptx'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('Please upload only word, ppt or pdf file!');
        </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ( $ukuranFile > 5000000 ) {
        echo "<script>
                alert('Please upload file less than 5 MB!');
        </script>";
        return false;
    }

    # Location
    $location = __DIR__."/filestory_upload/".$user;

    # create directory if not
    if(!is_dir($location)){
        if (!mkdir($location, 0755, true)) {
            $error = error_get_last();
            die('Failed to create directory: ' . $error['message']);
        }
    }

    // Modify the file name
    $namaFileBaru = pathinfo($namaFile, PATHINFO_FILENAME); // Get file name without extension
    $namaFileBaru = str_replace(' ', '_', $namaFileBaru); // Replace spaces with underscores
    $namaFileBaru .= '.' . $ekstensiGambar; // Append the extension

    $location .= "/".$namaFileBaru;

    # Upload file
    if (!move_uploaded_file($tmpName, $location)) { // Copy the file, returns false if failed
        die("Can't move file to ". $location);
    }
    unlink($tmpName); // Delete the temp file

    echo "File uploaded successfully :)";
    return $namaFileBaru;
}





function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function ubah($data) {
	global $conn;

	$id = $data["id"];
	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user pilih gambar baru atau tidak 
	if ( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	// query insert data
	$query = "UPDATE mahasiswa SET 
				nrp = '$nrp',
				nama = '$nama',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}



function cari($keyword) {
	$query = "SELECT * FROM mahasiswa
				WHERE
			nama LIKE '%$keyword%' OR
			nrp LIKE '%$keyword%' OR
			email LIKE '%$keyword%' OR
			jurusan LIKE '%$keyword%' 
		";
	return query($query);
}




function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

	if ( mysqli_fetch_assoc($result
	) ) {
		echo "<script>
				alert('username yang dipilih sudah terdaftar!')
			</script>";
		return false;
		// supaya insertnya gagal dan sintaks di bawah tidak dijalankan
	}

	// cek konfirmasi password
	if ( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan username ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);


}






?>