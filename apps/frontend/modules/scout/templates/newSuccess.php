<?php load_assets('scout') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'scouts')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Add A Scout</h2>
        <table class="data-table" id="scout-table">
            <tbody>
<?php include_partial('form', array('form' => $form)) ?>
            </tbody>
        </table>
    </div>
</div>