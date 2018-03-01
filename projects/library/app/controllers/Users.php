<?php 
  
  class Users extends Controller{
    
    public function __construct() {
      $this->userModel = $this->model('User');
      $this->personModel = $this->model('Person');
    }

    public function index(){
      redirect('homes/index');
    }
    
    public function register(){
      if(!$this->isLogIn()){
        redirect('users/login');
      }

      $getPerson = $this->personModel->getPerson();

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'username' => trim($_POST['username']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'person' => trim($_POST['person']),
          'getPerson' => $getPerson,
          'personErr' => '',
          'usernameErr' => '',
          'emailErr' => '',
          'passwordErr' => '',
          'confirm_passwordErr' => ''   
        ]; 

        if(empty($data['username'])){
          $data['usernameErr'] = 'Por favor ingrese un usuario';
        }else{
          if(strlen($data['username']) < 5){
            $data['usernameErr'] = 'El usuario debe tener 5 characteres minimo';
          }else{
            if($this->userModel->findUser($data['username'])){
              $data['usernameErr'] = 'Este usuario ya existe por favor escoge otro';
            }
          }         
        }

        if(empty($data['email'])){
          $data['emailErr'] = 'Por favor ingrese un email';
        }else{
          if($this->userModel->findUserEmail($data['email'])){
            $data['emailErr'] = 'Este email ya existe por favor escoga otro';
          }
        }

        if(empty($data['password'])){
          $data['passwordErr'] = 'Por favor ingrese una contrasena';
        }else{
          if(strlen($data['password']) < 7 || strlen($data['password']) > 32 ){
            $data['passwordErr'] = 'La contrasena debe tener de 7 o 32 characteres';
          }
        }

        if(empty($data['confirm_password'])){
          $data['confirm_passwordErr'] = 'Por favor reingrese su contrasena';
        }else{
          if($data['password'] != $data['confirm_password']){
            $data['confirm_passwordErr'] = 'Las contrasenas deben ser iguales';
          }
        }

        
        if(empty($data['person'])){   
          $data['personErr'] = 'Por favor Ingrese la cedula de la persona';
        }else{
          if(strlen($data['person']) < 6 || strlen($data['person']) > 9){
            $data['personErr'] = 'las cedulas menor a 6 o mayor a 9 digitos sera rechazadas';
          }else{
            if($this->personModel->findPersonByCi($data['person'])){
              $getId = $this->personModel->getPersonId($data['person']);
              $data['person'] = $getId['id_person'];
              if($this->userModel->checkUserAccount($data['person'])){
                $data['personErr'] = 'esta cedula ya se encuentra vinculada a un usuario';
              }
            }else{
              $data['personErr'] = 'Esta cedula no pertenece a ninguna persona en el sistema';
            }
          }          
        }

        if(empty($data['usernameErr']) && empty($data['emailErr']) && empty($data['passwordErr']) && empty($data['confirm_passwordErr']) && empty($data['personErr'])){

          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          if($this->userModel->register($data)){
            redirect('homes/index/1');
          }else{
            die('opp! Unknown err 404');
          }

        }else{
          $this->view('users/register', $data);
        } 
      }else{
        $data = [
          'username' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'person' => '',
          'getPerson' => $getPerson,
          'personErr' => '',
          'usernameErr' => '',
          'emailErr' => '',
          'passwordErr' => '',
          'confirm_passwordErr' => ''
        ];
        $this->view('users/register', $data);
      }
    }

    public function login(){
      if($this->isLogIn()){
        redirect('homes/index');
      }
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'usernameErr' => '',
          'passwordErr' => '',
        ];

        if(empty($data['username'])){
          $data['usernameErr'] = 'Por favor ingrese su Usuario';
        }else{
          if(!$this->userModel->findUser($data['username'])){
            $data['usernameErr'] = 'Este usuario no existe';
            $this->view('users/login', $data);
          }
        }

        if(empty($data['password'])){
          $data['passwordErr'] = 'Por favor ingrese su contrasena';
        }

        if(empty($data['usernameErr']) && empty($data['passwordErr'])){
          $logUser = $this->userModel->login($data['username'], $data['password']);
          if($logUser){
            $this->createUserSession($logUser);
          }else{
            $data['passwordErr'] = 'contrasena Incorrecta';
            $this->view('users/login', $data);
          }   
        }else{
          $this->view('users/login', $data);
        }
      }else{
        $data =[
          'username' => '',
          'password' => '',
          'usernameErr' => '',
          'passwordErr' => '',
        ];
        $this->view('users/login', $data);
      }  
    }

    public function createUserSession($user){
      $_SESSION['userId'] = $user['id_user'];
      $_SESSION['userName'] = $user['username'];
      $_SESSION['userEmail'] = $user['email'];
      $_SESSION['userIdPerson'] = $user['id_person'];
      redirect('');
    }

    public function profile(){
      if(empty($_SESSION['userIdPerson'])){
        redirect('');
      }
      $profileData = $this->userModel->getProfile($_SESSION['userIdPerson']);
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data = [
          'username' => $profileData['username'],
          'email' => $profileData['email'],
          'ci' => $profileData['ci'],
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'emailErr' => '',
          'passwordErr' => ''
        ];

        if(empty($data['email'])){
          $data['emailErr'] = 'Por favor ingrese un Correo';
        }else{
          if($this->userModel->findUserEmail($data['email'])){
            $data['emailErr'] = 'Este email ya existe por favor escoga otro';
          }
        }

        if(empty($data['password'])){
          $data['passwordErr'] = 'Para actualizar los cambios por favor ingrese su contrasena';
        }else{
          if(!$this->userModel->login($_SESSION['userName'], $data['password'])){
            $data['passwordErr'] = 'Contrasena invalida';
          }
        }

        if(empty($data['emailErr']) && empty($data['passwordErr'])){
          $this->userModel->updateProfile($data['email'], $data['username']);
          redirect('users/profile/2');
        }else{
          $this->view('users/profile', $data);
        }
      }else{
        $data = [
          'username' => $profileData['username'],
          'email' => $profileData['email'],
          'ci' => $profileData['ci'],
          'emailErr' => '',
          'passwordErr' => ''
        ];
        $this->view('users/profile', $data);
      }     
    }

    public function deleteAccount(){  
      $this->userModel->deleteAccount($_SESSION['userId']);
      $this->logout();
    }

    public function logout(){
      logout();
    }

    public function isLogIn(){
      if(isset($_SESSION['userId'])){
        return true;
      }else{
        return false;
      }
    }

  }