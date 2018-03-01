<?php 
  class Lendings extends Controller{
    public function __construct() {
      logInSession($_SESSION['userId']);
      $this->lendingModel = $this->model('Lending');
      $this->bookModel = $this->model('Book');
    }

    public function index(){
      $lendings = $this->lendingModel->fetchLendings();
      $data = [
        'lendings' => $lendings
      ];
      $this->view('lending/index', $data);
    }

    public function register(){
      $fetchPerson = $this->bookModel->fetchSelects('person');
      $fetchBook = $this->bookModel->fetchSelects('book');
      $fetchAuthor = $this->bookModel->fetchSelects('author');

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'fetchPerson' => $fetchPerson,
          'fetchBook' => $fetchBook,
          'fetchAuthor' => $fetchAuthor,
          'user' => trim($_POST['userid']),
          'person' => trim($_POST['person']),
          'book' => trim($_POST['book']),
          'author' => trim($_POST['author']),
          'authorErr' => '',
          'personErr' => '',
          'bookErr' => ''
        ];

        if(empty($data['person'])){
          $data['personErr'] = 'Por favor elija una persona';
        }

        if(empty($data['book'])){
          $data['bookErr'] = 'Por favor elija un libro';
        }

        if(empty($data['author'])){
          $data['authorErr'] = 'Por favor seleccione el author del libro';
        }else{
          if(!$this->lendingModel->checkAuthorBook($data['author'], $data['book'])){
            $data['authorErr'] = 'Este autor no tiene ese libro';
          }
        }

        if(empty($data['personErr']) && empty($data['bookErr']) && empty($data['authorErr'])){
          if($this->lendingModel->register($data)){
            $this->lendingModel->updateQuantity($data);
            redirect('lendings/index/1');
          }else{
            die('something gone wrong');
          }
        }else{
          $this->view('lending/register', $data);
        }
      }else{
        $data = [
          'fetchPerson' => $fetchPerson,
          'fetchBook' => $fetchBook,
          'fetchAuthor' => $fetchAuthor,
          'author' => '',
          'authorErr' => '',
          'user' => '',
          'person' => '',
          'book' => '',
          'personErr' => '',
          'bookErr' => ''
        ];
        $this->view('lending/register', $data);
      }     
    }

    public function details($id){
      $details = $this->lendingModel->fetchLendingsDetails($id);
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'book' => $_POST['book'],
          'author' => $_POST['author']
        ];

        if($this->lendingModel->updateStats($id)){
          $this->lendingModel->returnQuantity($data['book'], $data['author']);
          redirect('lendings/index/2');
        }else{
          die('something when wrong');
        }

      }else{
        $data = [
          'details' => $details,
          'book' => '',
          'author' => ''
        ];
        $this->view('lending/details', $data);
      }
    }
  }