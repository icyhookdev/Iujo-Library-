<?php require APPROOT . '/views/include/header.php';?>
<div class="company">
  <div class="container">
    <div class="row">
      <div class="col s8 offset-s2">
        <div class="card mt-3 grey darken-4 z-depth-5">          
          <div class="card-content">
            <h2 class="center-align">Registro de Empresas</h2>
            <form action="<?php echo URLROOT;?>/donations/company" method="POST">
              <div class="input-field">
                <p class="psize">Nombare de la empresa</p>
                <i class="material-icons prefix">business</i>
                <input type="text" name="name">
                <div class="red-text psize"><?php echo $data['nameErr']; ?></div>
              </div>
              <div class="input-field">
                <p class="psize">Description de la empresa</p>
                <i class="material-icons prefix">mode_edit</i>
                <textarea name="description" id="reason" class="materialize-textarea"></textarea>
                <div class="red-text psize"><?php echo $data['descriptionErr']; ?></div>
              </div>  
              <div class="input-field">
                <button class="btn-large blue waves-effect waves-light z-depth-5 right" type="submit" name="submit"><i class="material-icons left">add_circle</i>Registrar</button>
              </div>        
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed-action-btn">
    <a href="<?php echo URLROOT; ?>/donations/index" class="btn-large btn-floating green waves-effect waves-light">
      <i class="material-icons">keyboard_arrow_left</i>
    </a> 
  </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>