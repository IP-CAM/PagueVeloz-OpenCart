<!--
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
//-->
<div class="alert alert-danger hide">
  <i class="fa fa-exclamation-circle"></i> <?php echo $text_error ?>
  <ul></ul>
  <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>

<div class="form-horizontal col-sm-offset-3">
  <div class="form-group required">
    <div class="control-label col-sm-2"><?php echo $text_customer ?></div>
    <div class="col-sm-5">
      <input type="text" name="pagueveloz_customer" value="<?php echo $customer ?>" placeholder="Ex: Valdeir Santana" class="form-control" />
    </div>
  </div>
  
  <div class="form-group required">
    <div class="control-label col-sm-2"><?php echo $text_cpf_cnpj ?></div>
    <div class="col-sm-5">
      <input type="text" name="pagueveloz_cpf" value="" placeholder="Ex: 222.222.222-22" class="form-control" />
    </div>
  </div>
  
  <div class="buttons">
    <div class="col-sm-offset-2">
      <button class="btn btn-primary" id="button-confirm"><?php echo $button_confirm ?></button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-billet" tabindex="-1" role="dialog" aria-labelledby="modal-billet">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- Billet Here -->
    </div>
  </div>
</div>

<script type="text/javascript"><!--
  $('#button-confirm').click(function(){
    $('.alert-danger').slideUp();
  
    $.ajax({
      url: 'index.php?route=payment/pagueveloz_billet/generate&order_id=<?php echo $order_id ?>',
      data: 'pagueveloz_customer=' + $('input[name="pagueveloz_customer"]').val() + '&pagueveloz_cpf=' + $('input[name="pagueveloz_cpf"]').val(),
      type: 'POST',
      dataType: 'json',
      beforeSend: function(){
        $('#button-confirm').button('loading');
      },
      success: function(json) {
        if (json.error == true) {
          console.log(json);
          $.map(json.errors, function(value){
            console.log(value);
            $('.alert-danger').removeClass('hide');
            $('.alert-danger').empty().html('<li>' + value + '</li>');
            $('.alert-danger').slideDown();
          })
        } else {
          $('#button-confirm').replaceWith('<a class="btn btn-success" href="' + json.url + '" target="_blank"><?php echo $button_print ?></a>');
          setTimeout(function(){
            window.location.href = '<?php echo $continue ?>';
          }, 5000);
        }
      },
      complete: function(){
        $('#button-confirm').button('reset');
      }
    });
  });
//--></script>