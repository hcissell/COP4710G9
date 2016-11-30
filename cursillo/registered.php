<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cursillo Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
<body>

	<div class="container">
		<?php include('../common/nav.php'); ?>
		<?php if(!isset($_GET['cursillo'])): ?>
			<?php
				$weekends = getWeekends($dbh, array());
			?>
			<div class="row menu-header">
				<h4 class="span12" style="text-align:center;">Select An Event to See Registered Cendidates</h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Number</th>
						<th>Title</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Gender</th>
						<th>Select</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($weekends as $weekend): ?>
					<?php 
						$start = new DateTime($weekend['Start']);
						$end = new DateTime($weekend['End']);
					?>

					<tr>
						<td><?php echo $weekend['EventID'] ?></td>
						<td><?php echo $weekend['EventName'] ?></td>
						<td><?php echo $start->format('Y-m-d') ?></td>
						<td><?php echo $end->format('Y-m-d') ?></td>
						<td><?php echo $weekend['Gender'] ?></td>
						<td>
							<a href="registered.php?cursillo=<?php echo $weekend['EventID']; ?>" target="new">
								<button type="button" class="btn btn-success">Select</button>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<?php
				$id = $_GET['cursillo'];
				$weekend = getCursillo($dbh, $id);
				if(isset($_GET['delperson'])) {
					$individualID = $_GET['delperson'];
					if(!deleteAttendee($dbh, $individualID, $id)) {
						print("Error deleting individual from cursillo");
					}
				}

				if(isset($_GET['promoteperson'])) {
					$individualID = $_GET['promoteperson'];
					if(!promoteAttendee($dbh, $individualID, $id)) {
						print("Error promoting individual");
					}
				}

				$individuals = getAttendees($dbh, $id);
			?>
			<div class="row menu-header">
				<div class="span3">
		        	<a href="<?php makeLink('cursillo/registered.php') ?>" class="btn">Back</a>
				</div>
				<h4 class="span8">Registered Candidates for Cursillo #: <?php echo $id ?></h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Name Tag</th>
						<th>Phone Number</th>
						<th>Parish</th>
						<th>Promote</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($individuals as $individual): ?>
					<tr>
						<td><?php echo $individual['FirstName'] . " " . 
									   $individual['LastName'] ?>
						</td>
						<td><?php echo $individual['NameTag'] ?></td>
						<td><?php echo $individual['Phone'] ?></td>
						<td><?php echo $individual['ParishName'] ?></td>
						<td>
							<?php 
								$link = "cursillo=" . $id . "&" . 
										"promoteperson=" . $individual['IndividualID'];
								$disabled = $individual['IndividualType'] == "TEAM";
							?>
							<a href="registered.php?<?php echo $link; ?>" target="new">
								<button type="button" class="btn btn-success"
									<?php if($disabled) echo "disabled" ?>>
									Promote to Team Member
								</button>
							</a>
						</td>
						<td>
							<?php 
								$link = "cursillo=" . $id . "&" . 
										"delperson=" . $individual['IndividualID'];
							?>
							<a href="registered.php?<?php echo $link; ?>" target="new">
								<button type="button" class="btn btn-danger">Remove</button>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>

		<?php endif; ?>
	</div>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>