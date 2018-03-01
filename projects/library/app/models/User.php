<?php 
  class User{

    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function register($data){
      $user = $data['username'];
      $email = $data['email'];
      $pass = $data['password'];
      $personId = $data['person'];

      $sql = "INSERT INTO users (username, email, password, id_person) VALUES ('$user', '$email', '$pass', $personId)";

      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function findUser($user){
      $sql = "SELECT username FROM users WHERE username = '$user'";

      if($this->db->rowCount($sql) > 0){
        return true;
      }else{
        return false;
      }
    }

    public function findUserEmail($email){
      $sql = "SELECT email FROM users WHERE email = '$email'";

      if($this->db->rowCount($sql) > 0){
        return true;
      }else{
        return false;
      }
    }

    public function checkUserAccount($idPerson){
      $sql = "SELECT id_person FROM users WHERE id_person = $idPerson";
      
      if($this->db->rowCount($sql) > 0){
        return true;
      }else{
        return false;
      }
    }

    public function getProfile($sessionIdPerson){
      $sql = "SELECT u.username, u.email, p.ci FROM users as u, person as p WHERE u.id_person = $sessionIdPerson AND p.id_person = u.id_person";
      $row =$this->db->resultSet($sql);
      return $row;
    }

    public function updateProfile($email, $username){
      $sql = "UPDATE users SET email = '$email' WHERE username = '$username'";
      $row = $this->db->query($sql);
      return $row;
    }
   
    public function login($user, $pass){
      $sql = "SELECT * FROM users WHERE username = '$user'";

      $row = $this->db->resultSet($sql);
 
      $hash = $row['password'];
      if(password_verify($pass, $hash) || $pass === $hash){
        return $row;
      }else{
        return false;
      }
    }

    public function deleteAccount($userId){
      $sql = "DELETE FROM users WHERE id_user = $userId";
      $row = $this->db->query($sql);
      return $row;
    }
  }