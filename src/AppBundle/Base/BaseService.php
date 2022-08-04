<?php

namespace AppBundle\Base;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BaseService extends AbstractController
{
    public function getMaxId($entityManager, $table){
        $connection = $entityManager->getConnection();
        //reemplazar la palabra ID por la PK (Primary key) que use esa tabla, en este caso es ID, pero puede ser codigo o otras
        $statement = $connection->prepare(
            "SELECT NVL(MAX(t.id), 0) + 1 AS lastId FROM $table t"
        );

        $statement->execute();
        $resultado[] = $statement->fetchAll();

        $resultado = $resultado[0][0]["LASTID"];

        return intval($resultado);
    }

    public function setWithSQL($entityManager, $query){
        //Ejecuta el INSERT o el UPDATE de alguna tabla
        $connection = $entityManager->getConnection();

        $statement = $connection->prepare(
            "$query"
        );

        $statement->execute();
    }   
}