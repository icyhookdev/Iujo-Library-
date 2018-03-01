<?php 
  class Person{
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function addPerson($data){
      $name = $data['name'];
      $lastName = $data['lastName'];
      $location = $data['location'];
      $ci = $data['ci'];
      $gender = $data['gender'];
      $birthdate = $data['birthdate'];
      $phone = $data['phone'];
      $core = $data['core'];

      $sql = "INSERT INTO person (person_n, person_ln, ci, direction, id_gender, birthdate, phone, id_core) VALUES ('$name', '$lastName', '$ci', '$location', $gender, '$birthdate', $phone, $core)";

      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function findPersonByCi($ci){
      $sql = "SELECT * FROM person WHERE ci = '$ci'";
      if($this->db->rowCount($sql) > 0){
        return true;
      }else{
        return false;
      }
    }

    public function fetchGender(){
      $sql = "SELECT * FROM gender";
      $row = $this->db->query($sql);
      return $row;
    }

    public function fetchCore(){
      $sql = "SELECT * FROM core";
      $row = $this->db->query($sql);
      return $row;
    }

    public function getPerson(){
      $sql = "SELECT * FROM person ORDER BY person_n";
      $row = $this->db->query($sql);
      return $row;
    }  

    public function getPersonUserData(){
      $sql = "SELECT p.person_n, p.person_ln, p.ci, p.id_person, u.username FROM users as u, person as p WHERE u.id_person > 0 AND p.id_person = u.id_person";
      $row = $this->db->query($sql);
      return $row;
    }

    public function getPersonId($ci){
      $sql = "SELECT * FROM person where ci = '$ci'";
      $row = $this->db->resultSet($sql);
      return $row;
    }

    public function getProfileData($id){
      $sql = "SELECT * FROM person WHERE id_person = $id";
      $row = $this->db->resultSet($sql);
      return $row;
    }

    public function getCore($id_core){
      $sql = "SELECT c.core_n FROM core as c, person as p WHERE p.id_person = $id_core AND c.id_core = p.id_core";
      $row = $this->db->resultSet($sql);
      return $row;
    }

    public function updatePerson($data){
      $name = $data['name'];
      $lastname = $data['lastname'];
      $personId = $data['personId'];
      $phone = $data['phone'];
      $location = $data['local'];
      $core = $data['core'];

      $sql = "UPDATE person SET person_n = '$name', person_ln = '$lastname', direction = '$location', phone = $phone, id_core = $core WHERE id_person = $personId";

      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function deletePerson($id){ 
      $sql = "DELETE FROM person WHERE id_person = $id";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function fetchPerson(){
      $sql = "SELECT * FROM person";
      $row = $this->db->query($sql);
      return $row;
    }

  }