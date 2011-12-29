<?php load_assets('dashboard') ?>
<?php include_partial('global/infobox',array('page'=>'dashboard')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Attendee List</h2>
        <table class="data-table" id="patrol-table">
            <tbody>
<?php foreach($s_pager as $i => $scout): ?>
            <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($scout->getLastName())?></td>
                <td><?php echo ucwords($scout->getFirstName())?></td>
                <td><?php echo (date('Y')-format_date($scout->getDob(),'Y')) ?></td>
                <td><?php echo $scout->getPatrol()->getName() ?></td>
    <?php if($scout->isEnrolled($sf_user->getProfile()->getActiveEnrollment()->getWeek())): ?>
      <?php foreach($sf_user->getProfile()->getActiveEnrollment()->getWeek()->getPeriods() as $period): ?>
                <td><?php $e = $scout->getEnrollment($period->getId());?><img src="/images/user_files/badges/<?php echo (!is_null($e->getClass()->getCourse()->getMeritBadge()->getSlug())?$e->getClass()->getCourse()->getMeritBadge()->getSlug():'tbd') ?>.png" alt="<?php echo $e->getClass()->getName();?>" height="48px" width="48px" /></td>
      <?php endforeach;?>
    <?php else: ?>
                <td colspan="<?php echo count($sf_user->getProfile()->getActiveEnrollment()->getWeek()->getPeriods()) ?>"><span class="not-enrolled">Not Enrolled Yet!</span></td>
    <?php endif; ?>
                <td class="table-controls">
                    <div class="table-controls">
                        <?php echo link_to(image_tag('/images/icons/edit-icon.png',array('width'=>16,'height'=>16,'alt'=>'edit')).'<span class="control-txt">edit</span>',@scout_edit,array(
                                      'district_slug' => $scout->getPatrol()->getTroop()->getDistrict()->getSlug(),
                                      'troop_slug'    => $scout->getPatrol()->getTroop()->getSlug(),
                                      'scout_slug'    => $scout->getSlug()))?>
                        <?php echo link_to(image_tag('/images/icons/delete-icon.png',array('width'=>16,'height'=>16,'alt'=>'delete')).'<span class="control-txt">delete</span>',@scout_delete,array(
                                      'district_slug' => $scout->getPatrol()->getTroop()->getDistrict()->getSlug(),
                                      'troop_slug'    => $scout->getPatrol()->getTroop()->getSlug(),
                                      'scout_slug'    => $scout->getSlug()))?>
                    </div>
                </td>
<?php endforeach; ?>
            </tr>
            </tbody>
            <?php include_partial('global/pager',array(
                'numColumns'      =>  4,
                'prefix'          =>  's_',
                'module'          =>  'scout',
                'pager'           =>  $s_pager
            )) ?>
        </table>
    </div>
</div>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Patrols&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Patrol" />',@patrol_new,array(
                'district_slug' => $sf_request->getParameter('district_slug',   $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug()),
                'troop_slug'    => $sf_request->getParameter('troop_slug',   $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getSlug())))?></h2>
        <table class="data-table" id="patrol-table">
            <tbody>
<?php foreach($p_pager AS $i => $patrol): ?>
                <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                    <td><?php echo $patrol->getName() ?></td>
                    <td><img src="/images/user_files/logos/patrols/<?php echo $patrol->getImg('default.png') ?>" height="48" alt="<?php echo $patrol->getName()?>" /></td>
                    <td><?php echo $patrol->getScoutCount()?> Scout<?php echo($patrol->getScoutCount() != 1) ? 's' : ''?></td>
                    <td class="table-controls">
                        <div class="table-controls">
                          <?php echo link_to(image_tag('/images/icons/edit-icon.png',array('width'=>16,'height'=>16,'alt'=>'edit')).'<span class="control-txt">edit</span>',@patrol_edit,array(
                                        'district_slug' => $patrol->getTroop()->getDistrict()->getSlug(),
                                        'troop_slug'    => $patrol->getTroop()->getSlug(),
                                        'patrol_slug'   => $patrol->getSlug()))?>
                          <?php echo link_to(image_tag('/images/icons/delete-icon.png',array('width'=>16,'height'=>16,'alt'=>'delete')).'<span class="control-txt">delete</span>',@patrol_delete,array(
                                        'district_slug' => $patrol->getTroop()->getDistrict()->getSlug(),
                                        'troop_slug'    => $patrol->getTroop()->getSlug(),
                                        'patrol_slug'   => $patrol->getSlug()))?>
                        </div>
                    </td>
                </tr>
<?php endforeach ?>
            </tbody>
            <?php include_partial('global/pager',array(
                'numColumns'      =>  4,
                'prefix'          =>  'p_',
                'module'          =>  'patrol',
                'pager'           =>  $p_pager
            )) ?>     
        </table>
    </div>
</div>
