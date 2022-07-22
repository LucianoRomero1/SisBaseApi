<?php

namespace AppBundle\Controller;

use AppBundle\Base\BaseController;
use AppBundle\Entity\Persona;
use AppBundle\Handler\PersonHandler;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/person")
 */
class PersonController extends BaseController{

    private $personHandler;

    public function __construct(PersonHandler $personHandler)
    {
        $this->personHandler = $personHandler;
    }

    /**
     * @Route("/get_all", name="get_all_people")
     */
    public function get_all(){
        $this->setBreadCrumbs("Listado de personas", "get_all_people");
        $entityManager  = $this->getEm();
        $people         = $entityManager->getRepository(Persona::class)->findBy(array(), ["id"=>"DESC"]);

        return $this->render("person/get_all.html.twig", array(
            "people" => $people
        ));
    }

    /**
     * @Route("/add", name="add_person")
     */
    public function add(Request $request){
        $this->setBreadCrumbs("Cargar persona", "add_person");
        $entityManager  = $this->getEm();
        $userM          = $this->getUser()->getUsername();
        //$actualDate     = $this->getActualDate();

        $form = $request->get("Person");
        if(!is_null($form)){
            //Usar este si hago los insert de la manera tradicional con Symfony
            //$this->personHandler->add_editWithoutSQL($form, $userM, $actualDate, $entityManager);
            $this->personHandler->setPerson($form, $userM, $entityManager);

            $this->addFlash(
                'notice',
                'Se cargó correctamente el registro' 
            );

            return $this->redirectToRoute('get_all_people');
        }

        return $this->render("person/add_edit.html.twig", array(

        ));
    }

    /**
     * @Route("/edit/{id}", name="edit_person")
     */
    public function edit(Request $request, $id){
        $this->setBreadCrumbsWithId("Editar persona", "edit_person", $id);
        $entityManager  = $this->getEm();
        $person         = $entityManager->getRepository(Persona::class)->find($id);
        $userM          = $this->getUser()->getUsername();
        //$actualDate     = $this->getActualDate();

        $form = $request->get("Person");
        if(!is_null($form)){
            //Manera tradicional 
            //$this->personHandler->add_editWithoutSQL($form, $userM, $actualDate, $entityManager, $person);
            $this->personHandler->setPerson($form, $userM, $entityManager, $person);

            $this->addFlash(
                'notice',
                'Se editó correctamente el registro' 
            );

            return $this->redirectToRoute('get_all_people');
        }

        return $this->render("person/add_edit.html.twig", array(
            "person" => $person
        ));
    }

    /**
     * @Route("/delete/{id}", name="delete_person")
     */
    public function delete($id){
        //This function is called by some Ajax from JavaScript
        $entityManager  = $this->getEm();
        $person         = $entityManager->getRepository(Persona::class)->find($id);

        try{
            $entityManager->remove($person);
            $entityManager->flush();

            return new JsonResponse(['success' => true]);

        }catch(\Exception $e){
            return $this->createErrorResponse("No se pudo eliminar el registro $e", "");
        }
    }

    
}