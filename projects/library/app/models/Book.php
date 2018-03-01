<?php  
  class Book{
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function add($data){
      $name = $data['name'];
      $created_at = $data['year'];
      $author = $data['author'];
      $genre = $data['genre'];
      $editorial = $data['editorial'];
      $quantity = $data['quantity'];
      $sql = "INSERT INTO book (book_n, created_at, id_author, id_genre, id_editorial, quantity) VALUES ('$name', '$created_at', $author, $genre, $editorial, $quantity)";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function addGA($data, $table, $field){
      $name = $data['name'];
      $sql = "INSERT INTO $table ($field) VALUES ('$name')";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function addEditorial($data){
      $name = $data['name'];
      $phone = $data['phone'];
      $location = $data['location'];
      $sql = "INSERT INTO editorial (editorial_n, phone, location) VALUES ('$name', $phone, '$location')";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function checkForIt($name, $table, $field){
      $sql = "SELECT * FROM $table WHERE $field = '$name'";
      if($this->db->rowCount($sql) > 0){
        return true;
      }else{
        return false;
      }
    }

    public function checkForUpdate($name, $author){
      $sql = "SELECT id_author, book_n from book where book_n = '$name' AND id_author = $author";
      if($this->db->rowCount($sql) > 0){
        return true;
      }else{
        return false;
      }

    }

    public function fetchSelects($table){
      $sql = "SELECT * FROM $table";
      $row = $this->db->query($sql);
      return $row;
    }

    public function searchBook($name){
      $sql = "SELECT b.id_book, b.book_n, g.genre_n, a.author_n, b.created_at FROM book AS b, genre AS g, author AS a WHERE b.book_n = '$name' AND g.id_genre = b.id_genre
      AND  a.id_author = b.id_author";

      $row = $this->db->resultSet($sql);
      return $row;
    }

    public function fetchSingleBook($id){
      $sql = "SELECT b.quantity, b.register_at, b.id_book, b.book_n, g.id_genre, g.genre_n, a.id_author, a.author_n, b.created_at, e.id_editorial, e.editorial_n FROM book AS b, genre AS g, author AS a, editorial AS e WHERE b.id_book = $id AND g.id_genre = b.id_genre AND  a.id_author = b.id_author AND e.id_editorial = b.id_editorial";

      $row = $this->db->resultSet($sql);
      return $row;
    }

    public function fetchBook(){
      $sql = "SELECT b.id_book, b.book_n, g.genre_n, a.author_n, b.created_at FROM book AS b, genre AS g, author AS a WHERE b.id_genre > 0 AND g.id_genre = b.id_genre
      AND b.id_author > 0 AND a.id_author = b.id_author LIMIT '8'";
      
      $row = $this->db->query($sql);
      return $row;
    }

    public function updateQuantity($data){
      $author = $data['author'];
      $quantity = $data['quantity'];
      $name = $data['name'];
      $sql = "UPDATE book SET quantity = quantity + $quantity WHERE book_n = '$name' AND id_author = $author";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function updateBook($data){    
      $name = $data['name'];
      $year = $data['year'];
      $author = $data['author'];
      $genre = $data['genre'];
      $editorial = $data['editorial'];
      $id = $data['id'];

      $sql = "UPDATE book SET book_n = '$name', created_at = '$year', id_author = $author, id_genre = $genre, id_editorial = $editorial WHERE id_book = $id";

      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      } 

    }

    public function deleteBook($id){
      $sql = "DELETE FROM book WHERE id_book = $id";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function authorBooks($id){
      $sql = "SELECT * FROM author WHERE id_author = $id";
      if($this->db->query($sql)){
        return true;
      }else{
        return false;
      }
    }

    public function selectByAuthor($id){
      $sql = "SELECT b.id_book, b.created_at, b.book_n, g.genre_n, b.created_at FROM book AS b, genre AS g WHERE b.id_genre > 0 AND g.id_genre = b.id_genre AND b.id_author = $id";
      $row = $this->db->query($sql);
      return $row;
  
    }

    public function authorName($id){
      $sql = "SELECT * FROM author WHERE id_author = $id";
      $row = $this->db->resultSet($sql);
      return $row;
    }
  }