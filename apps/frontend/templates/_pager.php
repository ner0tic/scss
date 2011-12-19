<?php // apps/frontend/templates/_pager.php ?>
          <tfoot>
            <tr>
              <td colspan="<?php echo $colspan ?>">
                <div class="pagination_desc">
                  <strong><?php echo count($pager) ?></strong> <?php echo $module ?>s found
<?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
<?php endif; ?>
                </div>
<?php if($pager->haveToPaginate()): ?>
                <div class="pagination">
  <?php echo link_to("&larr;",$sf_context->getRouting()->getCurrentRouteName(),array_merge($sf_context->getRouting()->getDefaultParameters(), array('page'=>$pager->getFirstPage()))) ?>
  <?php echo link_to("&laquo;",$sf_context->getRouting()->getCurrentRouteName(),array_merge($sf_context->getRouting()->getDefaultParameters(),array('page'=>$pager->getPreviousPage()))) ?>
  <?php foreach($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
                  <?php echo link_to($page,$sf_context->getRouting()->getCurrentRouteName(),array('page'=>$page))?>
  <?php endif; endforeach; ?>
  <?php echo link_to("&raquo;",$sf_context->getRouting()->getCurrentRouteName(),array_merge($sf_context->getRouting()->getDefaultParameters(),array('page'=>$pager->getNextPage()))) ?>
  <?php echo link_to("&rarr;",$sf_context->getRouting()->getCurrentRouteName(),array_merge($sf_context->getRouting()->getDefaultParameters(),array('page'=>$pager->getLastPage()))) ?>
                </div>
<?php endif; ?>
              </td>
            </tr>
          </tfoot>