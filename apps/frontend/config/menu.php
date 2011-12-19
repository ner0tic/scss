<?php
$user = sfContext::getInstance()->getUser();
$request = sfContext::getInstance()->getRequest();
$menu = new ddNavMenu('navbar');
$menu->addChild('home',                                         @homepage)
      ->requiresNoAuth(true);
$menu->addChild('home',                                         @dashboard)
      ->setCredentials(array('troopAdmin','campStaff','campAdmin','districtAdmin','siteAdmin'));
if(!$user->isAuthenticated()) {
  // non auth menu (guest) [DEACTIVATED_USER]
  $menu->addChild('sign in',                                    @sf_guard_signin)
        ->requiresNoAuth(true);
  $menu->addChild('sign up',                                    @sf_guard_signup)
        ->requiresNoAuth(true);
  $menu->addChild('about',                                      @about)
        ->requiresNoAuth(true);
  $menu->addChild('contact',                                    @contact)
        ->requiresNoAuth(true);
} else {
  $menu->addChild('scout management',                           @scouts_by_troop    )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(), 
                              'troop_slug'        =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('troopAdmin','campAdmin'));
  $menu->addChild('patrol management',                          @patrols_by_troop)
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'troop_slug'        =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('troopAdmin'));
  $menu->addChild('troop settings',                             @troop_mgmt)
        ->setCredentials(array('troopAdmin'));
  $menu->addChild('troop management',                           @troop_mgmt)
        ->setCredentials(array('campAdmin','districtAdmin','siteAdmin'));
  $menu->addChild('camp settings',                              @camp_mgmt)
        ->setCredentials(array('campAdmin'));
  $menu->addChild('camp management',                            @camp_mgmt)
        ->setCredentials(array('districtAdmin','siteAdmin'));
  $menu->addChild('district settings',                          @district_mgmt)
        ->setCredentials(array('districtAdmin'));
  $menu->addChild('district management',                        @district_mgmt)->setCredentials(array('siteAdmin'));
  $menu->addChild('misc settings',                              @misc_settings)->setCredentials(array('siteAdmin'));
  $menu->addChild('class management',                           @class_mgmt)->setCredentials(array('campStaff'))->setParameters(array('district_slug'=>$user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),'camp_slug'=>$user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug(),'week_slug'=>$user->getProfile()->getActiveEnrollment()->getWeek()->getSlug()));
  $menu->addChild('staff information',                          @staff_info)->setCredentials(array('campStaff'))->setParameters(array('district_slug'=>$user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),'camp_slug'=>$user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug(),'week_slug'=>$user->getProfile()->getActiveEnrollment()->getWeek()->getSlug()));
  $menu->addChild('reports',                                    @reports)->setCredentials(array('troopAdmin','campAdmin','districtAdmin','siteAdmin'));
  // scout menu
  $menu['scout management']->addChild('add a scout',            @scout_new          )->setParameters(array('district_slug'=>$user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),'troop_slug'=>$user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()));
  $menu['scout management']->addChild('enroll scouts',          @scout_enroll       )->setParameters(array('district_slug'=>$user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),'camp_slug'=>$user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug(),'week_slug'=>$user->getProfile()->getActiveEnrollment()->getWeek()->getSlug()));
  // patrol menu
  $menu['patrol management']->addChild('add a patrol',          @patrol_new         )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'troop_slug'        =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('troopAdmin'));
  // troop settings menu
  $menu['troop settings']->addChild('manage troop photos',      @troop_photo        );
  $menu['troop settings']->addChild('next season',              @troop_register     )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('troopAdmin'));
  $menu['troop settings']->addChild('scoutmaster information',  @sm_info            )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'troop_slug'        =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('troopAdmin'));
  // troop management menu
  $menu['troop management']->addChild('manage scouts',          @scouts_by_troop   )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'troop_slug'        =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('campAdmin','districtAdmin','siteAdmin'));
  $menu['troop management']->addChild('manage patrols',         @patrols_by_troop   )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'troop_slug'        =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('campAdmin','districtAdmin','siteAdmin'));
  $menu['troop management']->addChild('manage registration',    @troop_register     )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('campAdmin'));
  $menu['troop management']->addChild('manage registrations',   @troop_register     )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('districtAdmin','siteAdmin'));
  // camp staff menu
  $menu['class management']->addChild('class list',             @report_class_enroll)
        ->setCredentials(array('campStaff'));
  $menu['class management']->addChild('log attendance',         @class_attendance   )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug(),
                              'week_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getSlug(),
                              'class_slug'        =>            $request->getParameter('class_slug')))
        ->setCredentials(array('campStaff'));
  // staff info menu
  $menu['staff information']->addChild('night out request',     @form_night_out     )
        ->setCredentials(array('campStaff'));
  $menu['staff information']->addChild('housing change request',@form_cabin_change  )
        ->setCredentials(array('campStaff'));
  // camp settings menu
  $menu['camp settings']->addChild('manage classes',            @classes_by_camp    )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug(),
                              'week_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getSlug()))
        ->setCredentials(array('campAdmin'));
  $menu['camp settings']->addChild('manage campsites',          @campsites_by_camp  )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('campAdmin'));
  $menu['camp settings']->addChild('manage cabins',             @cabins_by_camp     )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('campAdmin'));
  $menu['camp settings']->addChild('manage areas',              @areas_by_camp      )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('campAdmin'));
  $menu['camp settings']->addChild('camp details',              @camp_edit          )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('campAdmin'));          
  // camp management menu
  $menu['camp management']->addChild('manage classes',          @classes_by_camp    )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug(),
                              'week_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getSlug()))
        ->setCredentials(array('districtAdmin','siteAdmin'));
  $menu['camp management']->addChild('manage areas',            @areas_by_camp      )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('districtAdmin','siteAdmin'));          
  $menu['camp management']->addChild('manage campsites',        @campsites_by_camp  )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('districtAdmin','siteAdmin'));
  $menu['camp management']->addChild('manage cabins',           @cabins_by_camp     )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('districtAdmin','siteAdmin'));
  $menu['camp management']->addChild('manage staff',            @staff_by_camp      )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('districtAdmin','siteAdmin'));
  $menu['camp management']->addChild('camp details',            @camp_edit          )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug(),
                              'camp_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()))
        ->setCredentials(array('districtAdmin','siteAdmin'));
  // district settings menu
  $menu['district settings']->addChild('manage camps',          @camps_by_district  )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getSlug()))
        ->setCredentials(array('districtAdmin'));
  $menu['district settings']->addChild('district details',      @district_edit      )
        ->setParameters(array('country_slug'      =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getCountry()->getSlug(),
                              'zone_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getSlug(),
                              'district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getSlug()))
        ->setCredentials(array('districtAdmin'));
  // district management menu
  $menu['district management']->addChild('manage camps',        @camps_by_district  )
        ->setParameters(array('district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getSlug()))
        ->setCredentials(array('siteAdmin'));
  $menu['district management']->addChild('district details',    @district_edit      )
        ->setParameters(array('country_slug'      =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getCountry()->getSlug(),
                              'zone_slug'         =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getSlug(),
                              'district_slug'     =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getSlug()))
        ->setCredentials(array('siteAdmin'));
  // misc settings menu
  $menu['misc settings']->addChild('manage districts',          @district           )
          ->setParameters(array('country_slug'    =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getCountry()->getSlug(),
                                'zone_slug'=>$user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getSlug()))
          ->setCredentials(array('siteAdmin'));
  $menu['misc settings']->addChild('manage zones',              @zone               )
        ->setParameters(array('country_slug'      =>            $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getDistrict()->getZone()->getCountry()->getSlug()))
        ->setCredentials(array('siteAdmin'));
  $menu['misc settings']->addChild('manage countries',          @country            )
        ->setCredentials(array('siteAdmin'));;
  //$menu['misc settings']->addChild('language settings',         @);
  //$menu['misc settings']->addChild('site settings',             @);
  // reports menu
  $menu['reports']->addChild('meritbadge form',                 @forms_mb           )
        ->requiresAuth(true);
  $menu['reports']->addChild('alphabetical list',               @report_alpha       )
        ->setCredentials(array('troopAdmin','campAdmin'));
  $menu['reports']->addChild('list by patrol',                  @report_by_patrol   )
        ->setCredentials(array('troopAdmin','campAdmin','districtAdmin','siteAdmin'));
  $menu['reports']->addChild('sm master schedule',              @report_sm_master   )
        ->setCredentials(array('troopAdmin','campAdmin','districtAdmin','siteAdmin'));
  $menu['reports']->addChild('staff list',                      @report_staff       )
        ->setCredentials(array('campAdmin','districtAdmin','siteAdmin'));
  $menu['reports']->addChild('class list',                      @report_class       )
        ->setCredentials(array('campAdmin','districtAdmin','siteAdmin'));
}
?>
