<?php load_assets('camp') ?>
<?php load_assets('data-table') ?>
<?php include_partial('global/infobox',array('page'=>'camp')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Camp <?php echo strtoupper($camp->getDistrict()->getCode()).' '.ucwords($camp->getName()) ?></h2>
        <table class="data-table" id="camp-table">
            <tbody>
              <tr>
                <td>
                  <a class="lightbox" href="<?php echo url_for(@show_address,array('id'=>$camp->getAddress()->getID())) ?>?lightbox[width]=<?php echo sfConfig::get('app_lightbox_width') ?>&lightbox[height]=<?php echo sfConfig::get('app_lightbox_height') ?>">
                    <?php echo image_tag('/images/icons/map.png',array('width' => '20','height' => '21')) ?>
                  </a>
                </td>
              </tr>
<?php if(null != $camp->getPhone()): ?>
              <tr>
                <td>
                  <?php echo $camp->getPhone() ?>
                </td>
              </tr>
<?php endif; ?>              
<?php if(null != $camp->getFax()): ?>
              <tr>
                <td>
                  <?php echo $camp->getFax() ?>
                </td>
              </tr>
<?php endif; ?>
<?php /*if(null != $camp->getEmail()): ?>              
              <tr>
                <td>
                  <?php echo link_to(SCSS::encrypt_email($camp->getEmail()),'mailto:'.$this->getEmail()) ?>
                </td>
              </tr>
<?php endif; */ ?>
<?php if(null != $camp->getUrl()): ?>
              <tr>
                <td>
                  <a class="lightbox" href="<?php echo url_for($camp->getUrl()) ?>?lightbox[width]=<?php echo sfConfig::get('app_lightbox_width') ?>&lightbox[height]=<?php echo sfConfig::get('app_lightbox_height') ?>">
                    <?php echo image_tag('/images/icons/link.png', array('width' => '20', 'height' => '21')) ?>
                  </a>
                </td>
              </tr>
<?php endif; ?>              
            </tbody>
          </table>
    </div>
</div>