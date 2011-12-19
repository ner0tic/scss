<?php include_partial('global/infobox',array('page'=>'troops')) ?>
<?php use_stylesheet('datatable.css.php') ?>
<script>
    $('.nav-bar ul li').removeClass('active');
    $('.nav-bar ul li:nth-child(4)').addClass('active');
</script>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>troops&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A troop" />',@troop_add, array(
            'country_slug'  =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getCountry()->getSlug(),
            'zone_slug'     =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getSlug(),
            'district_slug' =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
            'troop_slug'    =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getSlug(),
        ))?></h2>
        <table class="data-table" id="scout-table">
            <tbody>
<?php foreach($troops as $i => $troop): ?>
            <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($troop->getNumber())?></td>
                <td></td>
                <td><?php echo $troop->getPatrolCount() ?>&nbsp;Patrols</td>
                <td><?php echo $troop->getScoutCount() ?>&nbsp;Scouts</td>
                <td class="table-controls">
                    <div class="table-controls">
                        <a href="<?php echo url_for('troop/edit?id='.$troop->getId())?>">
                            <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                            <span class="control-txt">edit</span>
                        </a>
                        <a href="<?php echo url_for('troop/delete?id='.$troop->getId())?>">
                            <img src="/images/icons/delete-icon.png" width="16" height="16" alt="delete" />
                            <span class="control-txt">delete</span>
                        </a>
                    </div>
                </td>
<?php endforeach; ?>
            </tr>
        </table>
    </div>
</div>
  <a href="<?php echo url_for('troop/new') ?>">New</a>