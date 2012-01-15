<?php //apps/frontend/modules/contact/templates/_form.php ?>
<?php load_assets('form-test') ?>
<?php load_assets('scout') ?>
<?php load_assets('data-table') ?>
<div class="form-wrapper" id="scout-form-wrapper">
  <div class="form-content-wrapper">
    <?php //echo form_tag_for($form, '@scout',array(array('district_slug'=>$sf_request->getParameter('district_slug'),'troop_slug'=>$sf_request->getParameter('troop_slug')),'id'=>'scout-form')) ?>
    <?php /*scss_form_remote_tag(array(
        'url'         =>  '@scout_update',
        'update'      =>  'scout-form',
        'url_params'  =>  array(
            'district_slug' =>  $sf_request->getParameter('district_slug'),
            'troop_slug'    =>  $sf_request->getParameter('troop_slug'),
            'scout_slug'    =>  $sf_request->getParameter('scout_slug')
    )));*/ ?>
    <form name="scout-form" id="scout-form" action="<?php echo is_object($sf_request->getObject()) ? '@scout_update' : '@scout_create' ?>" method="post" >
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
        <div class="form-input-wrapper" id="rank_id">
          <?php echo $form['rank_id']->renderLabel() ?>
          <?php echo $form['rank_id']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>      
      </div>
      <div>
        <div class="form-input-wrapper" id="patrol_id">
          <?php echo $form['patrol_id']->renderLabel() ?>
          <?php echo $form['patrol_id']->render() ?>
        </div>
        <div class="form-input-msg-wrapper">
          <h3 class="help"></h3>
        </div>      
      </div> 
      <?php if (!$form->getObject()->isNew()): ?>
      <div>
        <?php echo link_to('Delete', 'scout/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?','district_slug'=>$sf_request->getParameter('district_slug'),'troop_slug'=>$sf_request->getParameter('troop_slug'))) ?>
      </div>
      <?php endif; ?>
      <hr />
      <input type="submit" class="submit orangeButton" id="form-submit" value="<?php echo ($form->getObject()->isNew() ? 'add' : 'update') ?>&nbsp; scout" />
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