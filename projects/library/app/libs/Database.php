<?php 
  class Database{
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $pass = DB_PASS; 
    private $dbname = DB_NAME;

    public function conn(){
      $conn= pg_connect('host=' . $this->host. ' port='. $this->port . ' dbname='. $this->dbname . ' user=' . $this->user . ' password=' . $this->pass);
      return $conn;
    }
 
    public function query($query){
      $sql = pg_query($this->conn(), $query);
      return $sql;
    }

    public function resultSet($sql){
      $query = $this->query($sql);
      $row = pg_fetch_assoc($query);
      return $row;
    }

    public function rowCount($sql){
      $rc = $this->query($sql);
      $row = pg_num_rows($rc);
      return $row;
    }

  }