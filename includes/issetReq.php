<?php
  //Deleting cosmonaut
  if(isset($_GET['delete']))
    $users->deleteUser($_GET['delete']);

  //Adding new cosmonaut
  if(isset($_GET['formAdd']))
    $users->addUser($_POST['name'], $_POST['lastname'], $_POST['birthdate'], $_POST['superpower']);

  //Selecting data for edit inputs
  if(isset($_GET['edit']))
    $users->getCurrentUser($_GET['edit']);

  //Editing cosmonaut
  if(isset($_GET['edit']))
    $_SESSION['id'] = $_GET['edit'];

  if(isset($_GET['formEdit']))
    $users->updateUser($_POST['name'], $_POST['lastname'], $_POST['birthdate'], $_POST['superpower'], $_SESSION['id']);
?>
