<?php
/**
 * @author Ayep's TM
 * @copyright 2019 AYEP'S
 * Author URI: https://ayeps.ru
 */
?>
<h1>Ayep's Post Faker</h1>
<style>
  .form-field{
    margin-bottom: 1rem;
  }
  .form-field label{
    display: block;
    margin-bottom: 0.5rem;
  }
  .form-field input {
    display: inline-block;
    max-width: 400px;
  }
</style>
<form action="<?php echo admin_url('admin-ajax.php')?>?action=ayp_faker_generate" class="js-posts">
  <div class="form-field">
    <label for="count">Post count</label>
    <input type="number" name="count" value="10" id="count">
  </div>
  <div class="form-field">
    <label for="is-image"><input type="checkbox" name="generate_image" id="is-image" checked value="1"> Generate image</label>
  </div>
  <div id="image-size">
    <div class="form-field">
      <p>Generated Image Size</p>
      <input type="number" name="img[width]" value="1200" style="width:100px;"> X <input type="number" name="img[height]" value="768" style="width:100px;">
    </div>
  </div>
  <div class="form-field">
    <button class="button-primary button">Generate</button>
  </div>
</form>

<script>
  (function ($) {
    var form = $('.js-posts'),
        img_checkbox = $('#is-image'),
        img_size = $('#image-size');
    img_checkbox.on('change', function (e) {
      img_size.slideToggle(0);
    });
    form.on('submit', function(e){
      e.preventDefault();
      $.post(form.attr('action'), form.serialize(), function (response) {
        if (response && response.status && response.status === 'success') {
          alert('Posts generated');
        }
      })
    });
  })(jQuery)
</script>
