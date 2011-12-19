<?php load_assets('time') ?>
<?php load_assets('data-table') ?>
<?php include_partial("global/infobox", array('page'=>'week')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Weeks</h2>
    <table class="data-table" id="week-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $week): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo link_to(ucwords($week->getName()), @periods_by_week,array(
                          'country_slug'  =>  $week->getCamp()->getDistrict()->getZone()->getCountry()->getSlug(),
                          'zone_slug'     =>  $week->getCamp()->getDistrict()->getZone()->getSlug(),
                          'district_slug' =>  $week->getCamp()->getDistrict()->getSlug(),
                          'camp_slug'     =>  $week->getCamp()->getSlug(),
                          'week_slug'     =>  $week->getSlug())) ?></td>
<!--          <td></td> -->
          <td><?php echo $week->getCamp()->getName().', '.$week->getCamp()->getDistrict()->getCode() ?></td>
          <td class="table-controls">
            <div class="table-controls">
              <a href="<?php echo url_for('week/edit?id='.$week->getId()) ?>">
              <a href="<?php echo url_for('week/edit?id='.$week->getId()) ?>">
                    <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                    <span class="control-txt">edit</span>
                  </a>
                  <a href="<?php echo url_for('week/edit?id='.$week->getId()) ?>">
                    <img src="/images/icons/delete-icon.png" width="16" height="16" alt="delete" />
                    <span class="control-txt">delete</span>
                  </a>
                <div>
              </td>
            </tr>
<?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">
                <div class="pagination_desc">
                  <strong><?php echo count($pager) ?></strong> weeks found
<?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
<?php endif; ?>
                </div>
<?php if($pager->haveToPaginate()): ?>
                <div class="pagination">
  <?php echo link_to("&larr;",$route.'&page='.$pager->getFirstPage()) ?>
  <?php echo link_to("&laquo;",$route,array('page'=>$pager->getPreviousPage())) ?>
  <?php foreach($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
                  <?php echo link_to($page,$route,array('page'=>$page))?>
  <?php endif; endforeach; ?>
  <?php echo link_to("&raquo;",$route,array('page'=>$pager->getNextPage())) ?>
  <?php echo link_to("&rarr;",$route,array('page'=>$pager->getLastPage())) ?>
                </div>
<?php endif; ?>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
