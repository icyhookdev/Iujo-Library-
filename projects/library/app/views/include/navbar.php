<div class="navbar-fixed">
  <ul id="register" class="dropdown-content mt-3">
    <li>
      <a class="black-text" href="<?php echo URLROOT;?>/persons/addperson">
        <i class="material-icons left">group_add</i>Personas
      </a>
    </li>
    <li>
      <a class="waves-effect waves-light black-text" href="<?php echo URLROOT;?>/persons/profile">
        <i class="material-icons left">mode_edit</i>Personas
      </a>
    </li>
  </ul>
  <ul id="user" class="dropdown-content mt-3">
    <?php if(!empty($_SESSION['userIdPerson'])) : ?>
    <li>
      <a href="<?php echo URLROOT;?>/users/profile" class="black-text">
        <i class="material-icons left">person</i>Perfil
      </a>
    </li>
    <?php endif; ?>
    <li>
      <a href="<?php echo URLROOT;?>/users/logout" class="black-text">
        <i class="fas fa-sign-out-alt left"></i>Salir
      </a>
    </li>
  </ul>
  <ul id="book" class="dropdown-content mt-3">
    <li>
      <a href="<?php echo URLROOT; ?>/books/index" class="black-text">
        <i class="fas fa-search left"></i>Libros
      </a>
    </li>
    <li>
      <a href="<?php echo URLROOT; ?>/books/add" class="black-text">
        <i class="material-icons">add_box</i>Libros
      </a>
    </li>
    <li>
      <a  href="<?php echo URLROOT; ?>/books/editorial" class="black-text">
        <i class="material-icons ">account_balance</i>Editorial
      </a>
    </li>
    <li>
      <a href="<?php echo URLROOT; ?>/books/author" class="black-text">
        <i class="material-icons">person</i>Autor
      </a>
    </li>
    <li>
      <a href="<?php echo URLROOT; ?>/books/genre" class="black-text">
      <i class="material-icons">donut_large</i>Genero
      </a>
    </li>
  </ul>
  <ul id="donations" class="dropdown-content mt-3">
    <li>
      <a href="<?php echo URLROOT; ?>/donations/index" class="black-text">
        <i class="fas fa-search left"></i>Donaciones
      </a>
    </li>
    <li>
      <a href="<?php echo URLROOT; ?>/donations/add" class="black-text">
        <i class="material-icons">add_box</i>Donacion
      </a>
    </li>
    <li>
      <a href="<?php echo URLROOT; ?>/donations/company" class="black-text">
        <i class="material-icons">add_box</i>Empresas
      </a>
    </li>
  </ul>
  <nav> 
    <div class="nav-wrapper grey darken-4 ">
      <a href="<?php echo URLROOT; ?>/homes/index" class="brand-logo" style="margin-left:25px;">Biblioteca<i class="material-icons right">import_contacts</i></a>
      <ul class="right hide-on-med-and-down">
        <?php if(isset($_SESSION['userId'])) : ?>
          <li>
            <a href="#!" class="dropdown-button waves-effect waves-light" data-activates="donations">
              <i class="material-icons left">card_giftcard</i>Donaciones<i class="material-icons right">arrow_drop_down</i>
            </a>
          </li>
          <li>
            <a href="#!" class="dropdown-button waves-effect waves-light" data-activates="book"><i class="fas fa-book left"></i>Libros<i class="material-icons right">arrow_drop_down</i>
            </a>
          </li>
          <li>
            <a class="waves-effect waves-light" href="<?php echo URLROOT;?>/lendings/index">
              <i class="fas fa-shopping-bag left"></i>Prestamos
            </a>
          </li>
          <li>
            <a class="waves-effect waves-light" href="<?php echo URLROOT;?>/users/register">
              <i class="material-icons left">person_outline</i>Usuarios
            </a>
          </li>
          <li>
            <a class="dropdown-button waves-effect waves-light" href="#!" data-activates="register"><i class="material-icons left">person</i>Personas<i class="material-icons right">arrow_drop_down</i></a>
          </li>         
          <li><li>
            <a class="dropdown-button waves-effect waves-light" href="#!" data-activates="user">
            <i class="material-icons left">account_circle</i><?php echo $_SESSION['userName']; ?>
            <i class="material-icons right">apps</i>
            </a>
        <?php else : ?>
          <li class="active">
            <a class="waves-effect waves-light" href="<?php echo URLROOT;?>/users/login">
              <i class="material-icons left">person</i>Iniciar Sesion
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</div>
