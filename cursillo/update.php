<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Update A Cursillo Weekend</title>
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
				$weekend = getCursillo($dbh, $id);
	
				if(!isset($weekend) || empty($weekend)) {
					die("Could not find requested weekend");
				}
	
				$startDate = validateDate($_POST['start']) ? $_POST['start'] : null;
				$endDate = validateDate($_POST['end']) ? $_POST['end'] : null;

				if($startDate == null || $endDate == null) {
					die('Must provide valid start and end dates!');
				}

				if(!isset($_POST['name']) || empty($_POST['name'])) {
					die('Must provide a valid title!');
				}

				$addressId = createUpdateAddress($dbh,
										   $weekend['AddressID'],
										   $_POST['addressline1'], 
										   $_POST['addressline2'], 
										   $_POST['city'],
										   $_POST['state'],
										   $_POST['zipcode']);

				$res = updateCursillo($dbh, $id,
											$startDate, 
											$endDate, 
											$addressId, 
											$_POST['name'],
											$_POST['gender'],
											$_POST['description'],
											$_POST['notes'],
											$_POST['photo']);

				if($res) {
					print("Updated Successfully!");
				} else {
					print("Error updating Cursillo Weekend");
					print_r($dbh->errorInfo());
				}
			?>
		<?php endif ?>

		<?php 
			$id = $_GET['id'];
			$weekend = getCursillo($dbh, $id);

			$address = getAddress($dbh, $weekend['AddressID']);

			if(!isset($weekend) || empty($weekend)) {
				die("Could not find requested weekend");
			}
			
			$startDate = validateDate($weekend['Start']) ? $weekend['Start'] : null;
			$endDate = validateDate($weekend['End']) ? $weekend['End'] : null;
		?>
		<div class="row menu-header">
			<h4 class="span12" style="text-align:center;">Update Cursillo # <?php echo $id ?></h4>
		</div>
		<form method="POST" id="cursillo-form">
			<div class="basic-cursillo-info">
				<div class="row">
					<div class="span4">Number: <?php echo $weekend['EventID']; ?></div>
					<div class="span8">
						<?php 
							if(isset($weekend['PhotoUrl']) && !empty($weekend['PhotoUrl'])):
						?>
						
							<img src="<?php echo $weekend['PhotoUrl']?>">
						
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="span4">Start Date:</div>
					<div class="span8">
						<input class="input-block-level" type="date" 
							   name="start" value="<?php echo $weekend['Start']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">End Date:</div>
					<div class="span8">
						<input class="input-block-level" type="date" 
							   name="end" value="<?php echo $weekend['End']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Event Title</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="name" value="<?php echo $weekend['EventName']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Gender:</div>
					<div class="span8">
						<select class="selectpicker" name="gender">
							<option value="MALE"
								<?php if($weekend['Gender']=='MALE') {
									echo 'selected';
								}?>>
								Male
							</option>
							<option value="FEMALE"
								<?php if($weekend['Gender']=='FEMALE') {
									echo 'selected';
								}?>>
								Female
							</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span4">Description</div>
					<div class="span8">
						<textarea class="span8 form-control" 
								  form="cursillo-form" rows="5" 
								  name="description"><?php echo $weekend['Description']; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="span4">Notes</div>
					<div class="span8">
						<textarea class="span8 form-control" 
								  form="cursillo-form" rows="5" name="notes" /><?php echo $weekend['Notes']; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="span4">Photo URL</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="photo" value="<?php echo $weekend['PhotoUrl']; ?>">
					</div>
				</div>
			</div>
			<div class="address-info">
				<div class="row">
					<div class="span4">Address Line 1:</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="addressline1" value="<?php echo $address['Line1']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Address Line 2:</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="addressline2" value="<?php echo $address['Line2']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">City:</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="city" value="<?php echo $address['City']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">State:</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="state" value="<?php echo $address['State']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Zip Code:</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="zipcode" value="<?php echo $address['ZipCode']; ?>">
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Update Weekend">
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