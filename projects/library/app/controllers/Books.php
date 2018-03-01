<?php 
  class Books extends Controller{
    public function __construct() {
      logInSession($_SESSION['userId']);
      $this->bookModel = $this->model('Book');
    }  
 
    public function index(){
      $book = $this->bookModel->fetchBook();
      $author = $this->bookModel->fetchSelects('author');

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $search = $this->bookModel->searchBook(ucwords(strtolower($_POST['search'])));

        $data = [
          'book' => $book,
          'author' => $author,
          'search' => trim(ucwords(strtolower($_POST['search']))),
          'searchFetch' => $search,
          'searchErr' => ''
        ];

        if(empty($data['search'])){
          $data['searchErr'] = 'Por favor ingrese el nombre del libro';
        }else{
          if(!$this->bookModel->checkForIt($data['search'],'book', 'book_n')){
            $data['searchErr'] = 'Este libro no se encuentra registrado';
          }
        }

        if(empty($data['searchErr'])){
          $this->view('book/index', $data);
        }else{
          $this->view('book/index', $data);
        }
      }else{
        $data = [
          'searchFetch' => '',
          'author' => $author,
          'book' => $book,
          'search' => '',
          'searchErr' => ''
        ];
        $this->view('book/index', $data);
      }
      
    }

    public function add(){

      $authorF = $this->bookModel->fetchSelects('author');
      $genreF = $this->bookModel->fetchSelects('genre');
      $editorialF = $this->bookModel->fetchSelects('editorial');      

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'authorF' => $authorF,
          'genreF' => $genreF,
          'editorialF' => $editorialF,
          'name' => trim(ucwords(strtolower($_POST['name']))),
          'year' => trim($_POST['year']),
          'author' => trim($_POST['author']),
          'genre' => trim($_POST['genre']),
          'editorial' => trim($_POST['editorial']),
          'quantity' => trim($_POST['quantity']),
          'nameErr' => '',
          'yearErr' => '',
          'authorErr' => '',
          'genreErr' => '',
          'editorialErr' => '',
          'quantityErr' => ''
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese el nombre del libro';
        }

        if(empty($data['year'])){
          $data['yearErr'] = 'Por favor ingrese el ano del libro';
        }else{
          if($data['year'] > date('Y-m-d')){
            $data['yearErr'] = 'Aun no hemos llegado a esa fecha';
          }
        }

        if(empty($data['author'])){
          $data['authorErr'] = 'Por favor seleccione un autor';
        }

        if(empty($data['genre'])){
          $data['genreErr'] = 'Por favor seleccione un genero';
        }

        if(empty($data['editorial'])){
          $data['editorialErr'] = 'Por favor seleccione una editorial';
        }

        if(empty($data['quantity'])){
          $data['quantityErr'] = 'Por favor seleccione cuantos quiere agregar';
        }

        if(empty($data['nameErr']) && empty($data['yearErr']) && empty($data['authorErr']) && empty($data['genreErr']) && empty($data['editorialErr']) && empty($data['quantityErr'])){
          if($this->bookModel->checkForUpdate($data['name'], $data['author'])){
            if($this->bookModel->updateQuantity($data)){
              redirect('books/add/2');
            }else{
              die('something gone wrong');
            }
          }else{
            if($this->bookModel->add($data)){
              redirect('books/add/1');
            }else{
              die('something gone wrong');
            }
          }
          
        }else{
          $this->view('book/add', $data);
        }

      }else{
        $data = [
          'authorF' => $authorF,
          'genreF' => $genreF,
          'editorialF' => $editorialF,
          'name' => '',
          'year' => '',
          'author' => '',
          'genre' => '',
          'editorial' => '',
          'nameErr' => '',
          'yearErr' => '',
          'authorErr' => '',
          'genreErr' => '',
          'editorialErr' => '',
          'quantity' => '',
          'quantityErr' => ''

        ];
        $this->view('book/add', $data);
      }
      
    }

    public function author(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim(ucwords(strtolower($_POST['name']))),
          'nameErr' => ''
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese el nombre del autor';
        }else{
          if($this->bookModel->checkForIt($data['name'], 'author', 'author_n')){
            $data['nameErr'] = 'Este autor ya existe';
          }
        }
       
        if(empty($data['nameErr'])){
          if($this->bookModel->addGA($data, 'author', 'author_n')){
            redirect('books/add');
          }else{
            die('error');
          }
          redirect('books/add/1');
        }else{
          $this->view('book/author', $data);
        }
      }else{
        $data = [
          'name' => '',
          'nameErr' => ''
        ];
        $this->view('book/author', $data);
      }     
    }

    public function editorial(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim(ucwords(strtolower($_POST['name']))),
          'phone' => trim($_POST['phone']),
          'location' => trim($_POST['location']),
          'nameErr' => '',
          'phoneErr' => '',
          'locationErr' => ''
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese el nombre de la editorial';
        }

        if(empty($data['phone'])){
          $data['phoneErr'] = 'Por favor ingresa un numero telefonico';
        }else{
          if(strlen($data['phone']) != 11){
            $data['phoneErr'] = 'Numero Invalido por favor ingrese otro';
          }
        }

        if(empty($data['location'])){
          $data['locationErr'] = 'Por favor ingrese una direccion';
        }
      
        if(empty($data['nameErr']) && empty($data['phoneErr']) && empty($data['locationErr'])){
          if($this->bookModel->addEditorial($data)){
            redirect('books/add/1');
          }else{
            die('error');
          }
        }else{
          $this->view('book/editorial', $data);
        }
      }else{
        $data = [
          'name' => '',
          'phone' => '',
          'location' => '',
          'phoneErr' => '',
          'locationErr' => '',
          'nameErr' => ''
        ];
        $this->view('book/editorial', $data);
      }     
    }


    public function genre(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim(ucwords(strtolower($_POST['name']))),
          'nameErr' => ''
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese el nombre del Genero';
        }else{
          if($this->bookModel->checkForIt($data['name'], 'genre', 'genre_n')){
            $data['nameErr'] = 'Este genero ya existe';
          }
        }
       
        if(empty($data['nameErr'])){
          if($this->bookModel->addGA($data, 'genre', 'genre_n')){
            redirect('books/add/1');
          }else{
            die('error');
          }
        }else{
          $this->view('book/genre', $data);
        }
      }else{
        $data = [
          'name' => '',
          'nameErr' => ''
        ];
        $this->view('book/genre', $data);
      }     
    }

    public function details($id){

      $singleBook = $this->bookModel->fetchSingleBook($id);
      $authorF = $this->bookModel->fetchSelects('author');
      $genreF = $this->bookModel->fetchSelects('genre');
      $editorialF = $this->bookModel->fetchSelects('editorial');

      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'authorF' => $authorF,
          'genreF' => $genreF,
          'editorialF' => $editorialF,
          'singleBook' => $singleBook,
          'name' => trim(ucwords(strtolower($_POST['name']))),
          'year' => trim($_POST['year']),
          'author' => trim($_POST['author']),
          'genre' => trim($_POST['genre']),
          'editorial' => trim($_POST['editorial']),
          'quantity' => $_POST['quantity'], 
          'nameErr' => '',
          'yearErr' => '' 
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese el nombre del libro';
        }

        if(empty($data['year'])){
          $data['yearErr'] = 'Por favor ingrese el ano del libro';
        }

        if(empty($data['nameErr']) && empty($data['yearErr'])){
          if($this->bookModel->checkForUpdate($data['name'], $data['author'])){
            if($this->bookModel->updateQuantity($data)){
              $this->bookModel->deleteBook($id);
              redirect('books/index/2');
            }else{
              die('something gone wrong');
            }
          }else{
            if($this->bookModel->updateBook($data)){
              redirect('books/index/2');
            }else{
              die('something gone wrong');
            }
          }

        }else{
          $this->view('book/details', $data);
        }

      }else{
        $data = [
          'id' => $id,
          'authorF' => $authorF,
          'genreF' => $genreF,
          'editorialF' => $editorialF,
          'singleBook' => $singleBook,
          'name' => '',
          'quantity' => '',
          'year' => '',
          'author' => '',
          'genre' => '',
          'editorial' => '',
          'nameErr' => '',
          'yearErr' => ''
        ];
        $this->view('book/details', $data);
      }     
    }

    public function delBook($id){
      if($this->bookModel->deleteBook($id)){
        redirect('books/index/3');
      }else{
        die('something gone wrong');
      }
    }

    public function authors($id){
      $books = $this->bookModel->selectByAuthor($id);
      $author = $this->bookModel->authorName($id);
      $data = [
        'book' => $books,
        'author' => $author  
      ];
      $this->view('book/authors', $data);
    }
  }