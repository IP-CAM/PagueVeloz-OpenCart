<!--
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
//-->
<?php echo $header ?><?php echo $column_left ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title ?></h1>
    
      <ul class="breadcrumb">
        <?php foreach($breadrumbs as $breadrumb) { ?>
        <li><a href="<?php echo $breadrumb['href'] ?>"><?php echo $breadrumb['name'] ?></a></li>
        <?php } ?>
      </ul>
      
      <div class="pull-right">
        <button type="submit" form="form-pagueveloz" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_save ?>"><i class="fa fa-save"></i></button>
        <a href="#" class="btn btn-danger" data-toggle="tooltip" title="<?php echo $button_cancel ?>"><i class="fa fa-reply"></i></a>
      </div>
    </div>
  </div>
  
  <div class="container-fluid">
  
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger">
      <i class="fa fa-exclamation-circle"></i> <?php echo $error_warning ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo $text_form ?></h3>
        
        <div class="panel-body">
          <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-pagueveloz" class="form-horizontal">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-config" data-toggle="tab"><?php echo $text_config ?></a></li>
              <li><a href="#tab-billet" data-toggle="tab"><?php echo $text_billet ?></a></li>
              <li><a href="#tab-sms" data-toggle="tab"><?php echo $text_sms ?></a></li>
            </ul>
            
            <div class="tab-content">
              <div id="tab-config" class="tab-pane active">
                <div class="form-group">
                  <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_status ?>"><?php echo $entry_status ?></span></label>
                  <div class="col-sm-10">
                    <select name="pagueveloz_status" class="form-control">
                      <?php if ($pagueveloz_status) { ?>
                      <option value="1" selected><?php echo $text_enabled ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_enabled ?></option>
                      <?php } ?>
                      
                      <?php if (!$pagueveloz_status) { ?>
                      <option value="0" selected><?php echo $text_disabled ?></option>
                      <?php } else { ?>
                      <option value="0"><?php echo $text_disabled ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group required">
                  <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_email ?>"><?php echo $entry_email ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="pagueveloz_email" value="<?php echo $pagueveloz_email ?>" class="form-control" />
                    <?php if ($error_email) { ?>
                    <span class="text-danger"><?php echo $error_email ?></span>
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group required">
                  <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_token ?>"><?php echo $entry_token ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="pagueveloz_token" value="<?php echo $pagueveloz_token ?>" class="form-control" />
                    <?php if ($error_token) { ?>
                    <span class="text-danger"><?php echo $error_token ?></span>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_geo_zone ?>"><?php echo $entry_geo_zone ?></span></label>
                  <div class="col-sm-10">
                    <select name="pagueveloz_geo_zone" class="form-control">
                      <option value="0"><?php echo $text_all_zones ?></option>
                      <?php foreach($geo_zones as $zone) { ?>
                      <?php if ($zone['geo_zone_id'] == $pagueveloz_geo_zone) { ?>
                      <option value="<?php echo $zone['geo_zone_id'] ?>" selected><?php echo $zone['name'] ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $zone['geo_zone_id'] ?>"><?php echo $zone['name'] ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="input-sort-order"><span data-toggle="tooltip" title="<?php echo $help_sort_order ?>"><?php echo $entry_sort_order ?></span></label>
                  <div class="col-sm-10">
                    <input type="number" name="pagueveloz_sort_order" id="input-sort-order" value="<?php echo $pagueveloz_sort_order ?>" required maxlength="2" class="form-control" />
                  </div>
                </div>
              </div>
              
              <div id="tab-billet" class="tab-pane">
                <fieldset>
                  <legend><?php echo $text_geral ?></legend>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_billet_status ?>"><?php echo $entry_status ?></span></label>
                    <div class="col-sm-10">
                      <select name="pagueveloz_billet_status" class="form-control">
                        <?php if ($pagueveloz_billet_status) { ?>
                        <option value="1"><?php echo $text_enabled ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled ?></option>
                        <?php } ?>
                        
                        <?php if (!$pagueveloz_billet_status) { ?>
                        <option value="0"><?php echo $text_disabled ?></option>
                        <?php } else { ?>
                        <option value="0"><?php echo $text_disabled ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_billet_expiration ?>"><?php echo $entry_expiration ?></span></label>
                    <div class="col-sm-10">
                      <input type="number" name="pagueveloz_billet_expiration" value="<?php echo $pagueveloz_billet_expiration ?>" maxlength="4" class="form-control" />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_billet_cedente ?>"><?php echo $entry_cedente ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="pagueveloz_billet_cedente" value="<?php echo $pagueveloz_billet_cedente ?>" class="form-control" />
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_billet_cpfcedente ?>"><?php echo $entry_cpf_cedente ?></span></label>
                    <div class="col-sm-10">
                      <input type="text" name="pagueveloz_billet_cpfcedente" value="<?php echo $pagueveloz_billet_cpfcedente ?>" class="form-control" />
                      <?php if ($error_cpf_cnpj_cedente) { ?>
                      <span class="text-danger"><?php echo $error_cpf_cnpj_cedente ?></span>
                      <?php } ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_billet_note ?>"><?php echo $entry_note ?></span></label>
                    <div class="col-sm-10">
                      <input type="text" name="pagueveloz_billet_note_1" value="<?php echo $pagueveloz_billet_note_1 ?>" class="form-control" />
                      <input type="text" name="pagueveloz_billet_note_2" value="<?php echo $pagueveloz_billet_note_2 ?>" class="form-control" />
                    </div>
                  </div>
                </fieldset>
                <br/>
                
                <fieldset>
                  <legend><?php echo $text_order_status ?></legend>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><?php echo $entry_order_status_printed ?></label>
                    <div class="col-sm-10">
                      <select name="pagueveloz_billet_pending" class="form-control">
                        <?php foreach($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $pagueveloz_billet_pending) { ?>
                        <option value="<?php echo $order_status['order_status_id'] ?>" selected><?php echo $order_status['name'] ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id'] ?>"><?php echo $order_status['name'] ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><?php echo $entry_order_status_canceled ?></label>
                    <div class="col-sm-10">
                      <select name="pagueveloz_billet_canceled" class="form-control">
                        <?php foreach($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $pagueveloz_billet_canceled) { ?>
                        <option value="<?php echo $order_status['order_status_id'] ?>" selected><?php echo $order_status['name'] ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id'] ?>"><?php echo $order_status['name'] ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><?php echo $entry_order_status_complete ?></label>
                    <div class="col-sm-10">
                      <select name="pagueveloz_billet_complete" class="form-control">
                        <?php foreach($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $pagueveloz_billet_complete) { ?>
                        <option value="<?php echo $order_status['order_status_id'] ?>" selected><?php echo $order_status['name'] ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id'] ?>"><?php echo $order_status['name'] ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </fieldset>
              </div>
              
              <div id="tab-sms" class="tab-pane">
                <fieldset>
                  <legend><?php echo $text_geral ?></legend>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_sms ?>"><?php echo $entry_sms ?></span></label>
                    <div class="col-sm-10">
                      <select name="pagueveloz_sms_status" class="form-control">
                        <?php if ($pagueveloz_sms_status) { ?>
                        <option value="1" selected><?php echo $text_enabled ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled ?></option>
                        <?php } ?>
                        
                        <?php if (!$pagueveloz_sms_status) { ?>
                        <option value="0" selected><?php echo $text_disabled ?></option>
                        <?php } else { ?>
                        <option value="0"><?php echo $text_disabled ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group required">
                    <label class="control-label col-sm-2"><span data-toggle="tooltip" title="<?php echo $help_telephone ?>">Celular</span></label>
                    <div class="col-sm-10">
                      <input type="tel" name="pagueveloz_sms_telephone" value="<?php echo $pagueveloz_sms_telephone ?>" class="form-control" />
                      <?php if ($error_sms_telephone) { ?>
                      <span class="text-danger"><?php echo $error_sms_telephone ?></span>
                      <?php } ?>
                    </div>
                  </div>
                </fieldset>
                <br />
                
                <fieldset>
                  <legend><?php echo $text_event ?></legend>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2"><?php echo $entry_order ?></label>
                    <div class="col-sm-10">
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_order_add" <?php echo ($pagueveloz_post_order_add) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_order_add ?>" name="pagueveloz_text_order_add" />
                            <span data-toggle="tooltip" title="<?php echo $help_order_add ?>">post.order.add</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_order_edit" <?php echo ($pagueveloz_post_order_edit) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_order_edit ?>" name="pagueveloz_text_order_edit" />
                            <span data-toggle="tooltip" title="<?php echo $help_order_edit ?>">post.order.edit</span>
                          </label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-10 col-sm-offset-2">
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_order_delete" <?php echo ($pagueveloz_post_order_delete) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_order_delete ?>" name="pagueveloz_text_order_delete" />
                            <span data-toggle="tooltip" title="<?php echo $help_order_delete ?>">post.order.delete</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_order_history_add" <?php echo ($pagueveloz_post_order_history_add) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_order_history_add ?>" name="pagueveloz_text_order_history_add" />
                            <span data-toggle="tooltip" title="<?php echo $help_order_history_add ?>">post.order.history.add</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2"><?php echo $entry_review ?></label>
                    <div class="col-sm-10">
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_admin_review_edit" <?php echo ($pagueveloz_post_admin_review_edit) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_admin_review_edit ?>" name="pagueveloz_text_admin_review_edit" />
                            <span data-toggle="tooltip" title="<?php echo $help_review_edit ?>">post.admin.review.edit</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_review_add" <?php echo ($pagueveloz_post_review_add) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_review_add ?>" name="pagueveloz_text_review_add" />
                            <span data-toggle="tooltip" title="<?php echo $help_review_add ?>">post.review.add</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2"><?php echo $entry_affiliate ?></label>
                    <div class="col-sm-10">
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_admin_affiliate_approve" <?php echo ($pagueveloz_post_admin_affiliate_approve) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_admin_affiliate_approve ?>" name="pagueveloz_text_admin_affiliate_approve" />
                            <span data-toggle="tooltip" title="<?php echo $help_affiliate_approve ?>">post.admin.affiliate.approve</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_admin_affiliate_transaction_add" <?php echo ($pagueveloz_post_admin_affiliate_transaction_add) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_admin_affiliate_transaction_add ?>" name="pagueveloz_text_admin_affiliate_transaction_add" />
                            <span data-toggle="tooltip" title="<?php echo $help_affiliate_transaction_add ?>">post.admin.affiliate.transaction.add</span>
                          </label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-10 col-sm-offset-2">
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_affiliate_add" <?php echo ($pagueveloz_post_affiliate_add) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_affiliate_add ?>" name="pagueveloz_text_affiliate_add" />
                            <span data-toggle="tooltip" title="<?php echo $help_affiliate_add ?>">post.affiliate.add</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_affiliate_edit" <?php echo ($pagueveloz_post_affiliate_edit) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_affiliate_edit ?>" name="pagueveloz_text_affiliate_edit" />
                            <span data-toggle="tooltip" title="<?php echo $help_affiliate_edit ?>">post.affiliate.edit</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2"><?php echo $entry_customer ?></label>
                    <div class="col-sm-10">
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_customer_add" <?php echo ($pagueveloz_post_customer_add) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_customer_add ?>" name="pagueveloz_text_customer_add" />
                            <span data-toggle="tooltip" title="<?php echo $help_customer_add ?>">post.customer.add</span>
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="pagueveloz_post_customer_edit" <?php echo ($pagueveloz_post_customer_edit) ? 'checked' : '' ?> />
                            <input type="hidden" value="<?php echo $pagueveloz_text_customer_edit ?>" name="pagueveloz_text_customer_edit" />
                            <span data-toggle="tooltip" title="<?php echo $help_customer_edit ?>">post.customer.edit</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="close-modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-modal">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
  $('select[name="pagueveloz_sms_status"]').change(function(){
    if ($(this).val() == 1) {
      $('input[type="checkbox"]').removeAttr('disabled');
      $('input[name="pagueveloz_sms_telephone"]').parents('.form-group').slideDown('slow');
    } else {
      $('input[type="checkbox"]').attr('disabled', true);
      $('input[name="pagueveloz_sms_telephone"]').parents('.form-group').slideUp();
    }
  });
  
  $('select[name="pagueveloz_sms_status"]').trigger('change');
  
  $('input[type="checkbox"]').change(function(){
    if ($(this).is(':checked')) {
      /* Variavéis */
      var title = $(this).parent().find('span').text();
      var input_name = $(this).parent().find('input[type="hidden"]').attr('name');
      var input_value = $(this).parent().find('input[type="hidden"]').val();
      var textarea = '<textarea name="pagueveloz_message_sms" maxlength="150" data-input="' + input_name + '" class="form-control">' + input_value + '</textarea><span></span>';
      
      /* Reseta input e título do modal */
      $('#myModal .modal-header h4').empty().html('<b>' + title + '</b>');
      $('#myModal .modal-body').empty().html(textarea);
      
      $('#myModal').modal('show');
      
      /* Limita quantidade de caracteres */
      $(document).on('keyup', 'textarea[name="pagueveloz_message_sms"]', function(){
        var count_chr = parseInt(150 - $('textarea[name="pagueveloz_message_sms"]').val().length);
        
        if (count_chr >= 150) {
          return false;
        }
        
        $(this).parent().find('span').removeClass('text-danger').addClass('text-success');
        $(this).parent().find('span').empty().text(count_chr);
        
      })
      
      /* Verfica as quantidade de caracteres e fecha modal */
      $(document).on('click', '#close-modal', function(){
        if ($('textarea[name="pagueveloz_message_sms"]').val().length < 1) {
          $('textarea[name="pagueveloz_message_sms"]').parent().find('span').removeClass('text-success').addClass('text-danger');
          $('textarea[name="pagueveloz_message_sms"]').parent().find('span').empty().text('<?php echo $text_field_requried ?>');
          return false;
        }
        
        $('#myModal').modal('hide');
      });
      
      /* Verfica as quantidade de caracteres e salva as informações */
      $(document).on('click', '#save-modal', function(){
        if ($('textarea[name="pagueveloz_message_sms"]').val().length < 1) {
          $('textarea[name="pagueveloz_message_sms"]').parent().find('span').removeClass('text-success').addClass('text-danger');
          $('textarea[name="pagueveloz_message_sms"]').parent().find('span').empty().text('<?php echo $text_field_requried ?>');
          return false;
        }
        
        var input_name = $('textarea[name="pagueveloz_message_sms"]').attr('data-input');
        $('input[name="' + input_name + '"]').val($('textarea[name="pagueveloz_message_sms"]').val());
        
        $('.alert').remove();
        $('.panel').before('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $text_save ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        $('#myModal').modal('hide');
      });
    }
  });
//--></script>
<?php echo $footer ?>