<?php //apps/frontend/modules/contact/templates/_form.php ?>
<?php load_assets('form-test') ?>
<?php load_assets('camp') ?>
<?php load_assets('data-table') ?>
<div class="form-wrapper" id="staff-form-wrapper">
  <div class="form-content-wrapper">
    <form name="staff-form" id="staff-form" action="<?php echo is_object($staff) ? '@staff_update' : '@staff_create' ?>" method="post" > 
      <div>      
        <div class="form-input-wrapper" id="first_name">
          <?php echo $form['first_name']->renderLabel() ?>
          <?php echo $form['first_name']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>
      </div>
      <div>      
        <div class="form-input-wrapper" id="last_name">
          <?php echo $form['last_name']->renderLabel() ?>
          <?php echo $form['last_name']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>
      </div>
      <div>
        <div class="form-input-wrapper" id="dob">
          <?php echo $form['dob']->renderLabel() ?>
          <?php echo $form['dob']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>      
      </div>  
      <div>
        <div class="form-input-wrapper" id="cabin_id">
          <?php echo $form['cabin_id']->renderLabel() ?>
          <?php echo $form['cabin_id']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>      
      </div>  
      <?php if (!$form->getObject()->isNew()): ?>
      <div>
        <?php echo link_to('Delete',@staff_delete,array($staff,'method' => 'delete', 'confirm' => 'Are you sure?')) ?>
      </div>
      <?php endif; ?>
      <hr />
      <input type="submit" class="submit orangeButton" id="form-submit" value="<?php echo ($form->getObject()->isNew() ? 'add' : 'update') ?>&nbsp; staff" />
      <?php echo $form->renderHiddenFields() ?>
    </form>
  </div>
  <div class="form-msg-wrapper">
    <div class="form-msg-content">
      <ul>
        <li class="help-item">Help goes here.</li>
        <?php foreach($form as $item): ?>
        <li class="help-item" id="<?php echo $item->getName() ?>-help" >help for <?php echo ucwords(str_replace('_',' ',str_replace('id','',$item->getName()))) ?><img src="/images/forms/help-arrow.png" alt="" /></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>    