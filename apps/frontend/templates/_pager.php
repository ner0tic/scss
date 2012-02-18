<?php // apps/frontend/templates/_pager.php ?>
<?php load_assets('pager') ?>
<?php $no_plural  = isset($no_plural) ? $no_plural  : false ?>
<?php $prefix     = isset($prefix)    ? $prefix     : '' ?>
          <tfoot>
            <tr>
              <td colspan="<?php echo $colspan ?>" class="pager">
                <?php if($pager->haveToPaginate()): ?>
                <div class="pagination">
                  <?php echo link_to("&larr;",$sf_context->getRouting()->getCurrentRouteName(),array($prefix.'page'=>$pager->getFirstPage())) ?>
                  <?php echo link_to("&laquo;",$sf_context->getRouting()->getCurrentRouteName(),array($prefix.'page'=>$pager->getPreviousPage())) ?>
                  <?php foreach($pager->getLinks() as $page): ?>
                    <?php if ($page == $pager->getPage()): ?>
                      <?php echo $page ?>
                    <?php else: ?>
                      <?php echo link_to($page,$sf_context->getRouting()->getCurrentRouteName(),array($prefix.'page'=>$page))?>
                    <?php endif; endforeach; ?>
                  <?php echo link_to("&raquo;",$sf_context->getRouting()->getCurrentRouteName(),array($prefix.'page'=>$pager->getNextPage())) ?>
                  <?php echo link_to("&rarr;",$sf_context->getRouting()->getCurrentRouteName(),array($prefix.'page'=>$pager->getLastPage())) ?>
                </div>
                <?php endif; ?>
                 <div class="pagination_desc">                     
                  <strong><?php echo count($pager) ?></strong> <?php echo $module . ($no_plural ? '' : 's') ?> found  
                <?php if ($pager->haveToPaginate()): ?>
                  - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
                <?php endif; ?>
                </div>         
              </td>
            </tr>
          </tfoot>