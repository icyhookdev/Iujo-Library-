<?php require APPROOT . '/views/include/header.php';?>
<div class="authors">
  <div class="ptext">
    <span class="border">
      Libros de <?php echo $data['author']['author_n']; ?>
    </span>
  </div>
</div>
<section class="section section-dark">
  <div class="img-container z-depth-5 circle"></div>
  <div class="row lessM">
  <h2 class="mb-3">Libros Registrados</h2>
    <?php while($row = pg_fetch_object($data['book'])) : ?> 
      <div class="col s3">             
        <div class="card z-depth-5 grey lighten-2 ">             
          <div class="card-content">
            <p class="center-align black-text"><?php echo $row->book_n; ?></p>
            <p class="center-align grey-text"><?php echo $row->genre_n; ?></p>
            <p class="center-align grey-text"><?php echo $row->created_at; ?></p>
            <a href="<?php echo URLROOT; ?>/books/details/<?php echo $row->id_book; ?>" class="btn-large blue waves-effect waves-light z-depth-5">Ver<i class="material-icons right">info</i></a>
          </div>            
        </div>  
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php require APPROOT . '/views/include/footer.php'; ?>