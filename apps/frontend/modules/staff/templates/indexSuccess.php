<?php load_assets('camp') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'staff')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Staff&nbsp;<?php echo link_to(image_tag("/images/icons/add-icon.png",array('height'=>"16",'width'=>"16",'alt'=>"Add A Staff Member")),@staff_new, $sf_user->getProfile()->getActiveEnrollment()->getWeek()->getCamp())?></h2>
        <table class="data-table" id="scout-table">
            <tbody>
<?php foreach($pager->getResults() as $i => $staff): ?>
            <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($staff->getLastName())?></td>
                <td><?php echo ucwords($staff->getFirstName())?></td>
                <td><?php echo $staff->getAge() ?></td>
                <td class="table-controls">
                    <div class="table-controls">
                      <?php echo link_to(
                              image_tag('icons/edit-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'edit'))
                              .'<span class="control-txt">edit</span>',
                              @staff_edit,$staff) ?>  
                      <?php echo link_to(
                              image_tag('icons/delete-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'delete'))
                              .'<span class="control-txt">delete</span>',
                              @staff_delete, $staff) ?>                        
                    </div>
                </td>
<?php endforeach; ?>
            </tr>
            </tbody>
            <?php include_partial('global/pager',array(
                'colspan'      =>  4,
                'module'       =>  'staff',
                'pager'        =>  $pager,
                'no_plural'    =>  true
            )) ?>            
        </table>
    </div>
</div>
