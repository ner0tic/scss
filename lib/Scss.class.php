<?php
// lib/Scss.class.php
class Scss {
    const DEACTIVATED_USER = 0;
    const TROOP_USER       = 1;
    const CAMP_STAFF       = 2;
    const CAMP_ADMIN       = 3;
    const DISTRICT_STAFF   = 4;
    const SITE_ADMIN       = 5;
    const ROOT_ADMIN       = 6;

    static public function slugify($text) {
        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);
        // trim and lowercase
        $text = strtolower(trim($text, '-'));
        return $text;
    }
    static public function deslugify($text,$ucwords=false) {
        $text = str_replace('-',' ',$text);
        if($ucwords)    $text = ucwords($text);
        return $text;
    }

    static public function genSlugArray($slugs=array(),$yaml=false) {
      $arr = array(); $user = sfContext::getInstance()->getUser();
      foreach($slugs as $slug) {
        switch($slug) {
          case 'cy':
            $arr['country_slug']  = $request->getParameter('country_slug', $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getCountry()->getSlug());
            break;
          case 'zn':
            $arr['zone_slug']     = $request->getParameter('zone_slug',    $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getSlug());
            break;
          case 'dt':
            $arr['district_slug'] = $request->getParameter('district_slug',$user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug());
            break;
          case 'cp':
            $arr['camp_slug']     = $request->getParameter('camp_slug',    $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug());
            break;
          case 'wk':
            $arr['week_slug']     = $request->getParameter('week_slug',    $user->getProfile()->getActiveEnrollment()->getWeek()->getSlug());
            break;
          case 'pd':
            $arr['period_slug']   = $request->getParameter('period_slug',  null);
          case 't':
            $arr['troop_slug']    = $request->getParameter('troop_slug',   $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug());
            break;
          case 'pl':
            $arr['patrol_slug']   = $request->getParameter('patrol_slug',  null);
            break;
          case 'sc':
            $arr['scout_slug']    = $request->getParameter('scout_slug',   null);
          case 'cr':
            $arr['course_slug']   = $request->getParameter('course_slug',  null);
            break;
        }
      }
      if($yaml) {
        echo '{';
        foreach($arr as $k => $v) echo "$k: $v, ";
        echo '}';
      } else {
        return $arr;
      }
    }

    static public function generateNavbar($lvl = Scss::DEACTIVATED_USER) {
        if(sfContext::getInstance()->getUser()->isAuthenticated())   $lvl = sfContext::getInstance()->getUser()->getProfile()->getAccessLevel();
        $request = sfContext::getInstance()->getRequest();
        $user = sfContext::getInstance()->getUser();
        $menu = array();
        /*switch($lvl) {
          case Scss::TROOP_USER:

            $menu[] = array(
                        'name'  =>  'Scout Management',
                        'url'   =>  @scout_list_by_troop
                        'slugs' =>  SCSS::genSlugs(array('cy','zn','dt','tp'),false),
              'name'      =>  'Scout Enrollment',
                        'url'       =>  @scout_enroll),
                        'params'    =>  array(),
                        array(
                    'name'      =>  'Troop Enrollment',
                    'url'       =>  @troop_enroll),
                    'params'    =>  array(),
                        array(
                    'name'      =>  'Reports',
                    'url'       =>  @reports),
                    'params'    =>  array());
            break;
          case Scss::CAMP_STAFF:
            $menu = array(array(
                    'name'      =>  'Class Attendance',
                    'url'       =>  @class_attend),
                    'params'    =>  array(),
                        array(
                    'name'      =>  'Cabin Assignments',
                    'url'       =>  @list_cabin),
                    'params'    =>  array(),
                        array(
                    'name'      =>  'Reports',
                    'url'       =>  @reports),
                    'params'    =>  array());
              break;
          case Scss::CAMP_ADMIN:
            $menu = array(array(
                    'name'      =>  'Scout Enrollment',
                    'url'       =>  @scout_enroll),
                    'params'    =>  array(),
                        array(
                    'name'      =>  'Troop Reservation',
                    'url'       =>  @troop_enroll),
                    'params'    =>  array(),
                        array(
                    'name'      =>  'Staff Management',
                    'url'       =>  @list_staff),
                    'params'    =>  array(),
                        array(
                    'name'      =>  'Reports',
                    'url'       =>  @reports),
                    'params'    =>  array());
            break;
          case Scss::SITE_ADMIN:
            $menu = array(array(
                    'name'      =>  'Scout Enrollment',
                    'url'       =>  @scout_enroll,
                    'params'    =>  array('country_slug'=>$slugs['country_slug'],'zone_slug'=>$slugs['zone_slug'],'district_slug'=>$slugs['district_slug'],'week_slug'=>$slugs['week_slug'],'camp_slug'=>$slugs['camp_slug'])),
                        array(
                    'name'      =>  'Troop Enrollment',
                    'url'       =>  @troop_enroll),
                    'params'    =>  array(),
                        array(
                    'name'      =>  'Reports',
                    'url'       =>  @reports,
                    'params'    =>  array()));//'country_slug'=>$slugs['country_slug'],'zone_slug'=>$slugs['zone_slug'],'district_slug'=>$slugs['district_slug'],'troop_slug'=>$slugs['troop_slug'])));
                break;
            case Scss::ROOT_ADMIN:
                $menu = array(array(
                    'name'      =>  'Scout Enrollment',
                    'url'       =>  @scout_enroll,
                    'params'    =>  array('country_slug'=>$slugs['country_slug'],'zone_slug'=>$slugs['zone_slug'],'district_slug'=>$slugs['district_slug'],'week_slug'=>$slugs['week_slug'],'camp_slug'=>$slugs['camp_slug'])),
                        array(
                    'name'      =>  'Troop Enrollment',
                    'url'       =>  @troop_enroll,
                    'params'    =>  array()),//'country_slug'=>$slugs['country_slug'],'zone_slug'=>$slugs['zone_slug'],'district_slug'=>$slugs['district_slug'],'troop_slug'=>$slugs['troop_slug'])),
                        array(
                    'name'      =>  'Reports',
                    'url'       =>  @reports,
                    'params'    =>  array()));//'country_slug'=>$slugs['country_slug'],'zone_slug'=>$slugs['zone_slug'],'district_slug'=>$slugs['district_slug'],'troop_slug'=>$slugs['troop_slug'])));
                break;
            default:
                $menu = array(array('name'=>'register','url'=>@sf_guard_signup,'params'=>array()),array('name'=>'login','url'=>@sf_guard_signin,'params'=>array()));
                break;
        }*/
        $output = '<li class="tab">'.link_to('home',@dashboard).'</li>';
        foreach($menu as $tab)  $output.= '<li class="tab">'.link_to($tab['name'],$tab['url'],$tab['params']);
        if(sfContext::getInstance()->getUser()->isAuthenticated())
            $output .= '<li class="tab tab-right menu_class"><a href="#" >account settings</a></li>';
            $output .= '<ul class="the_menu">';
            $output .= '    <li>'.link_to('Logout',@sf_guard_signout).'</li>';
            $output .= '    <li>'.link_to('Change Password',@sf_guard_password).'</li>';
            $output .= '    <li>'.link_to('Edit Profile',@edit_profile).'</li>';
            $output .= '</ul> s</li>';
        echo $output;
    }
    static public function getTroopListByAdmin() {
        switch(sfContext::getInstance()->getUser()->getProfile()->getAccessLevel()) {
            default:
                return Doctrine::getTable('ScssTroop')->createQuery('t')->orderBy('t.number ASC')->execute();
                break;

        }
    }

    public function getSlugArray($_slugs) {
        $slugs = array(
            'country'  => $request->getParameter('country_slug',   $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getCountry()->getSlug()),
            'zone'     => $request->getParameter('zone_slug',      $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getZone()->getSlug()),
            'district' => $request->getParameter('district_slug',  $user->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getSlug()),
            'week'     => $request->getParameter('week_slug',      $user->getProfile()->getActiveEnrollment()->getWeek()->getSlug()),
            'camp'     => $request->getParameter('camp_slug',      $user->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getSlug()),
            'troop'    => $request->getParameter('troop_slug',     $user->getProfile()->getActiveEnrollment()->getTroop()->getSlug()),
        );
        $s = array();
        foreach($slugs as $slug) {
            if(!in_array($slug,$s)&&is_array($slug,$_slugs))    array_push($s,$slug);
        }
        return $s;
    }
    
    
    public static function encrypt_email($e) {
      $r = array();
      $r['@'] = '[at]';
      $r['.'] = '[dot]';
      
      foreach($r as $k => $v) {
        $e = str_replace($k,$v,$e);
      }
      return $e;
    }

}
