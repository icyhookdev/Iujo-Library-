<?php require APPROOT . '/views/include/header.php';?>
<div class="registerLend">
  <div class="ptext">
    <span class="border">
      Registrar Prestamos de libros
    </span>
  </div>
</div>
<section class="section section-dark">
<div class="row">
  <div class="col s6 offset-s3">
    <div class="card z-depth-5">      
      <div class="card-content">
        <h3 class="black-text">Registro</h3>
        <form action="<?php echo URLROOT; ?>/lendings/register" method="POST">
          <div class="input-field mt-2">
            <p class="flow-text center-align"><?php echo $_SESSION['userName']; ?></p>
          </div>  
          <div class="input-field">
            <select name="person" class="black-text">
              <option value="" selected>Seleccione una persona</option>
              <?php while($row = pg_fetch_object($data['fetchPerson'])) : ?>
              <option value="<?php echo $row->id_person; ?>"><?php echo $row->person_n; ?></option>
              <?php endwhile; ?>
            </select>
            <div style="margin-top: -10px; margin-left: -310px;" class="red-text mb-1"><?php echo $data['personErr']; ?></div>
          </div>
          <div class="input-field">
            <select name="author" class="black-text">
              <option value="" selected>Seleccione un author</option>
              <?php while($row = pg_fetch_object($data['fetchAuthor'])) : ?>
              <option value="<?php echo $row->id_author; ?>"><?php echo $row->author_n; ?></option>
              <?php endwhile; ?>
            </select>
            <div style="margin-top: -10px; margin-left: -310px;" class="red-text mb-1"><?php echo $data['authorErr']; ?></div>
          </div>
          <div class="input-field">
            <select name="book" class="black-text">
              <option value="" selected>Seleccione un libro</option>
              <?php while($row = pg_fetch_object($data['fetchBook'])) : ?>
              <option value="<?php echo $row->id_book; ?>"><?php echo $row->book_n; ?></option>
              <?php endwhile; ?>
            </select>
            <div style="margin-top: -10px; margin-left: -350px;" class="red-text"><?php echo $data['bookErr']; ?></div>
          </div>
          <div class="input-field">
            <input type="number" name="userid" hidden class="blue-text" value="<?php echo $_SESSION['userId']; ?>">
          </div>
          <div class="input-field mt-1">
            <button class="btn-large waves-effect waves-light blue z-depth-5 mt-2" type="submit" name="submit"><i class="fas fa-caret-square-up left"></i> Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="fixed-action-btn">
    <a href="<?php echo URLROOT; ?>/lendings/index" class="btn-large btn-floating green waves-effect waves-light">
      <i class="material-icons">keyboard_arrow_left</i>
    </a> 
  </div>
</div>
</section>
<?php require APPROOT . '/views/include/footer.php'; ?>
