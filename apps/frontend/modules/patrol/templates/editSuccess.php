<?php load_assets('patrol') ?>
<?php load_assets('colorpicker') ?>
<?php include_partial('global/infobox',array('page'=>'patrols')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Update <?php echo $patrol ?></h2>
        <table class="data-table" id="patrol-table">
            <tbody>
<?php include_partial('form', array('form' => $form)) ?>
            </tbody>
        </table>
    </div>
</div>