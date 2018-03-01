<?php 
  class Persons extends Controller{
    public function __construct() {   
      logInSession($_SESSION['userId']);
      $this->personModel = $this->model('Person');
      $this->userModel = $this->model('User');
      if($_GET['url'] === 'persons/edit' || $_GET['url'] === 'persons/edit/') {
        redirect('persons/profile');
      }
    }
    public function index(){
      redirect('');
    }
    public function addPerson(){
      $getGender= $this->personModel->fetchGender();
      $getCore = $this->personModel->fetchCore();

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [
          'name' => trim($_POST['name']),
          'lastName' => trim($_POST['lastName']),
          'ci' => trim($_POST['ci']),
          'location' => trim($_POST['location']),
          'gender' => trim($_POST['gender']),
          'birthdate' => trim($_POST['birthdate']),
          'phone' => trim($_POST['phone']),
          'core' => trim($_POST['core']),
          'dbGender' => $getGender,
          'getCore' => $getCore,
          'nameErr' => '',
          'lastNameErr' => '',
          'ciErr' => '',
          'locationErr' => '',
          'birthdateErr' => '',
          'phoneErr' => ''         
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese un nombre';
        }else{
          if(strlen($data['name']) >= 30){
            $data['nameErr'] = 'Este campo no puede tener mas de 30 characteres';
          }
        }

        if(empty($data['lastName'])){
          $data['lastNameErr'] = 'Por favor ingrese un apellido';
        }else{
          if(strlen($data['lastName']) >= 30){
            $data['lastNameErr'] = 'Este campo no puede tener mas de 30 characteres';
          }
        }

        if(empty($data['ci'])){
          $data['ciErr'] = 'Por favor ingrese su cedula';
        }else{
          if(strlen($data['ci']) >= 10){
            $data['ciErr'] = 'La poblacion Venezolana aun no se estima en los 100 M';
          }elseif($this->personModel->findPersonByCi($data['ci'])){
            $data['ciErr'] = 'Esta cedula ya ha sido usada';
          }
        }

        if(empty($data['location'])){
          $data['locationErr'] = 'Por favor ingrese una direccion';
        }

        if(empty($data['birthdate'])){
          $data['birthdateErr'] = 'Por favor ingrese su fecha de nacimiento';
        }else{
          if(strlen($data['birthdate']) != 10){
            $data['birthdateErr'] = 'Fecha Invalida ingrese otra';
          }elseif($data['birthdate'] > date('Y-m-d')){
            $data['birthdateErr'] = 'Aun no hemos llegado a esa fecha';
          }
        }

        if(empty($data['phone'])){
          $data['phoneErr'] = 'Por favor ingrese un numero telefonico';
        }else{
          if(strlen($data['phone']) != 11){
            $data['phoneErr'] = 'Numero telefonico invalido ingrese otro';
          }
        }

        if(empty($data['nameErr']) && empty($data['lastNameErr']) && empty($data['ciErr']) && empty($data['locationErr']) && empty($data['birthdateErr']) && empty($data['phoneErr'])){
          if($this->personModel->addPerson($data)){
            redirect('1');
          }else{
            die('something gone wrong');
          }
         
        }else{
          $this->view('person/addperson', $data);
        }
      }else{
        $data = [
          'dbGender' => $getGender,
          'getCore' => $getCore,
          'name' => '',
          'lastName' => '',
          'ci' => '',
          'location' => '',
          'gender' => '',
          'birthdate' => '',
          'phone' => '',
          'core' => '',
          'nameErr' => '',
          'lastNameErr' => '',
          'ciErr' => '',
          'locationErr' => '',
          'birthdateErr' => '',
          'phoneErr' => ''     
        ];

        $this->view('person/addperson', $data);
      }
      
    }

    public function profile(){
      $personUserData = $this->personModel->getPersonUserData();
       
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $search = $this->personModel->getPersonId($_POST['searchPersonData']);  
        $data = [
          'ci' => trim($_POST['searchPersonData']),
          'personUsersData' => $personUserData,
          'ciErr' => '',
          'searchResult' => $search
        ];
        
        if(empty($data['ci'])){
          $data['ciErr'] = 'Por favor ingrese la cedula de la persona';
        }else{
          if(!$this->personModel->findPersonByCi($data['ci'])){
            $data['ciErr'] = 'Esta cedual no se encuentra registrada en el sistema';
          }
        }
           
        if(empty($data['ciErr'])){      
          $this->view('person/profile', $data);   
        }else{
          $this->view('person/profile', $data);
        }
      }else{
        $data = [       
          'personUsersData' => $personUserData,
          'ci' => '',
          'ciErr' => '',
          'searchResult' => ''
        ];
        $this->view('person/profile', $data);
      }     
    } 

    public function edit($user){
      $getCore = $this->personModel->fetchCore();
      $getProfileData = $this->personModel->getProfileData($user);
      $getPersonCore = $this->personModel->getCore($user);

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'personId' => $user,
          'name' => trim($_POST['name']),
          'lastname' => trim($_POST['lastname']),
          'phone' => trim($_POST['phone']),
          'local' => trim($_POST['local']),
          'core' => trim($_POST['core']),
          'getCore' => $getCore,
          'getProfile' => $getProfileData,
          'getPersonCore' => $getPersonCore,
          'nameErr' => '',
          'lastnameErr' => '',
          'phoneErr' => '',
          'localErr'=> '',
          'coreErr' => ''
        ];

        if(empty($data['name'])){
          $data['nameErr'] = 'Por favor ingrese un nombre';
        }else{
          if(strlen($data['name']) >= 30){
            $data['nameErr'] = 'Este campo no puede tener mas de 30 characteres';
          }
        }

        if(empty($data['lastname'])){
          $data['lastnameErr'] = 'Por favor ingrese un apellido';
        }else{
          if(strlen($data['lastname']) >= 30){
            $data['lastnameErr'] = 'Este campo no puede tener mas de 30 characteres';
          }
        }

        if(empty($data['local'])){
          $data['localErr'] = 'Por favor ingrese una direccion';
        }

        if(empty($data['phone'])){
          $data['phoneErr'] = 'Por favor ingrese un numero telefonico';
        }else{
          if(strlen($data['phone']) != 11){
            $data['phoneErr'] = 'Numero telefonico invalido ingrese otro';
          }
        }

        if(empty($data['nameErr']) && empty($data['lastnameErr']) && empty($data['localErr']) && empty($data['phoneErr'])){
          if($this->personModel->updatePerson($data)){
            redirect('persons/profile/2');
          }else{
            die('DB ERROR');
          }
        }else{
          $this->view('person/edit', $data);
        }
      }else{
        $data = [
          'personId' => $user,
          'getCore' => $getCore,
          'getProfile' => $getProfileData,
          'getPersonCore' => $getPersonCore,
          'name' => '',
          'lastname' => '',
          'phone' => '',
          'local' => '',
          'core' => '',
          'nameErr' => '',
          'lastnameErr' => '',
          'phoneErr' => '',
          'localErr' => '',
          'coreErr' => ''
        ];
        $this->view('person/edit', $data);
      }     
    }

    public function deletePerson($id){
      if($id == $_SESSION['userIdPerson']){
        if($this->personModel->deletePerson($id)){
          //$this->userModel->deleteAccount($_SESSION['userId']);
          logout();
        }else{
          die('something gone wrong');
        }
      }else{
        if($this->personModel->deletePerson($id)){
          redirect('persons/profile/3');
        }else{
          die('something gone wrong');
        }
      }
      
    }
  }