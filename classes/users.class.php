<?php
  /**
   * Class for user
   */
  class Users extends Dbh {
    public $allUsers;
    public $name;
    public $lastname;
    public $birthdate;
    public $superpower;

    //Function for getting all users
    public function getAllUsers() {
      $sql = "SELECT * FROM cosmonauts";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
      $this->allUsers = $stmt->fetchAll();
    }

    //Function for getting current user with id
    public function getCurrentUser($id) {
      $sql = "SELECT * FROM cosmonauts WHERE id=?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id]);
      if($stmt->rowCount()) {
        while($row = $stmt->fetch()) {
          $this->name = $row['name'];
          $this->lastname = $row['lastname'];
          $this->birthdate = $row['birthdate'];
          $this->superpower = $row['superpower'];
        }
      }
    }

    //Function for deleteing user
    public function deleteUser($id) {
      $sql = "DELETE FROM cosmonauts WHERE id=?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$id]);
      header("Location: index.php?successfullyRemoved");
    }

    //Function for adding user
    public function addUser($name, $lastname, $date, $superpower) {
      $sql = "INSERT INTO cosmonauts(name, lastname, birthdate, superpower) VALUES(?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$name, $lastname, $date, $superpower]);
      header("Location: index.php?successfullyAdded");
    }

    //Function for updating user
    public function updateUser($name, $lastname, $birthdate, $superpower, $id) {
      $sql = "UPDATE cosmonauts SET name=?, lastname=?, birthdate=?, superpower=? WHERE id=?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$name, $lastname, $birthdate, $superpower, $id]);
      header("Location: index.php?successfullyEdited");
    }
  }

?>
