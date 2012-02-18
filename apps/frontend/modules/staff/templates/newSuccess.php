<?php include_partial('global/infobox',array('page'=>'staff')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2><?php echo ($form->getObject()->isNew() ? 'Add' : 'Update') ?> A Staff Member</h2>
        <table class="data-table" id="staff-table">
            <tbody>
<?php include_partial('form', array('form' => $form)) ?>
            </tbody>
        </table>
    </div>
</div>