<?php require APPROOT . '/views/include/header.php';?>
<div class="details2">
  <div class="ptext">
    <span class="border2">
      Datos registrados del prestamo
    </span>
  </div>
</div>
<section class="section section-dark">
  <?php if($data['details']['stats'] == 't') : ?>
  <form action="<?php echo URLROOT; ?>/lendings/details/<?php echo $data['details']['id_lendings']; ?>" method="POST">
    <input type="text" name="book" hidden value="<?php echo $data['details']['id_book']; ?>">
    <input type="text" name="author" hidden value="<?php echo $data['details']['id_author']; ?>">
    <button type="submit" class="btn-large waves-effect green right waves-light z-depth-5">Entregar libro</button>
  </form>
  <?php else : ?>
  <p class="right">Este libro fue devuelto!</p>
  <?php endif; ?>
  <h3>Datos</h3>
  <div class="row">
    <div class="col s3">
      <p class="left">
        Nombre: <strong class="white-text"><?php echo $data['details']['person_n']; ?></strong>
      </p>
    </div>
    <div class="col s3">
      <p class="left">
        Apellido: <strong class="white-text"><?php echo $data['details']['person_ln']; ?> </strong>
      </p>
    </div>
    <div class="col s3">
      <p class="left">
        Cedula: <strong class="white-text"><?php echo $data['details']['ci']; ?></strong>
      </p>
    </div>  
    <div class="col s3">
      <p class="left">
        Numero telefonico: <strong class="white-text">0<?php echo $data['details']['phone']; ?></strong>
      </p>
    </div>
    <div class="col s3">
      <p class="left">
        Estudiante: <strong class="white-text"><?php echo $data['details']['core_n']; ?></strong>
      </p>
    </div>
    <div class="col s3">
      <p class="left">
        Libro: <strong class="white-text"><?php echo $data['details']['book_n']; ?></strong>
      </p>
    </div>
    <div class="col s3">
      <p class="left">
        Usuario operativo: <strong class="white-text"> <?php echo $data['details']['username']; ?></strong>
      </p>
    </div>
    <div class="col s3">
      <p class="left">
        Fecha registrada: <strong class="white-text"> <?php echo $data['details']['register_at']; ?></strong>
      </p>
    </div>
  </div>
  <div class="fixed-action-btn">
    <a href="<?php echo URLROOT; ?>/lendings/index" class="btn-large btn-floating green waves-effect waves-light">
      <i class="material-icons">keyboard_arrow_left</i>
    </a> 
  </div>
</section>
<?php require APPROOT . '/views/include/footer.php'; ?>
