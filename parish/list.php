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
		$diocese = null;
		if(isset($_GET['diocese'])) {
			$diocese = $_GET['diocese'];
		}

		$parishes = getParishes($dbh, $diocese);
		$dioceses = getDioceses($dbh);
	?>

	<div class="container">
	<?php include('../common/nav.php'); ?>
		<form class="row">
			<h5>Filter</h5>
			<table class="table">
				<thead>
					<tr>
						<th>Diocese</th>
						<th>Submit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<select class="selectpicker" name="diocese">
								<option value=""></option>
							<?php foreach ($dioceses as $diocese): ?>
								<option value="<?php echo $diocese['Diocese']; ?>">
									<?php echo $diocese['Diocese']; ?>
								</option>
							<?php endforeach; ?>
							</select>
						</td>
						<td>
							<input class="btn btn-primary" type="submit" value="filter">
						</td>
					</tr>
				</tbody>
			</table>
		</form>

		<div class="row">
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
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
