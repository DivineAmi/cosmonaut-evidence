<?php
  /**
   * Class for connection definition
   */
  class Dbh
  {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    protected function connect() {
      $this->servername = "eu-cdbr-west-02.cleardb.net";
      $this->username = "bfbed68cdf7205";
      $this->password = "cc3523d2";
      $this->dbname = "cosmoevidence";
      $this->charset = "utf8mb4";

      try {
        $dsn = 'mysql:host=' . $this->servername . ';dbname=' . $this->dbname . ';charset=' . $this->charset;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
      } catch (PDOException $ex) {
        echo("Connection failed: " . $ex->getMessage());
      }

    }
  }

?>
