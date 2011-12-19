<?php load_assets('patrol') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'patrols')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Patrols&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Patrol" />',@patrol_new, array(
            'country_slug'  =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getCountry()->getSlug(),
            'zone_slug'     =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getSlug(),
            'district_slug' =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
            'troop_slug'    =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getSlug(),
        ))?></h2>
        <table class="data-table" id="scout-table">
            <tbody>
<?php foreach($pager->getResults() as $i => $patrol): ?>
              <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($patrol->getName())?></td>
                <td><img src="/images/user_files/logos/patrols/<?php echo $patrol->getImg('default.png') ?>" height="48" alt="<?php echo $patrol->getName()?>" /></td>
                <td><?php echo $patrol->getScoutCount() ?>&nbsp;Scouts</td>
                <td class="table-controls">
                    <div class="table-controls">
                        <a href="<?php echo url_for('patrol/edit?id='.$patrol->getId())?>">
                            <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                            <span class="control-txt">edit</span>
                        </a>
                        <a href="<?php echo url_for('patrol/delete?id='.$patrol->getId())?>">
                            <img src="/images/icons/delete-icon.png" width="16" height="16" alt="delete" />
                            <span class="control-txt">delete</span>
                        </a>
                    </div>
                </td>
              </tr>
<?php endforeach; ?>              
            </tbody>
            <tfoot>
            <tr>
              <td colspan="4">
                <div class="pagination_desc">
                  <strong><?php echo count($pager) ?></strong> patrols found
<?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
<?php endif; ?>
                </div>
<?php if($pager->haveToPaginate()): ?>
                <div class="pagination">
  <?php echo link_to("&larr;",@patrol,array('page'=>$pager->getFirstPage())) ?>
  <?php echo link_to("&laquo;",@patrol,array('page'=>$pager->getPreviousPage())) ?>
  <?php foreach($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
                  <?php echo link_to($page,@patrol,array('page'=>$page))?>
  <?php endif; endforeach; ?>
  <?php echo link_to("&raquo;",@patrol,array('page'=>$pager->getNextPage())) ?>
  <?php echo link_to("&rarr;",@patrol,array('page'=>$pager->getLastPage())) ?>
                </div>
<?php endif; ?>
              </td>
            </tr>
          </tfoot>
        </table>
    </div>
</div>
