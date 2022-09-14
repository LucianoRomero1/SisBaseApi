<?php

namespace AppBundle\Base;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BaseController extends AbstractController
{

    public function getEm(){
        return $this->getDoctrine()->getManager();
    }

    public function getLoggedUser($em){
        $userLogged = $this->getUser()->getUsername();
        $user       = $em->getRepository(User::class)->findOneBy(["username"=>$userLogged]);

        return $user;
    }

    public function getActualDate(){
        $fechaActual=  new \DateTime(null, new \DateTimeZone('America/Argentina/Buenos_Aires'));
                
        return $fechaActual;
    }
    

    public function responseJson($data){
        $normalizers    = array(new GetSetMethodNormalizer());
        $encoders       = array("json"=> new JsonEncoder());
        
        $serializer     = new Serializer($normalizers, $encoders);
        $json           = $serializer->serialize($data, "json");

        $response       = new Response();
        $response->setContent($json);
        $response->headers->set("Content-Type", "application/json");

        return $response;
    }

     /* 
        Prepara la forma en que respondemos en todos los servicios.
        result = Respuesta json,
        error  = Error en string,
        info   = Información extra de result.
    */
    public function createResultResponse($result, $info = null){
        $response = new JsonResponse();
        $response->setData([
            "result" => $result,
            "error"  => null,
            "info"   => $info,
        ]);
        return $response;
    }

    /* 
        Prepara la forma en que respondemos en todos los servicios.
        result = Respuesta json,
        error  = Error en string,
        info   = Información extra de result.
    */
    public function createErrorResponse($error, $info = null){
        $response = new JsonResponse();
        $response->setData([
            "result" => null,
            "error"  => $error,
            "info"   => null
        ]);
        return $response;
    }

}