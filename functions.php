<?php

$conn = mysqli_connect("localhost", "root", "", "ra1_db");

function query($sql) {
	global $conn;
	$result = mysqli_query($conn, $sql);

	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}



// tambah data mahasiswa
function tambah_mhs($data) {
	global $conn;

	$nama_lengkap = htmlspecialchars($data['nama_lengkap']);
	$nim = htmlspecialchars($data['nim']);
	$password = htmlspecialchars($data['password']);
	$blockquote = $data['blockquote'];
	$pj_matkul = htmlspecialchars($data['pj_matkul']);
	$github = htmlspecialchars($data['github']);
	$fb = htmlspecialchars($data['fb']);
	$level = htmlspecialchars($data['level']);
	$ig = htmlspecialchars($data['ig']);
	$tweet = htmlspecialchars($data['tweet']);

	$result = mysqli_query($conn, "SELECT * FROM admin");
	$admin = mysqli_fetch_assoc($result);


	if($_POST['nama_lengkap'] == $admin['nama_lengkap']) {

		echo '<script>
				alert("Nama ini sudah ditambahkan!");
				document.location.href = "add_mhs";
			  </script>';

			  return false;
	}

	$foto = upload_foto();

	if( !$foto) {
		return false;
	}

	$query1 = "INSERT INTO admin VALUES(
		NULL,
		'$nama_lengkap',
		'$nim',
		'$password',
		'$blockquote',
		'$foto',
		'$pj_matkul',
		'$github',
		'$fb',
		'$ig',
		'$tweet',
		'$level'
		) ";

		mysqli_query($conn, $query1);
		return mysqli_affected_rows($conn);
}








	// upload gambar/foto profile
	function upload_foto() {

		$nama_foto = $_FILES['photo']['name'];
		$ukuran_photo = $_FILES['photo']['size'];
		// $error_photo = $_FILES['photo']['error'];
		$tmp_name_photo = $_FILES['photo']['tmp_name'];

		// if( $error_foto == 4) {

		// 	echo '<script>
		// 			alert("pilih gambar terlebih dahulu!");
		// 		  </script>';

		// 	return false;
		// }


		$ekstensi_foto_valid = ['jpg', '', 'png', 'jpeg'];
		$ekstensi_foto = explode('.', $nama_foto);
		$ekstensi_foto = strtolower(end($ekstensi_foto));

		if( !in_array($ekstensi_foto, $ekstensi_foto_valid)) {
				echo '<script>
						alert("Yang Anda upload bukan file gambar yang valid!");
						document.location.href = "tambah_mhs"
					  </script>';
					  
			 	return false;
		}


		if( $ukuran_photo > 1000000) {

			echo '<script>
						alert("ukuran file terlalu besar!");
						document.location.href = "add_mhs"
					  </script>';

			return false;
		}


		$nama_foto_baru = uniqid();
		$nama_foto_baru .= '.';
		$nama_foto_baru .= $ekstensi_foto;  


		move_uploaded_file($tmp_name_photo, 'foto-profile/' . $nama_foto_baru);

		return $nama_foto_baru;




	}





		
// upload project
function upload_project($data) {
	global $conn;

	$author = htmlspecialchars($data['author']);
	$matakuliah = htmlspecialchars($data['matakuliah']);
	$waktu = htmlspecialchars($data['waktu']);
	$pertemuan = htmlspecialchars($data['pertemuan']);
	$semester = htmlspecialchars($data['semester']);
	$teknologi = htmlspecialchars($data['teknologi']);
	$subject = htmlspecialchars($data['subject']);
	$konten = $data['body'];

	$foto_project = upload_foto_project();

	if( !$foto_project) {
		return false;
	}

	$query_project = "INSERT INTO project VALUES(
		NULL,
		'$author', 
		'$matakuliah', 
		'$waktu',
		'$teknologi',
		'$semester',
		'$foto_project',
		'$subject',
		'$pertemuan',
		'$konten'
		) ";

		mysqli_query($conn, $query_project);
		return mysqli_affected_rows($conn);
}








	// upload gambar/foto profile
	function upload_foto_project() {

		$nama_foto_project = $_FILES['project']['name'];
		$ukuran_project_photo = $_FILES['project']['size'];
		$tmp_name_project_photo = $_FILES['project']['tmp_name'];


		$ekstensi_foto_projects_valid = ['jpg', '', 'png', 'jpeg'];
		$ekstensi_project_foto = explode('.', $nama_foto_project);
		$ekstensi_project_foto = strtolower(end($ekstensi_project_foto));

		if( !in_array($ekstensi_project_foto, $ekstensi_foto_projects_valid)) {
				echo '<script>
						alert("Yang Anda upload bukan file gambar yang valid!");
						document.location.href = "upload_project"
					  </script>';
					  
			 	return false;
		}


		if( $ukuran_project_photo > 1000000) {

			echo '<script>
						alert("Ukuran file terlalu besar!");
						document.location.href = "upload_project"
					  </script>';

			return false;
		}


		$nama_foto_project_baru = uniqid();
		$nama_foto_project_baru .= '.';
		$nama_foto_project_baru .= $ekstensi_project_foto;  


		move_uploaded_file($tmp_name_project_photo, 'img-projects/' . $nama_foto_project_baru);

		return $nama_foto_project_baru;




	}








	
//   upload artikel
function upload_artikel($data) {
	global $conn;

	$author = htmlspecialchars($data['nama_lengkap']);
	$judul = htmlspecialchars($data['judul']);
	$kategori = htmlspecialchars($data['kategori']);
	$waktu = htmlspecialchars($data['waktu']);
	$konten = $data['konten'];
	$kata = $data['kata'];

	$gambar = upload_gambar();

	if( !$gambar) {
		return false;
		
		
	}

	$query = "INSERT INTO artikel VALUES(
		NULL,
		'$author',
		'$judul',
		'$kategori',
		'$waktu',
		'$gambar',
		'$konten',
		'$kata'
		) ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}


	function upload_gambar() {
		$nama_file = $_FILES['gambar']['name'];
		$ukuran_file = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmp_name = $_FILES['gambar']['tmp_name'];

		if( $error == 4) {

			echo '<script>
					alert("pilih gambar terlebih dahulu!");
				  </script>';

			return false;
		}


		$ekstensi_gambar_valid = ['jpg', 'png', 'jpeg'];
		$ekstensi_gambar = explode('.', $nama_file);
		$ekstensi_gambar = strtolower(end($ekstensi_gambar));

		if( !in_array($ekstensi_gambar, $ekstensi_gambar_valid)) {
				echo '<script>
						alert("Yang Anda upload bukan file gambar yang valid!");
						document.location.href = "post_artikel"
					  </script>';

				return false;
		}


		if($ukuran_file > 1000000) {

				echo '<script>
						alert("ukuran file terlalu besar!");
						document.location.href = "post_artikel"
					  </script>';

				return false;
		}


		$nama_file_baru = uniqid();
		$nama_file_baru .= '.';
		$nama_file_baru .= $ekstensi_gambar;  


		move_uploaded_file($tmp_name, 'img-posts/' . $nama_file_baru);

		return $nama_file_baru;




		
	}






	

	function upload_galeri($data) {
		global $conn;
		$subject = $_POST['subject'];

		$galeri = upload_galeri_ra1();

		if(!$galeri) {
			return false;
		}

		$query_galeri = "INSERT INTO galeri VALUES(NULL, '$galeri', '$subject')";

		mysqli_query($conn, $query_galeri);
		return mysqli_affected_rows($conn);

	}


	// function upload galeri
	function upload_galeri_ra1() {

		$nama_galeri = $_FILES['galeri']['name'];
		$size_galeri = $_FILES['galeri']['size'];
		$tmp_galeri = $_FILES['galeri']['tmp_name'];

		$ekstensi_galeri_valid = ['jpg', 'png', 'jpeg'];
		$ekstensi_galeri = explode('.', $nama_galeri);
		$ekstensi_galeri = strtolower(end($ekstensi_galeri));

		if( !in_array($ekstensi_galeri, $ekstensi_galeri_valid)) {
			echo '<script>
					alert("Ekstensi file yang Anda masukkan tidak valid!");
					document.location.href = "upload_galeri"
				  </script>';
				  
			 return false;
	}

	
	if( $size_galeri > 1000000) {

		echo '<script>
					alert("Ukuran file terlalu besar!");
					document.location.href = "upload_galeri"
				  </script>';

		return false;
	}


	$nama_galeri_baru = uniqid();
		$nama_galeri_baru .= '.';
		$nama_galeri_baru .= $ekstensi_galeri;  

		move_uploaded_file($tmp_galeri, 'galeri/' . $nama_galeri_baru);

		return $nama_galeri_baru;




	}







// hapus data mahasiswa
function hapus_mhs($id) {
	global $conn;

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE id = $id");
		$pp = mysqli_fetch_assoc($result);

		if(file_exists("foto-profile/$pp[photo]")) {
			unlink("foto-profile/$pp[photo]");
		}

	mysqli_query($conn, "DELETE FROM admin WHERE id = $id ");
	return mysqli_affected_rows($conn);
}



function hapus_posts($id) {
	global $conn;

	$result = mysqli_query($conn, "SELECT * FROM artikel WHERE id = $id");
		$posts = mysqli_fetch_assoc($result);

		if(file_exists("img-posts/$posts[gambar]")) {
			unlink("img-posts/$posts[gambar]");
		}

	mysqli_query($conn, "DELETE FROM artikel WHERE id = $id ");
	return mysqli_affected_rows($conn);






function hapus_tugas($id) {
	global $conn;

	mysqli_query($conn, "DELETE FROM list_tugas WHERE id = $id ");
	return mysqli_affected_rows($conn);
}






// hapus data mahasiswa
function del_posts($id) {
	global $conn;

	mysqli_query($conn, "DELETE FROM artikel WHERE id = $id ");
	return mysqli_affected_rows($conn);
}



// ubah password/settings
// function ubah/edit
function settings($data) {
	global $conn;
	$id = $data["id"];
	$password = htmlspecialchars($data["password_baru"]);
  
	$query ="UPDATE admin SET 
	password = '$password'
	WHERE id = $id
	";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
  }







	function kontak($data) {
		global $conn; 

		$nama =  htmlspecialchars($_GET['nama']); 
		$hari =  htmlspecialchars($_GET['hari']); 
		$menit =  htmlspecialchars($_GET['menit']); 
		$email = htmlspecialchars($_GET['email']); 
		$subject = htmlspecialchars($_GET['subject']); 
		$message = htmlspecialchars($_GET['message']); 
	  
		$query_kontak = "INSERT INTO kontak VALUES(
		  NULL,
		  '$nama',
		  '$subject',
		  '$email',
		  '$message',
		  '$hari',
		  '$menit'
		)";

		mysqli_query($conn, $query_kontak);
		return mysqli_affected_rows($conn);
	}




	// tambah list tugas
	function tambah_tugas($data) {
		global $conn; 

		$mk = htmlspecialchars($_POST['mk']);
		$deadline = htmlspecialchars($_POST['deadline']);
		$ket =$_POST['ket'];

		$query_tugas = "INSERT INTO list_tugas VALUES(
			NULL,
			'$mk',
			'$deadline',
			'$ket'
		)";

		mysqli_query($conn, $query_tugas);
		return mysqli_affected_rows($conn);
	}



	// super admin edit mhs
	function super_admin_edit_mhs($data) {
		global $conn;
		$id = $data["id"];
		$nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
		$nim = htmlspecialchars($data["nim"]);
		$pj_matakuliah = htmlspecialchars($data["pj_matakuliah"]);
		$password = htmlspecialchars($data["password"]);
		$level = htmlspecialchars($data["level"]);
	  
		$query ="UPDATE admin SET 
		nama_lengkap = '$nama_lengkap',
		nim = '$nim',
		pj_mk = '$pj_matakuliah',
		password = '$password',
		level = '$level'
		WHERE id = $id
		";

		mysqli_query($conn,$query);
		return mysqli_affected_rows($conn);
	  }
	}



	// function hapus galeri
	function hapus_galeri($id) {
		global $conn;

		$result = mysqli_query($conn, "SELECT * FROM galeri WHERE id = $id");
		$data = mysqli_fetch_assoc($result);

		if(file_exists("galeri/$data[galeri]")) {
			unlink("galeri/$data[galeri]");
		}
		
		mysqli_query($conn, "DELETE FROM galeri WHERE id = $id ");
		return mysqli_affected_rows($conn);
	}



	// hapus data mahasiswa
function hapus_project($id) {
	global $conn;
	
	$result = mysqli_query($conn, "SELECT * FROM project WHERE id = $id");
		$pro = mysqli_fetch_assoc($result);

		if(file_exists("img-projects/$pro[foto_project]")) {
			unlink("img-projects/$pro[foto_project]");
		}

	mysqli_query($conn, "DELETE FROM project WHERE id = $id ");
	return mysqli_affected_rows($conn);
}



	function hapus_pesan($id) {
		global $conn;
	
		mysqli_query($conn, "DELETE FROM kontak WHERE id = $id ");
		return mysqli_affected_rows($conn);
	}






	
// ubah password/settings
// function ubah/edit
function update_profile($data) {
	global $conn;
	$id = $data["id"];
	$blockquote = $data["blockquote"];
	$facebook = htmlspecialchars($data['facebook']);
	$instagram = htmlspecialchars($data['instagram']);
	$twitter = htmlspecialchars($data['twitter']);
	$github = htmlspecialchars($data['github']);
	$foto_lama = htmlspecialchars($data['foto_lama']);

	if($_FILES['photo']['error'] === 4) {

		$foto = $foto_lama;

	} else if ($_FILES['photo']['size'] > 1000000){
		echo '<script>
		        alert("ukuran file terlalu besar!");
				document.location.href = "profile"
			  </script>';

	} else {

		$foto = upload_foto();
	}
  
	$query ="UPDATE admin SET 
	link_facebook = '$facebook',
	link_instagram = '$instagram',
	link_twitter = '$twitter',
	link_github = '$github',
	photo = '$foto',
	blockquote = '$blockquote'
	WHERE id = $id
	";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
  }