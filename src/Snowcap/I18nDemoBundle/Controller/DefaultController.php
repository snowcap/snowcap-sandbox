<?php

namespace Snowcap\I18nDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Snowcap\I18nBundle\Annotation\I18nRoute;

class DefaultController extends Controller
{
    /**
     * @I18nRoute("", i18n=false, name="snowcap_i18ndemo_default_index")
     * @Template
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('snowcap_i18ndemo_default_home'));
    }

    /**
     * @I18nRoute("", name="snowcap_i18ndemo_default_home")
     * @Template
     */
    public function homeAction()
    {
        return array();
    }

    /**
     * @I18nRoute("about", name="snowcap_i18ndemo_default_about")
     * @Template
     */
    public function aboutAction()
    {
        return array();
    }

    /**
     * @I18nRoute("team", name="snowcap_i18ndemo_default_team")
     * @Template
     */
    public function teamAction()
    {
        return array();
    }
}
