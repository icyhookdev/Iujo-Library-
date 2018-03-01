<?php 
  class lending{
    
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function register($data){
      $user = $data['user'];
      $person = $data['person']; 
      $book = $data['book'];

      $sql = "INSERT INTO lendings (id_user, id_person, id_book) VALUES ($user, $person, $book)";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function fetchLendings(){
      $sql = "SELECT l.id_lendings, u.username, p.person_n, p.person_ln, p.ci, b.book_n FROM person AS p, book AS b, lendings AS l, users AS u WHERE l.id_user > 0 AND l.id_person > 0 AND l.id_book > 0 AND u.id_user = l.id_user AND p.id_person = l.id_person AND b.id_book = l.id_book";

      $row = $this->db->query($sql);
      return $row;
    }

    public function fetchLendingsDetails($id){
      $sql = "SELECT l.id_lendings, l.stats, l.register_at, u.username, p.person_n, c.core_n, p.person_ln, p.ci, p.phone, b.book_n, b.id_book, b.id_author FROM person AS p, book AS b, lendings AS l, users AS u, core AS c WHERE l.id_lendings = $id AND u.id_user = l.id_user AND p.id_person = l.id_person AND c.id_core = p.id_core AND b.id_book = l.id_book";

      $row = $this->db->resultSet($sql);
      return $row;
    }

    public function updateQuantity($data){
      $name = $data['book'];
      $author = $data['author'];

      $sql = "UPDATE book SET quantity = quantity -1 WHERE id_book = $name AND id_author = $author";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function checkAuthorBook($author, $book){
      $sql = "SELECT * FROM book WHERE id_author = $author AND id_book = $book";
      if($this->db->rowCount($sql) > 0){
        return true;
      }else{
        return false;
      }
    }

    public function updateStats($id){
      $sql = "UPDATE lendings SET stats = false WHERE id_lendings = $id";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function returnQuantity($book, $author){
      $sql="UPDATE book SET quantity = quantity + 1 WHERE id_book = $book AND id_author = $author";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }
  }
