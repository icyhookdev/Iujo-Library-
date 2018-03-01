<?php require APPROOT . '/views/include/header.php';?>
<?php message($_GET['url']); ?>
<div class="donationIndex">
  <div class="ptext">
    <span class="border2">
      Donaciones
    </span>
  </div>        
</div>
<section class="section section-dark">
  <div class="row">
    <div class="col s6">
      <div class="card grey darken-4 z-depth-5">
        <div class="card-content">
          <h3><i class="material-icons prefix">person</i> Personas</h3> 
          <p>Donaciones realizadas por personas</p>
          <div class="scrollY">
            <div class="collection">
            <?php while($row = pg_fetch_object($data['person'])) : ?>
              <a href="#!" class="collection-item collect-hover grey darken-4">
                <marquee direction="left"><?php echo $row->person_n . ' ' . $row->person_ln. ' | ' . $row->ci . ' | ' . $row->register_at; ?></marquee>
              </a>
            <?php endwhile; ?>
            </div>            
          </div>
        </div>
      </div>
    </div>
    <div class="col s6">
      <div class="card grey darken-4 z-depth-5">
        <div class="card-content">
          <h3><i class="material-icons prefix">business</i> Empresas</h3>
          <p>Donaciones realizadas por empresas</p>
          <div class="scrollY">
            <div class="collection">
              <?php while($row = pg_fetch_object($data['company'])) : ?>
              <a href="#!" class="collection-item collect-hover grey darken-4">
                <marquee direction="left"><?php echo $row->company_n . ' | ' . $row->register_at; ?></marquee>
              </a>
              <?php endwhile; ?>
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
          <a href="<?php echo URLROOT; ?>/donations/company"class="btn-floating blue">
          <i class="material-icons">business</i>   
          </a>
        </li>
        <li>
          <a href="<?php echo URLROOT; ?>/donations/add" class="btn-floating green">
            <i class="material-icons">add_box</i> 
          </a>
        </li>
      </ul>
    </div> 
  </div>
</section>
<?php require APPROOT . '/views/include/footer.php'; ?>