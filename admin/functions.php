<?php 
//koneksi ke database
#$conn = mysqli_connect("localhost", "taipei", "taipei@2022@", "storyone");
$conn = mysqli_connect("localhost", "taipei", "taipei@2022@", "dst_db");

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



// Jawaban dari pilihan tema di submit ke database theme_desc
function  theme_desc($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$user = $_SESSION["userId"];
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO theme_desc
				VALUES
			('', '$nama', '".$_SESSION["userId"]."')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




// Jawaban dari pilihan tema di submit ke database theme_ans
function  theme_ans($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$user = $_SESSION["userId"];
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO theme_ans
				VALUES
			('', '$nama', '".$_SESSION["userId"]."')
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

function hapusdesign($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM design WHERE id=$id");

	return mysqli_affected_rows($conn);
}





function hapusthemeall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM theme");

	return mysqli_affected_rows($conn);
}





function hapusreasonall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM theme_reason");

	return mysqli_affected_rows($conn);
}




function hapusreasonall2() {
	global $conn;
	mysqli_query($conn, "DELETE FROM theme_reason2");

	return mysqli_affected_rows($conn);
}





function hapuspurposeall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM purpose_desc");

	return mysqli_affected_rows($conn);
}




function hapusoutlineall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM outline_desc");

	return mysqli_affected_rows($conn);
}




function hapustoolsall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM tools_desc");

	return mysqli_affected_rows($conn);
}




function hapusdesignall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM design");

	return mysqli_affected_rows($conn);
}




function hapusreflection1all() {
	global $conn;
	mysqli_query($conn, "DELETE FROM reflect");

	return mysqli_affected_rows($conn);
}




function hapusreflection2all() {
	global $conn;
	mysqli_query($conn, "DELETE FROM reflect2");

	return mysqli_affected_rows($conn);
}



function hapuspresentationall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM filestory");

	return mysqli_affected_rows($conn);
}





function hapuspeerreflectionall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM peer_reflection");

	return mysqli_affected_rows($conn);
}




function hapuspeerreflectionall2() {
	global $conn;
	mysqli_query($conn, "DELETE FROM peer_reflection2");

	return mysqli_affected_rows($conn);
}




function hapuspeerreflectionall3() {
	global $conn;
	mysqli_query($conn, "DELETE FROM peer_reflection3");

	return mysqli_affected_rows($conn);
}




function hapusdiscussionall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM group_diss");

	return mysqli_affected_rows($conn);
}




function hapususerall() {
	global $conn;
	mysqli_query($conn, "DELETE FROM user");

	return mysqli_affected_rows($conn);
}




// Menghubungkan dengan phase_2_3.php
function ubahdesign($data) {
	global $conn;

	$id = $data["id"];
	$keterangan = addslashes($data["keterangan"]);
	$user = htmlspecialchars($data["user"]);
	$page_order = htmlspecialchars($data["page_order"]);

	// query insert data
	$query = "UPDATE design SET 
				keterangan = '$keterangan',
				user = '$user',
				page_order = '$page_order'
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
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if ( mysqli_fetch_assoc($result
	) ) {
		echo "<script>
				alert('Sorry, your username is exist. Please try another one!')
			</script>";
		return false;
		// supaya insertnya gagal dan sintaks di bawah tidak dijalankan
	}

	// cek konfirmasi password
	if ( $password !== $password2 ) {
		echo "<script>
				alert('Sorry, your password do not match!');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan username ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);


}





function registrasiadmin($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");

	if ( mysqli_fetch_assoc($result
	) ) {
		echo "<script>
				alert('Sorry, your username is exist. Please try another one!')
			</script>";
		return false;
		// supaya insertnya gagal dan sintaks di bawah tidak dijalankan
	}

	// cek konfirmasi password
	if ( $password !== $password2 ) {
		echo "<script>
				alert('Sorry, your password do not match!');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan username ke database
	mysqli_query($conn, "INSERT INTO admin VALUES('', '$username', '$password')");

	return mysqli_affected_rows($conn);


}





function  tambahdesign($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$keterangan = addslashes($data["keterangan"]);
	$user = $_SESSION["userId"];
	$page_order = htmlspecialchars($data["page_order"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO design
				VALUES
			('', '$keterangan', '".$_SESSION["userId"]."', '$page_order')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  tambahpurpose($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO purpose_desc
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}






function  tambahoutline($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO outline_desc(nama,user, pilih)
				VALUES
			('$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




function  tambahtools($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO tools_desc
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  tambahreflection($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$username = htmlspecialchars($data["username"]);
	$pilih = htmlspecialchars($data["pilih"]);
	$pilih_user = htmlspecialchars($data["pilih_user"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO peer_reflection
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$username','$pilih', '$pilih_user')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  tambahteachercomments($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$username = htmlspecialchars($data["username"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO teacher_comments
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$username')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  tambahreflect($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO reflect
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  tambahreflect2($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO reflect2
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  tambahpresentation($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO presentation
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  tambahgroup($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO group_diss
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




function  tambahinfo($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$informasi = addslashes($data["informasi"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO info_admin
				VALUES
			('', '$informasi')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}






function  tools_desc($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$user = $_SESSION["userId"];
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO tools_desc
				VALUES
			('', '$nama', '".$_SESSION["userId"]."')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  reflone($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$user = $_SESSION["userId"];
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO reflone
				VALUES
			('', '$nama', '".$_SESSION["userId"]."')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




function  refltwo($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$user = $_SESSION["userId"];
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO refltwo
				VALUES
			('', '$nama', '".$_SESSION["userId"]."')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}





function  presentation($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$user = $_SESSION["userId"];
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO presentation
				VALUES
			('', '$nama', '".$_SESSION["userId"]."')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




function  tambahtheme($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO theme
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




function  tambahreason($data) {
	// ambil data dari tiap elemen dalam form
	global $conn;

	$nama = addslashes($data["nama"]);
	$user = $_SESSION["userId"];
	$pilih = htmlspecialchars($data["pilih"]);
	//$nama = htmlspecialchars($data["nama"]);
	//$email = htmlspecialchars($data["email"]);
	//$jurusan = htmlspecialchars($data["jurusan"]);

	// query insert data
	$query = "INSERT INTO theme_reason
				VALUES
			('', '$nama', '".$_SESSION["userId"]."', '$pilih')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}




function hapustheme($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM theme WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapusreason($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM theme_reason WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapuspurpose($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM purpose_desc WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapusoutline($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM outline_desc WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapustools($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM tools_desc WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapuspeer($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM peer_reflection WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapusreflect($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM reflect WHERE id=$id");

	return mysqli_affected_rows($conn);
}





function hapusreflect2($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM reflect2 WHERE id=$id");

	return mysqli_affected_rows($conn);
}





function hapuspresentation($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM presentation WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapusgroup($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM group_diss WHERE id=$id");

	return mysqli_affected_rows($conn);
}





function hapususer($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM user WHERE id=$id");

	return mysqli_affected_rows($conn);
}




function hapusinfo($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM info_admin WHERE id=$id");

	return mysqli_affected_rows($conn);
}





// Menghubungkan dengan phase_2_3.php
function ubahtheme($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE theme SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}





// Menghubungkan dengan phase_2_3.php
function ubahreason($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE theme_reason SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}





// Menghubungkan dengan phase_2_3.php
function ubahpurpose($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE purpose_desc SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}




// Menghubungkan dengan phase_2_3.php
function ubahoutline($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE outline_desc SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}




// Menghubungkan dengan phase_2_3.php
function ubahtools($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE tools_desc SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}




// Menghubungkan dengan phase_2_3.php
function ubahpeer($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$username = htmlspecialchars($data["username"]);
	$pilih = htmlspecialchars($data["pilih"]);
	$pilih_user = htmlspecialchars($data["pilih_user"]);

	// query insert data
	$query = "UPDATE peer_reflection SET 
				nama = '$nama',
				user = '$user',
				username = '$username',
				pilih = '$pilih',
				pilih_user = '$pilih_user'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}




// Menghubungkan dengan phase_2_3.php
function ubahreflect($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE reflect SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}





// Menghubungkan dengan phase_2_3.php
function ubahreflect2($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE reflect2 SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}





// Menghubungkan dengan phase_2_3.php
function ubahpresentation($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE presentation SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}




// Menghubungkan dengan phase_2_3.php
function ubahuser($data) {
	global $conn;

	$id = $data["id"];
	$username = addslashes($data["username"]);
	$password = addslashes($data["password"]);
	$password2 = addslashes($data["password2"]);

	if ( $password !== $password2 ) {
		echo "<script>
				alert('Sorry, your password do not match!');
			</script>";
		return false;
	}
	
	$password = password_hash($password, PASSWORD_DEFAULT);

	// query insert data
	$query = "UPDATE user SET 
				username = '$username',
				password = '$password'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}





// Menghubungkan dengan phase_2_3.php
function ubahgroup($data) {
	global $conn;

	$id = $data["id"];
	$nama = addslashes($data["nama"]);
	$user = htmlspecialchars($data["user"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE group_diss SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}




// Menghubungkan dengan phase_2_3.php
function ubahinfo($data) {
	global $conn;

	$id = $data["id"];
	$informasi = addslashes($data["informasi"]);

	// query insert data
	$query = "UPDATE info_admin SET 
				informasi = '$informasi'
			WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}







// Menghubungkan dengan phase_1_2_chotheme.php
function pilihtheme($data) {
	global $conn;

	$id = $data["id"];
	$user = htmlspecialchars($data["user"]);
	$nama = htmlspecialchars($data["nama"]);
	$pilih = htmlspecialchars($data["pilih"]);

	// query insert data
	$query = "UPDATE theme SET 
				nama = '$nama',
				user = '$user',
				pilih = '$pilih'
			WHERE  id = '$id' 
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}



?>
