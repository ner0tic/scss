<fieldset class="settings-widget" id="leader-list-widget">
  <legend>leader list</legend>
  <div class="content">
    <table id="leader-list" class="data-table mini-data-table">
      <tbody>
        <?php /*foreach($w_l_pager as $x => $leader): ?>
        <tr class="<?php echo ($x % 2 ? 'even' : 'odd') ?>-row">
          <td>First Name</td>
          <td>Camp Name</td>
          <td>Week Num</td>
          <td class="remove"></td>
        </tr>
        <?php endforeach; */?>
        <tr class="odd-row">
          <td>First Name</td>
          <td>Camp Name</td>
          <td>Week Num</td>
          <td class="remove"></td>
        </tr>
        <tr class="even-row">
          <td>First Name</td>
          <td>Camp Name</td>
          <td>Week Num</td>
          <td class="remove"></td>
        </tr>        
      </tbody>
      <tfoot>
        <?php echo $form ?> 
      </tfoot>
    </table>
  </div>    
</fieldset>