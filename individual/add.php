<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create An Individual</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<div class="container">
	<?php include('../common/nav.php'); ?>
		<?php if($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
			<?php 
				$addressId = createAddress($dbh,
										   $_POST['addressline1'], 
										   $_POST['addressline2'], 
										   $_POST['city'],
										   $_POST['state'],
										   $_POST['zipcode']);

				$sponsorId = findSponsor($dbh, $_POST['sponsorfirst'], $_POST['sponsorlast']);
				$parishName = findParish($dbh, $_POST['parishname']);

				$ismarried = isset($_POST['ismarried']) ? $_POST['ismarried'] : "off";
				$hasspouseattended = isset($_POST['hasspouseattended']) ? $_POST['hasspouseattended'] : "off";
				$birthday = validateDate($_POST['birthday']) ? $_POST['birthday'] : null;

				$res = createIndividual($dbh,
										$addressId, 
										$_POST['first'],
										$_POST['last'],
										$_POST['gender'],
										$_POST['spousefirst'],
										$_POST['spouselast'],
										$_POST['pastorfirst'],
										$_POST['pastorlast'],
										$_POST['email'],
										$_POST['phone'],
										$_POST['nametag'],
										$_POST['occupation'],
										$sponsorId,
										$parishName,
										$birthday,
										checkBoxToBit($ismarried),
										checkBoxToBit($hasspouseattended),
										"CANDIDATE");

				if($res) {
					print($_POST['first'] . " " . $_POST['last'] . " Created Successfully!");
				} else {
					print("Error creating individual ");
					print_r($dbh->errorInfo());
				}
			?>
		<?php endif ?>
		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">First Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="first">
					</div>
				</div>
				<div class="row">
					<div class="span4">Last Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="last">
					</div>
				</div>
				<div class="row">
					<div class="span4">Name Tag:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="nametag">
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
					<div class="span4">Email Address:</div>
					<div class="span8">
						<input class="input-block-level" type="email" name="email">
					</div>
				</div>
				<div class="row">
					<div class="span4">Phone Number:</div>
					<div class="span8">
						<input class="input-block-level" type="tel" name="phone">
					</div>
				</div>
				<div class="row">
					<div class="span4">Date of Birth:</div>
					<div class="span8">
						<input class="input-block-level" type="date" name="birthday">
					</div>
				</div>
				<div class="row">
					<div class="span4">Occupation:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="occupation">
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
			<div class="other-individual-info">
				<div class="row">
					<div class="span4">Married?</div>
					<div class="span8">
						<input class="input-block-level" type="checkbox" name="ismarried">
					</div>
				</div>
				<div class="row">
					<div class="span4">Has Spouse Attended?</div>
					<div class="span8">
						<input class="input-block-level" type="checkbox" name="hasspouseattended">
					</div>
				</div>
				<div class="row">
					<div class="span4">Spouse First Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="spousefirst">
					</div>
				</div>
				<div class="row">
					<div class="span4">Spouse Last Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="spouselast">
					</div>
				</div>
				<div class="row">
					<div class="span4">Sponsor First Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="sponsorfirst"
							   data-toggle="tooltip" data-placement="top" 
							   title="We'll search for the sponsor using their name!">
					</div>
				</div>
				<div class="row">
					<div class="span4">Sponsor Last Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="sponsorlast"
							   data-toggle="tooltip" data-placement="top" 
							   title="We'll search for the sponsor using their name!">
					</div>
				</div>
				<div class="row">
					<div class="span4">Parish Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="parishname">
					</div>
				</div>
				<div class="row">
					<div class="span4">Pastor First Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="pastorfirst">
					</div>
				</div>
				<div class="row">
					<div class="span4">Pastor Last Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="pastorlast">
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Create Individual">
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
</html>