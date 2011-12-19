<?php load_assets('signup') ?>
<?php use_helper('I18N') ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Sign Up</h2>
        <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
    </div>
</div>