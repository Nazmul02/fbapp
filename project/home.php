<?php
	require_once('auth.php');

	$db = mysqli_connect("localhost", "root", "", "megbd");
	$msg = "";

	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);


		$image = $_FILES['image']['name'];
		// $image_text = mysqli_real_escape_string($db, $_POST['image_text']);


		$sql = "INSERT INTO banner (img) VALUES ('$image')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
		}
	}
$result = mysqli_query($db, "SELECT * FROM notice");
	if (isset($_POST['fileupload'])) {
		$target = "documents/".basename($_FILES['file']['name']);


		$image = $_FILES['file']['name'];
		 $description = mysqli_real_escape_string($db, $_POST['description']);


		$sql = "INSERT INTO notice (notice,description) VALUES ('$image', '$description')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
			$msg = "File uploaded successfully";
		}else{
			$msg = "Failed to upload File";
		}
	}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	   <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



    <style type="text/css">
        .auto-style1 {
            text-align: center;
            font-size: large;
        }
    </style>
</head>
<body>
	<div class="container">
	<h1>Select image for banner and upload it</h1>
	<form method="POST" action="home.php" enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="image">
		</div>
		
		<div>
			<button type="submit" name="upload">Upload</button>
		</div>
	</form>


	<br><br><br>

	<form method="POST" action="home.php" enctype="multipart/form-data">
		<input type="hidden" name="size" value="1000000">
		<div>
			<input type="file" name="file">
		</div>
		<div>
			<textarea id="text" cols="40" rows="4" name="description" placeholder="Say something about this PDF..."></textarea>
		</div>
		<div>
			<button type="submit" name="fileupload">Upload</button>
		</div>
	</form>

		<?php

	while ($row = mysqli_fetch_array($result)) {
		echo "<div id='img_div'>";
			// echo "<img src='images/".$row['image']."' >";
			echo "<a href=documents/$row[notice]>" .$row['description']. "</a>";
			echo "<p>".$row['description']."</p>";
		echo "</div>";
	}
?>


</div>
</body>
</html>