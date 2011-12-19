<?php load_assets('time') ?>
<?php load_assets('data-table') ?>
<?php include_partial("global/infobox", array('page'=>'period')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Periods</h2>
    <table class="data-table" id="period-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $period): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo link_to(ucwords($period->getName()), @classes_by_period,array(
                          'country_slug'  =>  $period->getWeek()->getCamp()->getDistrict()->getZone()->getCountry()->getSlug(),
                          'zone_slug'     =>  $period->getWeek()->getCamp()->getDistrict()->getZone()->getSlug(),
                          'district_slug' =>  $period->getWeek()->getCamp()->getDistrict()->getSlug(),
                          'camp_slug'     =>  $period->getWeek()->getCamp()->getSlug(),
                          'week_slug'     =>  $period->getWeek()->getSlug(),
                          'period_slug'   =>  $period->getSlug())) ?></td>
<!--          <td></td> -->
          <td><?php echo $period->getWeek()->getName() ?></td>
          <td><?php echo $period->getWeek()->getCamp()->getName() ?></td>
          <td class="table-controls">
            <div class="table-controls">
              <a href="<?php echo url_for('period/edit?id='.$period->getId()) ?>">
              <a href="<?php echo url_for('period/edit?id='.$period->getId()) ?>">
                    <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                    <span class="control-txt">edit</span>
                  </a>
                  <a href="<?php echo url_for('period/edit?id='.$period->getId()) ?>">
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
                  <strong><?php echo count($pager) ?></strong> periods found
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
