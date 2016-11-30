<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create A Cursillo Weekend</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<div class="container">
	<?php include('../common/nav.php'); ?>
		<?php if($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
			<?php 
				$startDate = validateDate($_POST['start']) ? $_POST['start'] : null;
				$endDate = validateDate($_POST['end']) ? $_POST['end'] : null;

				if($startDate == null || $endDate == null) {
					die('Must provide valid start and end dates!');
				}

				if(!isset($_POST['name']) || empty($_POST['name'])) {
					die('Must provide a valid title!');
				}

				$addressId = createAddress($dbh,
										   $_POST['addressline1'], 
										   $_POST['addressline2'], 
										   $_POST['city'],
										   $_POST['state'],
										   $_POST['zipcode']);

				$res = createCursillo($dbh, $startDate, 
											$endDate, 
											$addressId, 
											$_POST['name'],
											$_POST['gender'],
											$_POST['description'],
											$_POST['notes'],
											$_POST['photo']);

				if($res) {
					print("Created Successfully!");
				} else {
					print("Error creating Cursillo Weekend");
					print_r($dbh->errorInfo());
				}
			?>
		<?php endif ?>
		<div class="row menu-header">
			<h2 class="span12" style="text-align:center;">Create A Weekend</h2>
		</div>
		<form method="POST" id="cursillo-form">
			<div class="basic-cursillo-info">
				<div class="row">
					<div class="span4">Start Date:</div>
					<div class="span8">
						<input class="input-block-level" type="date" name="start">
					</div>
				</div>
				<div class="row">
					<div class="span4">End Date:</div>
					<div class="span8">
						<input class="input-block-level" type="date" name="end">
					</div>
				</div>
				<div class="row">
					<div class="span4">Event Title</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="name">
					</div>
				</div>
				<div class="row">
					<div class="span4">Gender:</div>
					<div class="span8">
						<select class="selectpicker" name="gender">
							<option value="MALE">Male</option>
							<option value="FEMALE">Female</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span4">Description</div>
					<div class="span8">
						<textarea class="span8 form-control" form="cursillo-form"
								  rows="5" name="description"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="span4">Notes</div>
					<div class="span8">
						<textarea class="span8 form-control" form="cursillo-form"
								  rows="5" name="notes" /></textarea>
					</div>
				</div>
				<div class="row">
					<div class="span4">Photo URL</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="photo">
					</div>
				</div>
			</div>
			<div class="address-info">
				<div class="row">
					<div class="span4">Address Line 1:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="addressline1">
					</div>
				</div>
				<div class="row">
					<div class="span4">Address Line 2:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="addressline2">
					</div>
				</div>
				<div class="row">
					<div class="span4">City:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="city">
					</div>
				</div>
				<div class="row">
					<div class="span4">State:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="state">
					</div>
				</div>
				<div class="row">
					<div class="span4">Zip Code:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="zipcode">
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Create Weekend">
		</form>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
	 		$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</body>
<?php include('../common/footer.php'); ?>
</html>