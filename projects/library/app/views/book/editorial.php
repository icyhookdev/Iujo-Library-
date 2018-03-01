<?php require APPROOT . '/views/include/header.php';?>
<div class="adt blue darken-4">
  <div class="row">
    <div class="col s12">
      <h2 class="center-align white-text">Agregue las Editoriales que no se encuentren Registrados</h2>
      <div class="row">
        <div class="col s6 offset-s3">
          <div class="card z-depth-5">
            <div class="card-content">
              <form action="<?php echo URLROOT; ?>/books/editorial" method="POST">
                <div class="input-field">
                  <i class="fas fa-university prefix"></i>
                  <input type="text" name="name">
                  <label for="name">Nombre de la editorial</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['nameErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">call</i>
                  <input type="number" name="phone">
                  <label for="phone">Telefono</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['phoneErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">add_location</i>
                  <textarea name="location" id="location" class="materialize-textarea"></textarea>
                  <label for="location">Direccion de la editorial</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['locationErr']; ?></div>
                </div>
                <div class="input-field">
                  <button class="btn-large btn-floating right green waves-effect waves-light"><i class="material-icons">add_circle</i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> 
      <div class="fixed-action-btn">
        <a href="<?php echo URLROOT; ?>/books/add" class="btn-large btn-floating green waves-effect waves-light">
          <i class="material-icons">keyboard_arrow_left</i>
        </a> 
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>