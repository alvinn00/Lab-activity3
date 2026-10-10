<?php
include 'dbcon.php';


if (isset($_GET['id'])) {
	$id = $_GET['id'];

	if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
		$query = $conn->query("DELETE FROM users WHERE id = '$id'");

		if ($query) {
			echo "<script>
			alert('Deleted Successfully!');
			window.location.href='index.php';
			</script>";
		}else{
			echo "Error".$connect_error;
		}
	}
}else{
	echo "<script>
	if(confirm('Are you sure you want to delete this record?')){
		window.location.href='delete.php?id=$id&confirm=yes';
	}else{
		window.location.href='index.php';
	}
	</script>";
}
?> 