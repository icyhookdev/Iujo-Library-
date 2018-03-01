<?php require APPROOT . '/views/include/header.php';?>
<?php message($_GET['url']); ?>
<div class="personProfile">
  <div class="row">
    <div class="col s6">
      <div class="card z-depth-5">
        <div class="card-content">
          <h3>Personas</h3>
          <p>Por favor ingrese la Cedula de la persona que desea buscar</p>
          <form action="<?php echo URLROOT; ?>/persons/profile" method="POST">
            <div class="input-field">
              <input type="number" name="searchPersonData" class="inputSearch">
              <label for="searchPersonData">Buscar</label>
              <button type="submit" class="btn mbtn waves-effect waves-light"><i class="fas fa-search "></i></button>
              <div class="red-text"><?php echo $data['ciErr']; ?></div>
            </div>
          </form>    
        </div>
      </div>
      <?php if(isset($_POST['searchPersonData'])) : ?>
        <?php if(empty($data['ciErr'])) : ?>
          <div class="row pd-1 valign-wrapper grey darken-4 z-depth-4 ">
            <div class="col s2">
              <img class="circle responsive-img hide-on-med-only" src="<?php echo URLROOT; ?>/public/img/slide2.png" alt="not found">
            </div>
            <div class="col s10">           
              <p>
                <i class=" material-icons">person</i>
                <strong class="white-text">
                  <?php echo $data['searchResult']['person_n']; ?> <?php echo $data['searchResult']['person_ln']; ?>
                </strong>
              </p>
              <p>
                <i class=" material-icons">call</i>
                <strong class="white-text">
                  0<?php echo $data['searchResult']['phone']; ?>
                </strong>
              </p>
              <p>
                <i class="material-icons prefix">contacts</i>
                <strong class="white-text">
                    V <?php echo $data['searchResult']['ci']; ?>
                  </strong>
              </p> 
              <a href="<?php echo URLROOT; ?>/persons/edit/<?php echo $data['searchResult']['id_person']; ?>" class="btn blue waves-effect waves-light">Ver 
                  <i class=" material-icons right">assignment</i>
              </a> 
            </div>                
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="col s6">
      <div class="card z-depth-5">
        <div class="card-content">
          <h3>Usuarios Operativos</h3>
          <p>Personas que tienen asignado un Usuario</p>
          <div class="scrollY">   
            <div class=" mt-1">
              <?php while($row = pg_fetch_object($data['personUsersData'])) : ?>
                <div class="row pd-1 valign-wrapper grey darken-4 z-depth-4 ">
                  <div class="col s2">
                    <img class="circle responsive-img hide-on-med-only" src="<?php echo URLROOT; ?>/public/img/slide2.png" alt="not found">
                  </div>
                  <div class="col s10">           
                    <p>
                      <i class=" material-icons">person</i>
                      <strong class="white-text">
                        <?php echo $row->person_n; ?> <?php echo $row->person_ln; ?>
                      </strong>
                    </p>
                    <p>
                      <i class=" material-icons">person_outline</i>
                        <strong class="white-text">
                          <?php echo $row->username; ?>
                        </strong>
                    </p>    
                    <p>
                    <i class=" material-icons">contacts</i>
                      <strong class="white-text">
                        <?php echo $row->ci; ?>
                      </strong>
                    </p> 
                    <a href="<?php echo URLROOT; ?>/persons/edit/<?php echo $row->id_person; ?>"     class="btn blue waves-effect waves-light">Ver 
                      <i class=" material-icons right">assignment</i>
                    </a> 
                  </div>                
                </div>            
              <?php endwhile; ?>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>