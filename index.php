<?php
	include_once('includes/paths.inc.php');

  $users = new Users();

  require_once('includes/issetReq.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cosmo Evidence</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/heroic-features.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">

</head>

<body>
	<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Cosmo Evidence </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
      </div>
    </div>
  </nav>

	<!-- Page Content -->
  <div class="container">
		<div class="row">
      <?php
        $users->getAllUsers();
			?>
      <h3 class="mt-4">Cosmonauts <i class="fas fa-user-astronaut"></i></h3>
      <!--- Table for showing cosmonauts -->
      <table class="table table-dark mt-4" border="1">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Birthdate</th>
            <th scope="col">Superpower</th>
            <th scope="col" colspan="2">Edit / Delete</th>
          </tr>
        </thead>
        <tbody>
          <!--- Foreach loop for getting all users one by one -->
          <?php foreach ($users->allUsers as $user) { ?>
            <tr>
              <th scope="row"><?php echo($user['id']) ?></th>
              <td><?php echo($user['name']) ?></td>
              <td><?php echo($user['lastname']) ?></td>
              <td><?php echo($user['birthdate']) ?></td>
              <td><?php echo($user['superpower']) ?></td>
              <td><button id="<?php echo($user['id']); ?>" type="button" name="editBut" class="btn btn-info" onclick="window.location.href='?edit=' + this.id"><i class="fas fa-edit"></i> Edit</button></td>
              <td><button id="<?php echo($user['id']); ?>" type="button" class="delete-it btn btn-danger"><i class="fa fa-times"></i> Delete</button></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <!--- Form for adding and editing cosmonauts -->
      <div class="container">
        <form name="<?php if(isset($_GET['edit'])) echo("formEdit"); else echo("formAdd"); ?>" method="POST" class="submit-it">
          <h3 class="text-secondary"><?php if(isset($_GET['edit'])) echo("Edit this cosmonaut"); else echo("Add new cosmonaut"); ?></h3>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php if(isset($_GET['edit'])) echo($users->name); ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Lastname</label>
              <input type="text" class="form-control" name="lastname" placeholder="Enter lastname" value="<?php if(isset($_GET['edit'])) echo($users->lastname); ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Birthdate</label>
              <input type="date" class="form-control" name="birthdate" placeholder="Enter birthdate" value="<?php if(isset($_GET['edit'])) echo($users->birthdate); ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Superpower</label>
              <input type="text" class="form-control" name="superpower" placeholder="Enter superpower" value="<?php if(isset($_GET['edit'])) echo($users->superpower); ?>" required>
            </div>
            <div class="container text-center">
              <button type="button" name="submitBut" class="btn btn-danger col-md-5" onclick="window.location.href='index.php'">Cancel</button>
              <button type="submit" name="submitBut" class="btn btn-success col-md-5"><?php if(isset($_GET['edit'])) echo("Edit this cosmonaut"); else echo("Add new cosmonaut"); ?></button>
            </div>
          </div>
        </form>
      </div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="py-5 bg-dark mt-4 sticky-bottom">
		<div class="container">
			<p class="m-0 text-center text-white">Cosmonaut evidence.</p>
		</div>
	</footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Bootbox -->
  <script src="bootbox/dist/bootbox.min.js"></script>

  <script type="text/javascript">

    //Link URL on submit
    $(".submit-it").submit(function(){
      var linkName = $(this).attr('name');
      history.pushState("cosmonaut", "Cosmo evidence", "?" + linkName);
    });

    //Opens modal on click with using js librabry bootbox
    $(".delete-it").click(function(){
      var id = $(this).attr('id');
        bootbox.confirm({
            title: "Delete cosmonaut?",
            message: "Do you want to delete this cosmonaut? This cannot be undone.",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel',
                    className: 'btn-danger'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm',
                    className: 'btn-success'
                }
            },
            callback: function (result) {
              if(result)
                window.location.href = 'index.php?delete=' + id;
            }
        });
      });
    </script>

</body>

</html>
