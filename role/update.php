<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Update A Role</title>
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
				$isActive = isset($_POST['isactive']) ? $_POST['isactive'] : "off";

				$res = updateRole($dbh,
								  $id,
							      $_POST['rolename'], 
							      checkBoxToBit($isActive));

				if($res) {
					print("Updated role " . $_POST['rolename'] . "Successfully!");
				} else {
					print("Error updating role");
					print_r($dbh->errorInfo());
				}
			?>
		<?php endif; ?>

		<?php 
			if(!isset($_GET['id'])) {
				die('Cannot update a role without an id!');
			}

			$id = $_GET['id'];
			$role = getRole($dbh, $id);

			if(!isset($role) || empty($role)) {
				die('Could not find role');
			}


		?>
		
		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">Role Name:</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="rolename" value="<?php echo $role['RoleName'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Is Active:</div>
					<div class="span8">
						<input class="input-block-level" type="checkbox" name="isactive"
							   <?php if($role['IsActive']) { echo 'checked="checked"';} ?>>
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Update Role">
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