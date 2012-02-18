<?php load_assets('enroll') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'troop registrations')) ?>
<script>
    $('.nav-bar ul li').removeClass('active');
    $('.nav-bar ul li:nth-child(3)').addClass('active');
</script>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>troop registrations</h2>
    <table class="data-table" id="troop registration-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $reg): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo date('M d, Y',$reg->getWeek()->getStartDate())?></td>
          <td><?php echo ucwords($reg->getWeek()->getCamp()->getName())?></td>
          <td><em>payment system down.</em></td>
          <td class="table-controls">
            <div class="table-controls">
              <?php echo link_to(
                      image_tag('icons/edit-icon.png', array(
                          'width'   =>    '16',
                          'height'  =>    '16',
                          'alt'     =>    'edit'))
                      .'<span class="control-txt">edit</span>',
                      @troop_enroll_edit,$reg) ?>  
              <?php echo link_to(
                      image_tag('icons/delete-icon.png', array(
                          'width'   =>    '16',
                          'height'  =>    '16',
                          'alt'     =>    'delete'))
                      .'<span class="control-txt">delete</span>',
                      @troop_enroll_delete, $reg) ?>                        
            </div>
          </td>
<?php endforeach; ?>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4">
<?php if ($pager->haveToPaginate()): ?>
            <div class="pagination">
              <a href="<?php echo url_for('troop registration',@troop_enroll) ?>?page=<?php echo $pager->getFirstPage() ?>">
                <img src="/images/first.png" alt="First page" title="First page" />
              </a>
              <a href="<?php echo url_for('troop registration',@troop_enroll) ?>?page=<?php echo $pager->getPreviousPage() ?>">
                <img src="/images/previous.png" alt="Previous page" title="Previous page" />
              </a>
<?php foreach ($pager->getLinks() as $page): ?>
  <?php if ($page == $pager->getPage()): ?>
    <?php echo $page ?>
  <?php else: ?>
              <a href="<?php echo url_for('troop registration',@troop_enroll) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
  <?php endif; ?>
<?php endforeach; ?>
              <a href="<?php echo url_for('troop registration',@troop_enroll) ?>?page=<?php echo $pager->getNextPage() ?>">
                <img src="/images/next.png" alt="Next page" title="Next page" />
              </a>
              <a href="<?php echo url_for('troop registration',@troop_enroll) ?>?page=<?php echo $pager->getLastPage() ?>">
                <img src="/images/last.png" alt="Last page" title="Last page" />
              </a>
            </div>
<?php endif; ?>
            <div class="pagination_desc">
              <strong><?php echo count($pager) ?></strong> troop registrations found.
<?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
<?php endif; ?>
            </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
