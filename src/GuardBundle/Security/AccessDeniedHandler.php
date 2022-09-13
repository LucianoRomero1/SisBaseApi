<?php

namespace GuardBundle\Security;

use AppBundle\Base\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler extends BaseController implements AccessDeniedHandlerInterface
{
    private $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $stringProject  = $this->projectDir;
        $projectName    = explode('\\', $stringProject);

        //Dentro del [3] está el nombre del proyecto
        return $this->render('error/message.html.twig', array(
            'projectName' => $projectName[3]
        ));
    }
}