<?php load_assets('geo') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'zone')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2<Zones</h2>
    <table class="data-table" id="zone-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $zone): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo link_to(ucwords($zone->getName()),@districts_by_zone,array('country_slug'=>$zone->getCountry()->getSlug(),'zone_slug'=>$zone->getSlug())) ?></td>
          <td><?php echo $zone->getCode() ?></td>
          <td><?php echo $zone->getCountry()->getName() ?></td>
          <td class="table-controls">
           <div class=table-controls">
             <a href="<?php echo url_for('zone/edit?id='.$zone->getId()) ?>">
               <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
               <span class="control-txt">edit</span>
             </a>
             <a href="<?php echo url_for('zone/edit?id='.$zone->getId()) ?>">
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
              <strong><?php echo count($pager) ?></strong> zones found
<?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
<?php endif; ?>
            </div>
<?php if($pager->haveToPaginate()): ?>
            <div class="pagination">
  <?php echo link_to("&larr;",$route,array('page'=>$pager->getFirstPage())) ?>
  <?php echo link_to("&laquo;",$route,array('page'=>$pager->getPreviousPage())) ?>
  <?php foreach($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
                  <?php echo link_to($page,$route.'&page='.$page)?>
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


