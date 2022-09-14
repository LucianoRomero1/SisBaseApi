<?php

namespace AppBundle\Controller;

use AppBundle\Base\BaseController;
use AppBundle\Base\BaseService;
use AppBundle\Handler\DefaultHandler;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    private $defaultHandler;
    private $baseService;

    public function __construct(DefaultHandler $defaultHandler, BaseService $baseService){
        $this->defaultHandler   = $defaultHandler;
        $this->baseService      = $baseService;
    }

    public function indexAction()
    {
        $entityManager  = $this->getEm();
        $user           = $this->getLoggedUser($entityManager);

        $data       = array(
            'status'    => 'success',
            'message'   => 'Im homepage',
            'data'      => $user
        );

        return $this->responseJson($data);
    }


}
