<?php require APPROOT . '/views/include/header.php';?>
<div class="edit">
  <div class="row">
    <div class="col s12">
      <div class="card z-depth-5">
      <a href="<?php echo URLROOT; ?>/persons/deletePerson/<?php echo $data['personId']; ?>" class="btn-large red waves-effect waves-light right"><i class="material-icons left">delete</i>del</a>
        <div class="card-content">
          <h2>Editar Datos Personales</h2>
          <form action="<?php echo URLROOT; ?>/persons/edit/<?php echo $data['personId']; ?>" method="POST">
            <div class="row">
              <div class="col s4">
                <div class="input-field">
                  <i class="material-icons prefix">person</i>
                  <input type="text" name="name" value="<?php echo empty($_POST['name']) ? $data['getProfile']['person_n'] : $data['name'] ; ?>">
                  <label for="name">Nombre</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['nameErr']; ?></div>
                </div>              
              </div>
              <div class="col s4">
                <div class="input-field">
                  <i class="material-icons prefix">person_outline</i>
                  <input type="text" name="lastname" value="<?php echo empty($_POST['lastname']) ? $data['getProfile']['person_ln'] : $data['lastname'] ; ?>">
                  <label for="lastname">Apellido</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['lastnameErr']; ?></div>
                </div>               
              </div>
              <div class="col s4">
                <div class="input-field">
                  <i class="material-icons prefix">contacts</i>
                  <input type="number" disabled name="ci" value="<?php echo $data['getProfile']['ci']; ?>">
                  <label for="ci">Cedula</label>
                </div>               
              </div>
            </div>
            <div class="row">
              <div class="col s4 mt-2">
                <div class="input-field">
                  <i class="material-icons prefix">call</i>
                  <input type="number" name="phone" value="0<?php echo empty($_POST['phone']) ? $data['getProfile']['phone'] : $data['phone'] ; ?>">
                  <label for="phone">Telefono</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['phoneErr']; ?></div>
                </div>              
              </div> 
              <div class="col s4">
                <div class="input-field">
                  <i class="material-icons prefix">add_location</i>
                  <textarea name="local" class="materialize-textarea"><?php echo empty($_POST['local']) ? $data['getProfile']['direction'] : $data['local'] ; ?></textarea>
                  <label for="local">Direccion</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['localErr']; ?></div>
                </div>                       
              </div> 
              <div class="col s4 mt-2">
                <div class="input-field">
                  <i class="material-icons prefix">account_balance</i>
                  <select name="core">
                    <option value="<?php echo $data['getProfile']['id_core']; ?>" selected><?php echo $data['getPersonCore']['core_n']; ?></option>
                    <?php while($row = pg_fetch_object($data['getCore'])) : ?>
                      <option value="<?php echo $row->id_core; ?>" ><?php echo $row->core_n; ?></option>
                    <?php endwhile; ?>                        
                  </select>
                  <label class="green-text" >Centro de estudios</label>
                </div> 
              </div>  
              <div class="col s4 mt-2">
                <div class="input-field">
                  <i class="material-icons prefix">person</i>
                  <input type="text" disabled value="<?php age($data['getProfile']['birthdate']); ?>" name="age">
                  <label for="age">Edad</label>
                </div>
              </div>  
              <button type="submit" class="mt-2 btn-large green right z-depth-5 waves-effect waves-light"><i class="material-icons left" name="update" >filter_none</i>Actualizar</button>             
            </div>      
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>
