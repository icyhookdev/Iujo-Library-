<?php require APPROOT . '/views/include/header.php';?>
<?php message($_GET['url']); ?>
<div class="addBook"> 
  <div class="row ">
    <div class="col s6 offset-s3 mt-3">
      <div class="card grey lighten-4 z-depth-5">
        <div class="card-content">
          <h3>Agregar Libros</h3>
          <p class="mb-2">Agregue los libros segun su conveniencia</p>
          <div class="row">
            <form action="<?php echo URLROOT; ?>/books/add" method="POST" class="col s12">
            <div class="row">
              <div class="col s6">
                <div class="input-field">
                  <i class="material-icons prefix">person</i>
                  <input type="text" name="name">
                  <label for="name" >Nombre del libro</label>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['nameErr']; ?></div>
                </div>
              </div>
              <div class="col s6">
                <div class="input-field ">
                  <i class="fas fa-calendar-alt prefix"></i>
                  <input type="date" name="year">
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['yearErr']; ?></div>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <i class="fas fa-user-secret prefix"></i>                 
                  <select name="author" size="number" >
                    <option value="" selected>Autor</option>
                    <?php while($row = pg_fetch_object($data['authorF'])) : ?>
                    <option value="<?php echo $row->id_author; ?>"><?php echo $row->author_n; ?></option>
                    <?php endwhile; ?>
                  </select>
                  
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['authorErr']; ?></div>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <i class="material-icons prefix">donut_large</i>
                  <select name="genre" size="number">
                    <option value="" >Genero</option>
                    <?php while($row = pg_fetch_object($data['genreF'])) : ?>
                    <option value="<?php echo $row->id_genre; ?>"><?php echo $row->genre_n; ?></option>
                    <?php endwhile; ?>
                  </select>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['genreErr']; ?></div>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <i class="fas fa-university prefix"></i>
                  <select name="editorial" size="number">
                    <option value="" >Editorial</option>
                    <?php while($row = pg_fetch_object($data['editorialF'])) : ?>
                    <option value="<?php echo $row->id_editorial; ?>"><?php echo $row->editorial_n; ?></option>
                    <?php endwhile; ?>
                  </select>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['editorialErr']; ?></div>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <i class="material-icons prefix">equalizer</i>
                  <select name="quantity">
                    <option value="" selected>Candtidad</option>
                    <?php for($i= 1; $i < 51; $i++) : ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                  </select>
                  <div style="margin-left: 50px;" class="red-text"><?php echo $data['quantityErr']; ?></div>
                </div>               
              </div>
                <div class="col s12">
                  <div class="input-field">
                    <button type="submit" name"submit" class="z-depth-5 btn-large blue waves-effect waves-light"><i class="material-icons left">add_circle</i>Agregar</button>
                  </div>
                </div>
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
          <a href="<?php echo URLROOT; ?>/books/author"class="btn-floating blue">
          <i class="fas fa-user-secret"></i>   
          </a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/books/editorial" class="btn-floating green">
            <i class="fas fa-university"></i>
          </a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/books/genre" class="btn-floating purple">
            <i class="material-icons">donut_large</i>
          </a>
        </li>
      </ul>
    </div> 
  </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>
