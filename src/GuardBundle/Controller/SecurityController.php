<?php

namespace GuardBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
        $helper = $this->get('security.authentication_utils');

        return new JsonResponse([
            'last_username' => $helper->getLastUsername(),
            'error'         => $helper->getLastAuthenticationError()
        ]);

    }

    public function loginCheckAction()
    {

    }

    public function logoutAction()
    {

    }
}
