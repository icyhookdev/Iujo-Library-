<?php require APPROOT . '/views/include/header.php';?>
<div class="addDona">
  <div class="ptext">
    <span class="border">
      Agregar donacion
    </span>
  </div>
</div>
<section class="section section-dark">
  <div class="row">
    <div class="col s6 offset-s3">
      <div class="card grey darken-4 z-depth-5">
        <div class="card-content">
          <h4>Donacion</h4>
          <div class="row">
            <form action="<?php echo URLROOT; ?>/donations/add" method="POST">
              <div class="input-field">
                <i class="material-icons left">person_outline</i>
                <select id="entity" name="entity">
                  <option value="" selected>Tipo de donante</option>
                  <?php while($row = pg_fetch_object($data['entityf'])) : ?>
                  <option value="<?php echo $row->id_entity; ?>"><?php echo $row->entity_n; ?></option>
                  <?php endwhile; ?>
                </select>
                <div style="font-size:13px;" class="red-text"><?php echo $data['entityErr']; ?></div>
              </div>
              <div class="input-field">
                <i class="material-icons left">business</i>
                <select name="company" id="company">
                  <option value="" selected>Seleccione una Empresa</option>
                  <?php while($row = pg_fetch_object($data['companyf'])) : ?>
                  <option value="<?php echo $row->id_company; ?>"><?php echo $row->company_n; ?></option>
                  <?php endwhile; ?>
                </select>
                <div style="font-size:13px;" class="red-text"><?php echo $data['companyErr']; ?></div>
              </div>
              <div class="input-field">
                <i class="material-icons left">person</i>
                <select name="person" id="person">
                  <option value="" selected>Seleccione una persona</option>
                  <?php while($row = pg_fetch_object($data['personf'])) : ?>
                  <option value="<?php echo $row->id_person; ?>"><?php echo $row->person_n . ' '. $row->person_ln. ' '. $row->ci; ?></option>
                  <?php endwhile; ?>
                </select>
                <div style="font-size:13px;" class="red-text"><?php echo $data['personErr']; ?></div>
              </div>   
              <div class="input-field">
                <i class="fas fa-book left"></i>
                <select name="book" id="book">
                  <option value="" selected>Seleccione el Libro</option>
                  <?php while($row = pg_fetch_object($data['bookf'])) : ?>
                  <option value="<?php echo $row->id_book; ?>"><?php echo $row->book_n; ?></option>
                  <?php endwhile; ?>
                </select>
                <div style="font-size:13px;" class="red-text"><?php echo $data['bookErr']; ?></div>
              </div>   
              <div class="input-field">
                <i class="material-icons left">mode_edit</i>
                <p style="font-size:16px;">Razon de la donacion</p>
                <textarea name="reason" id="reason" class="materialize-textarea"></textarea>
                <div style="font-size:13px;" class="red-text"><?php echo $data['reasonErr']; ?></div>
              </div>
              <div class="input-field">
                <button class="btn-large waves-effect waves-light z-depth-5 blue" type="submit" name="submit"><i class="material-icons left">card_giftcard</i>Agregar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-action-btn">
      <a href="<?php echo URLROOT; ?>/donations/index" class="btn-large btn-floating green waves-effect waves-light">
        <i class="material-icons">keyboard_arrow_left</i>
      </a> 
  </div>
  </div>
</section>
<?php require APPROOT . '/views/include/footer.php'; ?>