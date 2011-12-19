<?php load_assets('login') ?>
<?php use_helper('I18N') ?>
<?php include_partial('global/fb') ?>
<div class="box main-content">
    <div class="box-content datagrid">
      <div class="form-wrapper">  
        <h2>Login</h2>
        <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
      </div>
      <div class="fb-wrapper">
        <fb:login-button>Login with Facebook</fb:login-button>
      </div>
    </div>
</div>