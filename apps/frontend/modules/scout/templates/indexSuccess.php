<?php load_assets('scout') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'scouts')) ?>
<script>
    $('.nav-bar ul li').removeClass('active');
    $('.nav-bar ul li:nth-child(3)').addClass('active');
</script>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Scouts&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Scout" />',@scout_new, array(
            'district_slug' =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
            'troop_slug'    =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getSlug(),
        ))?></h2>
        <table class="data-table" id="scout-table">
            <tbody>
<?php foreach($pager->getResults() as $i => $scout): ?>
            <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($scout->getLastName())?></td>
                <td><?php echo ucwords($scout->getFirstName())?></td>
                <td><?php echo ucwords($scout->getPatrol()->getName()) ?></td>
                <td class="table-controls">
                    <div class="table-controls">
                      <?php echo link_to(
                              image_tag('icons/edit-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'edit'))
                              .'<span class="control-txt">edit</span>',
                              @scout_edit,array(
                                  'district_slug' =>  $scout->getPatrol()->getTroop()->getDistrict()->getSlug(),
                                  'troop_slug'    =>  $scout->getPatrol()->getTroop()->getSlug(),
                                  'scout_slug'    =>  $scout->getSlug()
                              )) ?>  
                      <?php echo link_to(
                              image_tag('icons/delete-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'delete'))
                              .'<span class="control-txt">delete</span>',
                              @scout_delete, array(
                                  'district_slug' =>  $scout->getPatrol()->getTroop()->getDistrict()->getSlug(),
                                  'troop_slug'    =>  $scout->getPatrol()->getTroop()->getSlug(),
                                  'scout_slug'    =>  $scout->getSlug()
                              )) ?>                        
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
                      <a href="<?php echo url_for('scout',@scout) ?>?page=<?php echo $pager->getFirstPage() ?>">
                        <img src="/images/first.png" alt="First page" title="First page" />
                      </a>
                      <a href="<?php echo url_for('scout',@scout) ?>?page=<?php echo $pager->getPreviousPage() ?>">
                        <img src="/images/previous.png" alt="Previous page" title="Previous page" />
                      </a>
<?php foreach ($pager->getLinks() as $page): ?>
  <?php if ($page == $pager->getPage()): ?>
    <?php echo $page ?>
  <?php else: ?>
                      <a href="<?php echo url_for('scout',@scout) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
  <?php endif; ?>
<?php endforeach; ?>
                      <a href="<?php echo url_for('scout',@scout) ?>?page=<?php echo $pager->getNextPage() ?>">
                        <img src="/images/next.png" alt="Next page" title="Next page" />
                      </a>
                      <a href="<?php echo url_for('scout',@scout) ?>?page=<?php echo $pager->getLastPage() ?>">
                        <img src="/images/last.png" alt="Last page" title="Last page" />
                      </a>
                    </div>
<?php endif; ?>
                    <div class="pagination_desc">
                      <strong><?php echo count($pager) ?></strong> scouts found.
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
