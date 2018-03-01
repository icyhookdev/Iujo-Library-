<?php require APPROOT . '/views/include/header.php';?>
<?php message($_GET['url']); ?>
<div class="indexBook">
  <div class="row">
    <div class="col s12">
      <h2 class="center-align">Busque por Nombre del libro</h2>
    </div>
  </div>
  <div class="row">
    <div class="col s4 offset-s4">
      <form action="<?php echo URLROOT; ?>/books/index" method="POST">
        <div class="input-field">
          <input style="max-width: 300px;" type="text" name="search" class="inputSearch white-text" placeholder="Buscar">    
          <button type="submit" name="searchRequest" class="btn-floating blue lighten-2 mbtn waves-effect waves-light"><i class="fas fa-search "></i></button>
          <div class="red-text"><?php echo $data['searchErr']; ?></div>
        </div>
      </form>   
    </div>
  </div>
  <?php if(isset($_POST['searchRequest'])) : ?>
    <?php if(empty($data['searchErr'])) : ?>
    <div class="row">
      <div class="col s4 offset-s4">
        <div class="card z-depth-4 grey darken-4 ">             
          <div class="card-content">
            <p class="center-align white-text">
                <?php echo $data['searchFetch']['book_n']; ?>            
            </p>
            <p class="center-align"><?php echo $data['searchFetch']['genre_n']; ?></p>
            <p class="center-align"><?php echo $data['searchFetch']['author_n']; ?></p>
            <p class="center-align"><?php echo $data['searchFetch']['created_at']; ?></p>
            <a href="<?php echo URLROOT; ?>/books/details/<?php echo $data['searchFetch']['id_book']; ?>" class="btn-floating right btn-large green waves-effect waves-light"><i class="material-icons right large">info</i>Ver</a>
          </div>             
        </div>
      </div>
    </div>
    <?php endif; ?> 
  <?php endif; ?>
  <div class="row">
    <div class="col s8">
      <div class="card grey darken-4 z-depth-4">
        <div class="card-content">
          <div class="row">
          <?php while($row = pg_fetch_object($data['book'])) : ?> 
            <div class="col s3">             
              <div class="card z-depth-4 grey lighten-2 ">             
                <div class="card-content">
                  <p class="center-align black-text">
                    <?php echo $row->book_n; ?>            
                  </p>
                  <p class="center-align"><?php echo $row->genre_n; ?></p>
                  <p class="center-align"><?php echo $row->author_n; ?></p>
                  <p class="center-align"><?php echo $row->created_at; ?></p>
                  <a href="<?php echo URLROOT; ?>/books/details/<?php echo $row->id_book; ?>" class="btn-large blue waves-effect waves-light z-depth-5">Ver<i class="material-icons right">info</i></a>
                </div>            
              </div>  
            </div>
          <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col s4">
      <div class="card grey darken-4 z-depth-5">
        <div class="card-content">
          <p class="flow-text white-text center-align">Buscar por autor</p>
          <input type="text" placeholder="buscar" id="filter" class="white-text">
          <div class="mySideBar">
            <div class="collection">
              <?php while($row = pg_fetch_object($data['author'])) : ?>
                <a href="<?php echo URLROOT; ?>/books/authors/<?php echo $row->id_author; ?>" class="btn-large grey lighten-2 black-text z-depth-4 collection-item"><?php echo $row->author_n; ?></a>  
              <?php endwhile; ?>   
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
const filter = document.querySelector('#filter');
  
  filter.addEventListener('keyup', filterSearch);

  function filterSearch(e){
    const text = e.target.value.toUpperCase();
    document.querySelectorAll('.collection-item').forEach(function(task){
      const item = task.textContent;
      if(item.toUpperCase().indexOf(text) != -1){
        task.style.display = 'block';
      }else{
        task.style.display = 'none';
      }
    });  
  }
</script>
<?php require APPROOT . '/views/include/footer.php'; ?>
