<?php require APPROOT . '/views/include/header.php';?>
<div class="addp">
    <div class="row ">
      <div class="col s6 offset-s3 mt-3">
        <div class="card white z-depth-5">
          <div class="card-content">
            <h3>Agregar personas</h3>
            <p class="mb-2">Agregue personas para registro de usuarios o alquiler de libros.</p>
            <div class="row">
              <form action="<?php echo URLROOT; ?>/persons/addperson" method="POST" class="col s12">
                <div class="input-field">
                  <i class="material-icons prefix">person</i>
                  <input type="text" name="name" >
                  <label for="name">Nombre</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['nameErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">person_outline</i>
                  <input type="text" name="lastName">
                  <label for="lastName">Apellido</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['lastNameErr']; ?></div>              
                </div>
                <div class="input-field ">
                  <i class="material-icons prefix">assignment_ind</i>
                  <input type="number" name="ci">
                  <label for="ci">Cedula de Identidad</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['ciErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">add_location</i>
                  <textarea name="location" id="location" class="materialize-textarea"></textarea>
                  <label for="location">Direccion de la persona</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['locationErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">accessibility</i>
                  <select name="gender">
                    <?php while($row = pg_fetch_object($data['dbGender'])) : ?>
                      <option value="<?php echo $row->id_gender; ?>"><?php echo $row->gender_n; ?></option>
                    <?php endwhile; ?>
                  </select>
                  <label class="green-text">Genero o Sexo</label>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">date_range</i>
                  <input type="date" name="birthdate">
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['birthdateErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">phone</i>
                  <input type="number" name="phone">
                  <label for="phone">Telefono</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['phoneErr']; ?></div>
                </div>
                <div class="input-field">
                  <i class="material-icons prefix">account_balance</i>
                  <select name="core">
                    <?php while($row = pg_fetch_object($data['getCore'])) : ?>
                      <option value="<?php echo $row->id_core; ?>"><?php echo $row->core_n; ?></option>
                    <?php endwhile; ?>                        
                  </select>
                  <label class="green-text" >Centro de estudios</label>
                </div>
                <div class="input-field">
                  <button type="submit" name"submit" class="z-depth-5 btn-large grey darken-4 waves-effect waves-light"><i class="material-icons left">add</i>Agregar</button>
                </div>
              </form>
            </div>
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
      </ul>
    </div> 
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>