<?php load_assets('class') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'courses')) ?>
<script>
    $('.nav-bar ul li').removeClass('active');
</script>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Courses&nbsp;<?php echo link_to('<img src="/images/icons/add-icon.png" height="16" width="16" alt="Add A Course" />',@course_add) ?></h2>
        <table class="data-table" id="course-table">
            <tbody>
<?php foreach($courses as $i => $course): ?>
            <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
                <td><?php echo ucwords($course->getLabel())?></td>
                <td><?php echo $course->getCamp()->getName() ?></td>
                <td class="table-controls">
                    <div class="table-controls">
                        <a href="<?php echo url_for('course/edit?id='.$course->getId())?>">
                            <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                            <span class="control-txt">edit</span>
                        </a>
                        <a href="<?php echo url_for('course/delete?id='.$course->getId())?>">
                            <img src="/images/icons/delete-icon.png" width="16" height="16" alt="delete" />
                            <span class="control-txt">delete</span>
                        </a>
                    </div>
                </td>
<?php endforeach; ?>
            </tr>
        </table>
    </div>
</div>
