<?php require APPROOT . '/views/include/header.php';?>
<div class="details">
  <div class="ptext">
    <span class="border">
      <?php echo $data['singleBook']['book_n']; ?>
    </span>
  </div>
</div>
<section class="section section-dark">
  <h3>Modificar Libro</h3>
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <form class="row" action="<?php echo URLROOT; ?>/books/details/<?php echo $data['singleBook']['id_book']; ?>" method="POST">
            <div class="col s4">
              <div class="input-field">
                <input type="text" class="black-text" name="name" value="<?php echo $data['singleBook']['book_n']; ?>">
                <label for="name">Nombre del libro</label>
                <div style="margin-left: -60px;" class="red-text"><?php echo $data['nameErr']; ?></div>
              </div>
            </div>
            <div class="col s4">
              <div class="input-field">
                <input type="date" name="year" class="black-text" value="<?php echo $data['singleBook']['created_at']; ?>">
                <div style="margin-left: -60px;" class="red-text"><?php echo $data['yearErr']; ?></div>
              </div>
            </div>
            <div class="col s4 mb-2">
              <div class="input-field">               
                <select name="author" class="black-text" size="number" >
                  <option value="<?php echo $data['singleBook']['id_author']; ?>" selected><?php echo $data['singleBook']['author_n']; ?>  *</option>
                  <?php while($row = pg_fetch_object($data['authorF'])) : ?>
                  <option value="<?php echo $row->id_author; ?>"><?php echo $row->author_n; ?></option>
                  <?php endwhile; ?>
                </select>               
              </div>
            </div>
            <div class="col s4 mb-2">
              <div class="input-field">
                <select name="genre" class="black-text" size="number">
                  <option value="<?php echo $data['singleBook']['id_genre']; ?>" selected><?php echo $data['singleBook']['genre_n']; ?>  *</option>
                  <?php while($row = pg_fetch_object($data['genreF'])) : ?>
                  <option value="<?php echo $row->id_genre; ?>"><?php echo $row->genre_n; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>
            <div class="col s4 mb-2">
              <div class="input-field">
                <select name="editorial" class="black-text" size="number">
                  <option value="<?php echo $data['singleBook']['id_editorial']; ?>" selected><?php echo $data['singleBook']['editorial_n']; ?>  *</option>
                  <?php while($row = pg_fetch_object($data['editorialF'])) : ?>
                  <option value="<?php echo $row->id_editorial; ?>"><?php echo $row->editorial_n; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>
            <div class="col s4 mb-2">
              <div class="input-field" >
                <input type="text" disabled class="black-text" value="<?php echo $data['singleBook']['register_at']; ?>">
                <label for="">Fecha registrada</label>
              </div>
            </div>
            <div class="col s4 mb-2">
              <div class="input-field" >
                <input type="text"disabled class="black-text" value="<?php echo $data['singleBook']['quantity']; ?>">
                <label for="">Cantidad en existencia</label>
              </div>
            </div>
            <div class="col s4 mb-2">
              <div class="input-field" >
                <input type="text" hidden name="quantity" class="black-text" value="<?php echo $data['singleBook']['quantity']; ?>">
              </div>
            </div>
            <div class="col s12">
              <button class="btn-large btn-floating z-depth-5 waves-effect waves-light green" type="submit" name="submit"><i class="material-icons">system_update_alt</i></button>

              <a href="<?php echo URLROOT; ?>/books/delBook/<?php echo $data['singleBook']['id_book']; ?>" class="btn-large z-depth-5 btn-floating waves-effect waves-light red right"><i class="material-icons">delete</i></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require APPROOT . '/views/include/footer.php'; ?>
