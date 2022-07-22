<?php

namespace AppBundle\Controller;

use AppBundle\Base\BaseController;
use AppBundle\Base\BaseService;
use AppBundle\Handler\DefaultHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    private $defaultHandler;
    private $baseService;

    public function __construct(DefaultHandler $defaultHandler, BaseService $baseService){
        $this->defaultHandler   = $defaultHandler;
        $this->baseService      = $baseService;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->setBreadCrumbs();
        $entityManager = $this->getEm();
        
        return $this->render('default/index.html.twig');
    }

      /**
     * @Route("/example", name="example")
     */
    public function exampleAction()
    {
        $this->setBreadCrumbs("Ejemplo", "example");
        $entityManager = $this->getEm();

        return $this->render('default/example.html.twig');
    }

}
