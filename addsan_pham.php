<?php
	$ten = $_POST["ten"];
	$thuoc_menu = $_POST["thuoc_menu"];

	$gia = $_POST["gia"];
	$noi_dung = $_POST["noi_dung"];
	
	$target_dir = "hinh_anh/san_pham/";
	$target_file = $target_dir . basename($_FILES["hinh_anh"]["name"]);
	$file_name = basename($_FILES["hinh_anh"]["name"]);
	move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file);
	
	require('ket_noi.php');
	
	if (empty($_POST['id'])) {
		// Add
		$sql = "INSERT INTO san_pham (ten, thuoc_menu, gia, noi_dung, hinh_anh) VALUES ('$ten', '$thuoc_menu', $gia, '$noi_dung', '$file_name')";
	} else {
		$id = $_POST['id'];
		// Update
		$sql = "UPDATE san_pham
				SET ten = '$ten', thuoc_menu = '$thuoc_menu', gia = $gia , noi_dung = '$noi_dung', hinh_anh = '$target_file'
				WHERE id = $id ";
	}
//UPDATE `san_pham` SET `thuoc_menu` = '14', `sap_xep_trang_chu` = '2' WHERE `san_pham`.`id` = 48;
	if ($conn->query($sql) === TRUE) {
		header('location: list.php');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>