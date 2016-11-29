<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	include('../common/util.php');
	$dbh = connectToDB();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Update A Talk</title>
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

				$res = updateTalk($dbh,
								  $id,
							      $_POST['title'], 
							      checkBoxToBit($isActive),
                    $_POST['description'] );

				if($res) {
					print("Updated talk " . $_POST['title'] . "Successfully!");
				} else {
					print("Error updating talk");
					print_r($dbh->errorInfo());
				}
			?>
		<?php endif; ?>

		<?php 
			if(!isset($_GET['id'])) {
				die('Cannot update a talk without an id!');
			}

			$id = $_GET['id'];
			$talk = getTalk($dbh, $id);

			if(!isset($talk) || empty($talk)) {
				die('Could not find talk');
			}


		?>
		
		<form method="POST">
			<div class="basic-individual-info">
				<div class="row">
					<div class="span4">Talk Title:</div>
					<div class="span8">
						<input class="input-block-level" type="text" 
							   name="title" value="<?php echo $talk['Title'] ?>">
					</div>
				</div>
				<div class="row">
					<div class="span4">Is Active:</div>
					<div class="span8">
						<input class="input-block-level" type="checkbox" name="isactive"
							   <?php if($talk['IsActive']) { echo 'checked="checked"';} ?>>
					</div>
				</div>
        <div class="row">
					<div class="span4">Description</div>
					<div class="span8">
						<textarea class="span8 form-control" rows="5" 
								  name="description"><?php echo $talk['Description']; ?></textarea>
					</div>
				</div>
			</div>
			<input class="btn btn-primary" type="submit" value="Update Talk">
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