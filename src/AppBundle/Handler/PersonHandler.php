<?php

namespace AppBundle\Handler;

use AppBundle\Base\BaseController;
use AppBundle\Base\BaseService;
use AppBundle\Entity\Persona;

class PersonHandler extends BaseController{
    
    private $baseService;

    public function __construct(BaseService $baseService)
    {
        $this->baseService = $baseService;
    }

    public function add_editWithoutSQL($form, $userM, $actualDate, $entityManager, $person = null){
        if(is_null($person)){
            $person = new Persona();
        }
        
        $person->setNombre($form["name"]);
        $person->setApellido($form["lastname"]);
        $person->setUsuarioM($userM);
        $person->setFechaM($actualDate);

        $entityManager->persist($person);
        $entityManager->flush();

        return $person;
    }

    public function setPerson($form, $userM, $entityManager, $person = null){

        $name           = $form["name"];
        $lastname       = $form["lastname"];
        $tableOracle    = "test_persona";
        $lastId         = $this->baseService->getMaxId($entityManager, $tableOracle);

        if(is_null($person)){
            $query          = "INSERT INTO $tableOracle (id, nombre, apellido, usuario_m, fecha_m) VALUES($lastId, '$name', '$lastname', '$userM', Sysdate)";
        }else{
            $id             = $person->getId();
            $query          = "UPDATE $tableOracle SET nombre = '$name', apellido = '$lastname', usuario_m = '$userM', fecha_m = Sysdate WHERE id = $id";
        }
        

        $this->baseService->setWithSQL($entityManager, $query);
    }

}