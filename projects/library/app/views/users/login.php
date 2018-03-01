<?php require APPROOT . '/views/include/header.php';?>
<div class="loginBook">
    <div class="row ">
      <div class="col s6 offset-s3 mt-3">
        <div class="card white z-depth-5">
          <div class="card-content">
            <h3>Iniciar Sesion</h3>
            <p class="mb-2">Por favor ingrese sus credenciales correctamente.</p>
            <div class="row">
              <form action="<?php echo URLROOT; ?>/users/login" method="POST" class="col s12">
                <div class="input-field">
                  <i class="material-icons prefix">person</i>
                  <input type="text" name="username">
                  <label for="username" >Usuario</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['usernameErr']; ?></div>
                </div>
                <div class="input-field ">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" name="password">
                  <label for="password">Contrasena</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['passwordErr']; ?></div>
                </div>
                <div class="input-field">
                  <button type="submit" name"submit" class="z-depth-5 btn-large grey darken-4 waves-effect waves-light"><i class="material-icons left">person</i>Iniciar Sesion</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>