<?php

namespace AppBundle\Controller;

use AppBundle\Base\BaseController;
use AppBundle\Handler\PersonaHandler;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/persona")
 */
class PersonaController extends BaseController{

    private $personaHandler;

    public function __construct(PersonaHandler $personaHandler)
    {
        $this->personaHandler = $personaHandler;
    }

    /**
     * @Route("/get_all", name="get_all_persona")
     */
    public function get_all(){

    }

    /**
     * @Route("/add", name="add_persona")
     */
    public function add(){

    }

    /**
     * @Route("/edit/{id}", name="edit_persona")
     */
    public function edit(){

    }

    /**
     * @Route("/delete/{id}", name="delete_persona")
     */
    public function delete(){

    }

    
}