<?php include_partial('global/infobox',array('page'=>'troop-settings')) ?>
<?php load_assets('settings') ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>manage&nbsp;troop&nbsp;settings</h2>
        <?php include_component('troop','widgetTroopDetails') ?>
        <?php include_component('troop','widgetCurrentEnrollment') ?>
        <?php include_component('troop','widgetFeeSvc') ?>
        <?php include_component('troop','widgetLeaderList') ?>
    </div>
</div>