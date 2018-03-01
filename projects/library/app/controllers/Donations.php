<?php
  class Donations extends Controller{
    public function __construct() {
      logInSession($_SESSION['userId']);
      $this->donationModel = $this->model('Donation');
      $this->bookModel = $this->model('Book');
    }

    public function index(){
      $person = $this->donationModel->fetchPersonDonations();
      $company = $this->donationModel->fetchCompanyDonations();

      $data = [
        'person' => $person,
        'company' => $company
      ];
      $this->view('donation/index', $data);
    }

    public function add(){
      $company = $this->bookModel->fetchSelects('company');
      $person = $this->bookModel->fetchSelects('person');
      $entity = $this->bookModel->fetchSelects('entity');
      $book = $this->bookModel->fetchSelects('book');

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'entityf' => $entity,
          'companyf' => $company,
          'personf' => $person,
          'bookf' => $book,
          'book' => trim($_POST['book']),
          'entity' => trim($_POST['entity']),
          'company' => trim($_POST['company']),
          'person' => trim($_POST['person']),
          'reason' => trim($_POST['reason']),
          'entityErr' => '',
          'bookErr' => '',
          'companyErr' => '',
          'personErr' => '',
          'reasonErr' => '',         
        ];

        if(empty($data['entity'])){
          $data['entityErr'] = 'Por favor escoja que tipo de persona esta realizando la donacion';
        }

        if(empty($data['company'])){
          $data['companyErr'] = 'Por favor seleccione la empresa donante';
        }
        if(empty($data['person'])){
          $data['personErr'] = 'Por favor seleccione la persona donante';
        }

        if(!empty($data['company']) && $data['entity'] == 1){
          $data['companyErr'] = 'debe escoger la opcion seleccionada en entidad';
        }

        if(!empty($data['person']) && $data['entity'] == 2){
          $data['personErr'] = 'debe escoger la opcion seleccionada en entidad';
        }

        if(empty($data['book'])){
          $data['bookErr'] = 'Por favor ingrese un libro';
        }

        if(empty($data['reason'])){
          $data['reasonErr'] = 'Por fovar de una razon por que esta donando';
        }
      
        if(empty($data['company']) && empty($data['personErr']) && empty($data['reasonErr']) && empty($data['bookErr'])){
          $data['companyErr'] = '';
          if($this->donationModel->addDonation($data)){
            redirect('donations/index/1');
          }else{
            die('somethig gone wrong');
          }
        }elseif(empty($data['person']) && empty($data['companyErr']) && empty($data['reasonErr']) && empty($data['bookErr'])){
          $data['personErr'] = '';
          if($this->donationModel->addDonation($data)){
            redirect('donations/index');
          }else{
            die('somethig gone wrong');
          }
        }else{
          $this->view('donation/add', $data);
        }
      }else{
        $data = [
          'entityf' => $entity,
          'companyf' => $company,
          'personf' => $person,
          'bookf' => $book,
          'book' => '',
          'bookErr' => '',
          'entity' => '',
          'company' => '',
          'person' => '',
          'reason' => '',
          'entityErr' => '',
          'companyErr' => '',
          'personErr' => '',
          'reasonErr' => '',    
        ];
        $this->view('donation/add', $data);
      }
     
    }

    public function company(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim(ucwords(strtolower($_POST['name']))),
          'description' => trim($_POST['description']),
          'nameErr' => '',
          'descriptionErr' => ''
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese el nombre de la empresa';
        }else{
          if(strlen($data['name']) > 60){
            $data['nameErr'] = 'Este nombre es muy largo por favor simplifiquelo';
          }
        }

        if(empty($data['description'])){
          $data['descriptionErr'] = 'Por favor ingrese una descripcion de la empresa';
        }

        if(empty($data['nameErr']) && empty($data['descriptionErr'])){
          if($this->donationModel->addCompany($data)){
            redirect('donations/add');
          }else{
            die('something gone wrong');
          }
        }else{
          $this->view('donation/company', $data);
        }
      }else{
        $data = [
          'name' => '',
          'description' => '',
          'nameErr' => '',
          'descriptionErr' => ''
        ];
        $this->view('donation/company', $data);
      }     
    }
  }