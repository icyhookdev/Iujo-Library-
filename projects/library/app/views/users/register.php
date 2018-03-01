<?php require APPROOT . '/views/include/header.php';?>
<div class="registerBook">
    <div class="row ">
      <div class="col s6 offset-s3 mt-3">
        <div class="card white z-depth-5">
          <div class="card-content">
            <h3>Registrar Usuarios</h3>
            <p class="mb-2">Por favor asocie usuarios previamente agregados en personas.</p>
            <div class="row">
              <form action="<?php echo URLROOT; ?>/users/register" method="POST" class="col s12">
                <div class="input-field">
                  <i class="material-icons prefix">person</i>
                  <input type="text" name="username">
                  <label for="username">Usuario</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['usernameErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">mail</i>
                  <input type="email" name="email">
                  <label for="email">Email</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['emailErr']; ?></div>              
                </div>
                <div class="input-field ">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" name="password">
                  <label for="password">Contrasena</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['passwordErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" name="confirm_password">
                  <label for="confirm_password">Confirmar contrasena</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['confirm_passwordErr']; ?></div>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix">contacts</i>
                  <input type="number" name="person">
                  <label for="person">Cedula</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['personErr']; ?></div>
                </div>
                <!-- <div class="input-field col s6">
                  <input type="text" disabled>
                </div>                                            -->
                </div> 
               <div class="input-field">
                  <button type="submit" name"submit" class="z-depth-5 btn-large grey darken-4 waves-effect waves-light"><i class="material-icons left">person_add</i>Registrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="fixed-action-btn vertical">
      <a class="btn-floating btn-large blue">
        <i class="large material-icons">dashboard</i>
      </a>
      <ul>
        <li>
          <a href="<?php echo URLROOT; ?>/persons/profile"class="btn-floating blue">
          <i class="material-icons">mode_edit</i>   
          </a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/users/profile" class="btn-floating green">
            <i class="material-icons">person_outline</i> 
          </a>
        </li>
      </ul>
    </div> 
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>

