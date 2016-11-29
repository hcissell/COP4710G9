<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Update A Parish</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<div class="container">
		<?php include('../common/nav.php'); ?>
		<?php if($_SERVER['REQUEST_METHOD'] !== 'GET'): ?>
			<?php
				$id = $_GET['id'];
				if(empty($id)) {
					die("Must provide an id to update!");
				}

				$parish = getParish($dbh, $id);
				if(empty($parish)) {
					die("Could not find parish");
				}

				$addressID = createUpdateAddress($dbh,
	 											 $parish['AddressID'], 
	 											 $_POST['addressline1'], 
	 											 $_POST['addressline2'], 
	 											 $_POST['city'],
	 											 $_POST['state'],
	 											 $_POST['zipcode']);
				
				$res = updateParish($dbh,
									$id,
									$addressID, 
									$_POST['diocese']);

			?>
		<?php endif ?>

		<?php 
			$id = $_GET['id'];
			if(empty($id)) {
				die("Must provide an id to update!");
			}

			$parish = getParish($dbh, $id);
			if(empty($parish)) {
				die("Could not find parish");
			}

			$address = getAddress($dbh, $parish['AddressID']);
			if(empty($address)) {
				die("Could not find address");
			}
		?>

		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">Parish Name:</div>
					<div class="span8">
						<input class="input-block-level" 
								type="text" disabled
								value="<?php echo $parish['ParishName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Diocese:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="diocese"
							   value="<?php echo $parish['Diocese'] ?>">
					</div>
				</div>
			</div>
			<div class="address-info">
				<div class="row">
					<div class="span4">Address Line 1:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="addressline1"
							   value="<?php echo $address['Line1'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Address Line 2:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="addressline2"
							   value="<?php echo $address['Line2'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">City:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="city"
							   value="<?php echo $address['City'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">State:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="state"
							   value="<?php echo $address['State'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Zip Code:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="zipcode"
							   value="<?php echo $address['ZipCode'] ?>">
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Update Parish">
		</form>
		<div class=row>
			<div class="span4">
				<a href="delete.php?id=<?php echo $id; ?>">
					<button type="button" class="btn btn-danger">
						Delete
					</button>
				</a>
			</div>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>