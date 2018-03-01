<?php require APPROOT . '/views/include/header.php';?>
<?php message($_GET['url']); ?>
<div class="profile">
  <div class="row ">
      <div class="col s6 offset-s3 mt-3">
        <div class="card white z-depth-5">
          <div class="card-content">
            <h3>Actualizar Informacion</h3>
            <p class="mb-2">Por razones de seguridad el Usuario y la Cedula no pueden ser modificadas</p>
            <div class="row">
              <form action="<?php echo URLROOT; ?>/users/profile" method="POST" class="col s12">
                <div class="row">                       
                  <div class="input-field col s6">
                    <i class="material-icons prefix">person</i>
                    <input disabled type="text" name="username" value="<?php echo $data['username'] ?>">
                    <label for="username">Usuario</label>
                    <!-- <div style="margin-left: 50px;" class="red-text"><?php echo $data['usernameErr']; ?></div> -->
                  </div>
                  <div class="input-field col s6">
                    <i class="material-icons prefix">mail</i>
                    <input type="email" name="email" value="<?php echo $data['email'] ?>">
                    <label for="email">Email</label>
                    <div style="margin-left: 50px;" class="red-text"><?php echo $data['emailErr']; ?></div>              
                  </div>
                </div> 
                <div class="row">               
                  <div class="input-field col s6">
                    <i class="material-icons prefix">contacts</i>
                    <input disabled type="number" value="<?php echo $data['ci'] ?>" name="ci">
                    <label for="ci">Cedula</label>
                    <!-- <div style="margin-left: 50px;" class="red-text"><?php echo $data['personErr']; ?></div> -->
                  </div>               
                </div>    
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password">
                    <label for="password">Contrasena</label>
                    <div style="margin-left: 50px;" class="red-text"><?php echo $data['passwordErr']; ?></div>
                  </div>
                </div>                       
                <div class="input-field left ">
                  <button type="submit" name"update" class="z-depth-5 btn-large green  waves-effect waves-dark"><i class="material-icons left">filter_none</i>Actualizar</button>
                </div>
                <div class="input-field right">
                  <a href="<?php echo URLROOT;?>/users/deleteAccount"class="z-depth-5 btn-large red  waves-effect waves-dark"><i class="material-icons left">delete</i>Eliminar Cuenta</a>
                </div>               
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>