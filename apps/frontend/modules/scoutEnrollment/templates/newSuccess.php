<?php load_assets('enroll') ?>
<?php include_partial('global/infobox',array('page'=>'enrollScout')) ?>
<div class="box main-content">
    <div class="box-content datagrid">
        <h2>Enroll A Scout</h2>
            <form method="post" action="<?php echo url_for(@scout_enroll,array(
                'district_slug' =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                'camp_slug'     =>  $sf_user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug(),
                'week_slug'     =>  $sf_user->getProfile()->getActiveEnrollment()->getWeek(),
                'troop_slug'    =>  $sf_user->getProfile()->getActiveEnrollment()->getTroop()->getSlug())) ?>" class="clean-form">
            <fieldset>
                <p>
                    <label>
                        Scout
                        <span>Choose one to enroll</span>
                    </label>
                    <?php echo $form['scout_id']->render() ?>
                </p>
                <ol class="left">
                <?php $periods = $sf_user->getProfile()->getActiveEnrollment()->getWeek()->getPeriods(); foreach($periods as $i => $period): ?>
                <?php echo ($i==(ceil($periods->count()/2))? '</ol><ol>' : '')?>
                    <li>
                        <p>
                            <label>
                                <?php echo ucwords($period->getLabel()) ?>
                                <span><?php echo $period->getTte()? 'This is an optional period': 'Choose a class'; ?></span>
                            </label>
                            <?php echo $form['ClassesByPeriod'][$i]['class_id']->render() ?>
                        </p>
                    </li>
                <?php endforeach ?>
                </ol>
                <input type="submit" class="orangeButton" id="enrollSubmit" value="Enroll" />
                <?php echo $form->renderHiddenFields() ?>
            </fieldset>
        </form>
    </div>
</div>
