<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Update An Individual</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>
	<div class="container">
		<?php include('../common/nav.php'); ?>
		<?php if($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
			<?php
				$id = $_GET['id'];
				if(empty($id)) {
					die("Must provide an id to update!");
				}

				$individual = getIndividual($dbh, $id);
				if(empty($individual)) {
					die("Could not find individual");
				}

				$addressID = createUpdateAddress($dbh,
	 											 $individual['AddressID'], 
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

				$res = updateIndividual($dbh,
										$id,
										$addressID, 
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
										checkBoxToBit($hasspouseattended));

			?>
		<?php endif; ?>
		<?php 
			$id = $_GET['id'];
			if(empty($id)) {
				die("Must provide an id to update!");
			}

			$individual = getIndividual($dbh, $id);
			if(empty($individual)) {
				die("Could not find individual");
			}

			$address = getAddress($dbh, $individual['AddressID']);
			if(empty($address)) {
				die("Could not find address");
			}

			if(!empty($individual['SponsorID'])) {
				$sponsor = getIndividual($dbh, $individual['SponsorID']);
				$sponsorFirst = $sponsor['FirstName'];
				$sponsorLast = $sponsor['LastName'];
			} else {
				$sponsorFirst = '';
				$sponsorLast = '';
			}
		?>

		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">First Name:</div>
					<div class="span8">
						<input class="input-block-level" 
								type="text" name="first"
								value="<?php echo $individual['FirstName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Last Name:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="last"
							   value="<?php echo $individual['LastName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Name Tag:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="nametag"
							   value="<?php echo $individual['NameTag'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Gender:</div>
					<div class="span8">
						<select class="selectpicker" name="gender">
							<option value="MALE" 
								<?php if($individual['Gender']=='MALE') {
									echo 'selected';
								}?>
								>Male</option>
							<option value="FEMALE" 
								<?php if($individual['Gender']=='FEMALE') {
									echo 'selected';
								}?>
								>FEMALE</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span4">Email Address:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="email" name="email"
							   value="<?php echo $individual['Email'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Phone Number:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="tel" name="phone"
							   value="<?php echo $individual['Phone'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Date of Birth:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="date" name="birthday"
							   value="<?php echo $individual['Birthday'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Occupation:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="occupation"
							   value="<?php echo $individual['Occupation'] ?>">
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
			<div class="other-individual-info">
				<div class="row">
					<div class="span4">Married?</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="checkbox" name="ismarried"
							   <?php if($individual['IsMarried']) { echo 'checked="checked"';} ?>>
					</div>
				</div>
				<div class="row">
					<div class="span4">Has Spouse Attended?</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="checkbox" name="hasspouseattended"
							   <?php if($individual['HasSpouseAttended']) { echo 'checked="checked"';} ?>>
					</div>
				</div>
				<div class="row">
					<div class="span4">Spouse First Name:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="spousefirst"
							   value="<?php echo $individual['SpouseFirstName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Spouse Last Name:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="spouselast"
							   value="<?php echo $individual['SpouseLastName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Sponsor First Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="sponsorfirst"
							   data-toggle="tooltip" data-placement="top" 
							   value="<?php echo $sponsorFirst ?>"
							   title="We'll search for the sponsor using their name!">
					</div>
				</div>
				<div class="row">
					<div class="span4">Sponsor Last Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" name="sponsorlast"
							   data-toggle="tooltip" data-placement="top" 
							   value="<?php echo $sponsorLast ?>"
							   title="We'll search for the sponsor using their name!">
					</div>
				</div>
				<div class="row">
					<div class="span4">Parish Name:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="parishname"
							   value="<?php echo $individual['ParishName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Pastor First Name:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="pastorfirst"
							   value="<?php echo $individual['PastorFirstName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Pastor Last Name:</div>
					<div class="span8">
						<input class="input-block-level" 
							   type="text" name="pastorlast"
							   value="<?php echo $individual['PastorLastName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Type:</div>
					<div class="span8">
						<select class="selectpicker" name="type" disabled>
							<option value="CANDIDATE" 
								<?php if($individual['IndividualType']=='CANDIDATE') {
									echo 'selected';
								}?>
								>Candidate</option>
							<option value="TEAM" 
								<?php if($individual['IndividualType']=='TEAM') {
									echo 'selected';
								}?>
								>Team Member</option>
						</select>
					</div>
				</div>

			</div>
			<input class="btn btn-primary" type="submit" value="Update Individual">
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