<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Parish List</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<?php
		if(isset($_GET['city'])) {
			$params['City'] = $_GET['city'];
		}

		$parishes = getParishesfromaddr($dbh,$params);
	?>

	<div class="container">
	<?php include('../common/nav.php'); ?>
		
		<form>
  			Location:<br>
  			<input type="text" name="city"><br>
			<input type="submit" value="Submit">
  		</form>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Parish Name</th>
					<th>Diocese Name</th>
					<th>Address</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($parishes as $parish): ?>
				<?php 
					$address = getAddress($dbh, $parish['AddressID']);
					$address = $address['Line1'] . " " .
							   $address['Line2'] . " " .
							   $address['City']  . " " .
							   $address['State'] . ", " .
							   $address['ZipCode'];
				?>

				<tr>
					<td><?php echo $parish['ParishName'] ?></td>
					<td><?php echo $parish['Diocese'] ?></td>
					<td><?php echo $address ?></td>
					<td>
						<a href="update.php?id=<?php echo $parish['ParishName']; ?>" target="new">
							<button type="button" class="btn btn-success">Edit</button>
						</a>
					</td>
					<td>
						<a href="delete.php?id=<?php echo $parish['ParishName']; ?>" target="new">
							<button type="button" class="btn btn-danger">Delete</button>
						</a>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
