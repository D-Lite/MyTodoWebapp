<?php
	$conn = mysqli_connect('localhost', 'root','', 'todo');

?>
<?php

	$error = "";


		//INSERT a new activity
	if (isset($_POST['submittodo'])) {
		if (empty($_POST['newtodo'])) {
				$error = "Please input a task!";
		}
		else{
			$task = $_POST['newtodo'];
			$stmt = "INSERT INTO todotable (todovalue) VALUES ('$task')";
			$query = mysqli_query($conn, $stmt);
			if ($query) {
			// 	echo "string";
			// exit();
			}
			header('location: to-do.php');

		}	
	}


			//SELECT task
	$alltasks = mysqli_query($conn, "SELECT * FROM todotable");

			//Delete
	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];

		mysqli_query($conn, "DELETE FROM todotable WHERE id=".$id);
		header('location: to-do.php');
	}


?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">
			<table>
				<tr>
					<th>Num</th>
					<th>Tasks</th>
			    	<th>Option</th>
				</tr>
				 <tr>
					<?php $i = 1; while ($row = mysqli_fetch_array($alltasks)) { ?>
				  	<td><?php echo $i; ?></td>
			    	<td><?php echo $row['todovalue']; ?> </td>
					<td><button type="submit" id="delete" name="delete" class="btn btn-dark"><a href="to-do.php?del_task=<?php echo $row['id'] ?>">Delete</a> </button></td>
			  </tr>
						<?php $i++; } ?>	

			</table>
		</div>
	
	<div class="col-sm-5">
		<form id="todoform" method="POST" action="to-do.php">
			<h3>New Item</h3>
			<span><?= $error; ?></span>
			<div id="textin">
			<input type="text" name="newtodo">
			</div>
			<button type="submit" id="submit" name="submittodo">To-Do</button>
		</form>
	</div>
</div>

<div class="col-lg-12 justify-content-lg-center">
	<?php
		include_once("footer.php");
	?>
</div>
</div>
</body>
</html>