<!-- // apps/frontend/modules/sfGuardUser/templates/_render.php -->
<ul class="menu">
  <?php foreach($menu as $name => $child): ?>
    <?php // if(array_key_exists(($child['requires_auth']) && !$user->isAuthenticated()):?>
    <li class="menu-item <?php echo (array_key_exists('children',$child) && is_array($child['children'])) ? 'has-sub-menu':'' ?>" id="<?php echo str_replace('_','-',$name)?>-menu-item">
      <?php //echo link_to((array_key_exists($child['label'])?$child['label']:str_replace('_','-',$name)),$child['route'],$child['parameters']) ?>
      <?php if(array_key_exists('children',$child) && is_array($child['children'])): ?>
        <ul class="sub-menu">
        <?php foreach($child as $n => $baby): ?>
          <li class="menu-item" id="<?php echo str_replace('_','-',$n)?>-menu-item">
            <?php //echo 'label: '.$baby['label'].'<br />'; echo 'parameters: '.is_array($baby['parameters']) ?>
            <?php echo link_to((array_key_exists('label',$baby)?$baby['label']:str_replace('_','-',$n)),$baby['route'],(array_key_exists('parameters',$baby)?$baby['parameters']:array())) ?>
          </li>
        <?php endforeach ?>
        </ul>
      <?php endif ?>
    </li>
  <?php endforeach ?>
  </ul>
