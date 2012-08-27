<?php

namespace Scss\GeographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Scss\GeographyBundle\Entity\Region;
use Scss\GeographyBundle\Form\Type\RegionType;

class RegionController extends Controller
{
    public function indexAction() {
        return $this->render('ScssGeographyBundle:Region:index.html.twig');
    }
    
    public function newAction() {
        $region = new Region();
        $form = $this->createForm(new RegionType(), $region);
        return $this->render('ScssGeographyBundle:Region:new.html.twig', array('form'=>$form));
    }
}

