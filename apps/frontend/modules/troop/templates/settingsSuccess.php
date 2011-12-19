<?php include_partial('global/infobox',array('page'=>'troop-settings')) ?>
<?php use_stylesheet('datatable.css.php') ?>
<script>
    $('.nav-bar ul li').removeClass('active');
    $('.nav-bar ul li:nth-child(4)').addClass('active');
</script>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>troop&nbsp;<?php echo $troop->getNumber() ?></h2>
        <table class="data-table" id="scout-table">
            <tbody>
                <tr class="table-row odd-row">
                    <th>Number</th>
                    <td><?php echo ucwords($troop->getNumber())?></td>
                </tr>
                <tr class="table-row even-row">
                    <th>Photo</th>
                    <td><?php /*if(!is_empty($troop->getImg()):*/ echo link_to('upload photo',@upload_troop_photo);/* else: ?><img src="/images/user_files/troops/photos/<?php echo $troop->getImg()?>" alt="Troop <?php echo $troop->getDistrict()->getCode().$troop->getNumber() ?>" /><?php endelse; */?></td>
                </tr>
                <tr class="table-row odd-row">
                    <th>Patrols</th>
                    <td><?php echo $troop->getPatrolCount() ?></td>
                </tr>
                <tr class="table-row even-row">
                    <th>Scouts</th>
                    <td><?php echo $troop->getScoutCount() ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php echo link_to('Edit',@troop_edit) ?>

