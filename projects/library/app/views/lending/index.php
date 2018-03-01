<?php require APPROOT . '/views/include/header.php';?>
<?php message($_GET['url']); ?>
<div class="lendIndex brown lighten-4">
  <div class="row">
    <div class="col s6 offset-s3">
      <div class="card z-depth-5 grey darken-4">
        <div class="card-content">
          <h3 class="center-align">Libros prestados</h3>
          <div class="collection scrollY">
            <?php while($row = pg_fetch_object($data['lendings'])) : ?>
            <a href="<?php echo URLROOT; ?>/lendings/details/<?php echo $row->id_lendings; ?>" class="collection-item collect-hover grey darken-4">
              <marquee direction="left" >
                <?php echo $row->book_n; ?> | <?php echo $row->person_n . ' ' .$row->person_ln . ' ' . $row->ci ?>
              </marquee>
              <span><i class="material-icons left">person</i>Info</span>
            </a>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col s3">
      <a href="<?php echo URLROOT; ?>/lendings/register" class="btn-large blue waves-effect waves-light z-depth-5 mt-1 fixed"><i class="material-icons left">person</i>Prestamo</a> 
    </div>
  </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>
