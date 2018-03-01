<?php 
  class Donation{
    private $db;
    
    public function __construct() {
      $this->db = new Database;
    }

    public function addCompany($data){
      $name = $data['name'];
      $description = $data['description'];
      $sql = "INSERT INTO company (company_n, description) VALUES ('$name', '$description')";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function addDonation($data){
      $entity = $data['entity'];
      $person = $data['person'];
      $reason = $data['reason'];
      $book = $data['book'];
      $company = $data['company'];

      if(empty($company)){
        $sql = "INSERT INTO donations (reason, id_entity, id_person, id_book) VALUES ('$reason', $entity, $person, $book)";
      }else{
        $sql = "INSERT INTO donations (reason, id_entity, id_company, id_book) VALUES ('$reason', $entity, $company, $book)";
      }

      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function fetchCompanyDonations(){
      $sql = "SELECT c.company_n, d.register_at FROM donations AS d, company AS c WHERE d.id_company > 0 AND c.id_company = d.id_company";

      $row = $this->db->query($sql);
      return $row;
    }

    public function fetchPersonDonations(){
      $sql = "SELECT p.person_n, p.person_ln, p.ci, d.register_at FROM donations AS d, person AS p WHERE d.id_person > 0 AND p.id_person = d.id_person";

      $row = $this->db->query($sql);
      return $row;
    }
  }