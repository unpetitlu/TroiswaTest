<?php

namespace Troiswa\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Abstract Controller
 *
 */
abstract class AbstractController extends Controller
{

    /**
     * Lists all Movie entities.
     *
     */
    public function breadcrumbs($breadtab)
    {
    	$breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->generateUrl("actor"));
        foreach ($breadtab as $key => $value) {
        	if ($value)
        		$breadcrumbs->addItem($key, $this->generateUrl($value));
        	else
        		$breadcrumbs->addItem($key);
        }
    }

}