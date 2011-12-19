<?php load_assets('scout') ?>
<?php load_assets('enroll') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'scout-enrollment')) ?>
<script>
  $('.nav-bar ul li').removeClass('active');
</script>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Enroll Scout</h2>
<?php foreach($p_forms as $p_form): ?>
<?php echo $p_form ?>
<?php endforeach; ?>
    </div>
</div>
