<?php // apps/frontend/modules/patrol/templates/_form.php ?>
<?php load_assets('form-test') ?>
<?php load_assets('patrol') ?>
<?php load_assets('data-table') ?>
<div class="form-wrapper" id="patrol-form-wrapper">
  <div class="form-content-wrapper">
    <form name="patrol-form" id="patrol-form" action="<?php echo is_object($patrol) ? '@patrol_update' : '@patrol_create' ?>" method="post">
      <div>
        <div class="form-input-wrapper" id="name">
          <?php echo $form['name']->renderLabel() ?>
          <?php echo $form['name']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>
      </div>
      <div>
        <div class="form-input-wrapper" id="img">
          <?php echo $form['img']->renderLabel() ?>
          <?php echo $form['img']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>
      </div>
      <div>
        <div class="form-input-wrapper" id="color">
          <?php echo $form['color']->renderLabel() ?>
          <?php echo $form['color']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>
      </div>      
      <?php if (!$form->getObject()->isNew()): ?>
      <div>
        <?php echo link_to('Delete', 'scout/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?',$patrol)) ?>
      </div>
      <?php endif; ?>
      <hr />
      <input type="submit" class="submit orangeButton" id="form-submit" value="<?php echo ($form->getObject()->isNew() ? 'add' : 'update') ?>&nbsp; patrol" />
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