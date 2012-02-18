<?php load_assets('patrol') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'patrols')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Patrols&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Patrol" />',@patrol_new, $sf_user->getProfile()->getActiveEnrollment()->getTroop())?></h2>
        <table class="data-table" id="scout-table">
            <tbody>
<?php foreach($pager->getResults() as $i => $patrol): ?>
              <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($patrol->getName())?></td>
                <td><?php echo image_tag("/images/user_files/logos/patrols/".$patrol->getImg('default.png'),array('height'=>"48",'alt'=>$patrol->getName())) ?></td>
                <td><?php echo $patrol->getScoutCount() ?>&nbsp;Scouts</td>
                <td class="table-controls">
                    <div class="table-controls">
                      <?php echo link_to(
                              image_tag('icons/edit-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'edit'))
                              .'<span class="control-txt">edit</span>',
                              @patrol_edit,$patrol) ?>  
                      <?php echo link_to(
                              image_tag('icons/delete-icon.png', array(
                                  'width'   =>    '16',
                                  'height'  =>    '16',
                                  'alt'     =>    'delete'))
                              .'<span class="control-txt">delete</span>',
                              @patrol_delete, $patrol) ?>                        
                    </div>
                </td>
              </tr>
<?php endforeach; ?>              
            </tbody>
            <?php include_partial('global/pager',array(
                'colspan'      =>  4,
                'module'          =>  'patrol',
                'pager'           =>  $pager
            )) ?>   
        </table>
    </div>
</div>
