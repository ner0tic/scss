<?php load_assets('camp') ?>
<?php load_assets('data-table') ?>
<?php include_partial("global/infobox", array('page'=>'area')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Areas</h2>
    <table class="data-table" id="area-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $area): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo link_to(ucwords($area->getName()), @areas_by_camp,array(
                          'district_slug' =>  $area->getCamp()->getDistrict()->getSlug(),
                          'camp_slug'     =>  $area->getCamp()->getSlug())) ?></td>
          <td><?php /* echo ($area->getParent())?link_to($area->getParent(),@area_show,array(
                          'district_slug' =>  $area->getCamp()->getDistrict()->getSlug(),
                          'camp_slug'     =>  $area->getCamp()->getSlug(),
                          'area_slug'     =>  $area->getSlug())): '' */ ?></td>
          <td class="table-controls">
            <div class="table-controls">
              <?php echo link_to('<img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                <span class="control-txt">edit</span>',@area_edit,array(
                    'id'            =>  $area->getId(),
                    'district_slug' =>  $area->getCamp()->getDistrict()->getSlug(),
                    'camp_slug'     =>  $area->getCamp()->getSlug(),
                    'area_slug'     =>  $area->getSlug())) ?>
              <?php echo link_to('<img src="/images/icons/delete-icon.png" width="16" height="16" alt="delete" />
                <span class="control-txt">delete</span>',@area_delete,array(
                    'id'            =>  $area->getId(),
                    'district_slug' =>  $area->getCamp()->getDistrict()->getSlug(),
                    'camp_slug'     =>  $area->getCamp()->getSlug(),
                    'area_slug'     =>  $area->getSlug())) ?>
            <div>
          </td>
        </tr>
<?php endforeach; ?>
      </tbody>
<?php include_partial("global/pager", array('colspan'=>3,'module'=>'area','pager'=>$pager,'context'=>$sf_context)); ?>
    </table>
  </div>
</div>