<?php

namespace App\Controller;

use App\Interface\ControllerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController implements ControllerInterface
{
    abstract public function add(Request $request): void;

    protected function saveEntity($entity, $repository): void
    {
        $repository->save($entity, true);
    }

    protected function redirectAfterAdd($route, $id = null): Response
    {
        if ($id !== null) {
            return $this->redirectToRoute(sprintf('%s_show', $route), ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute(sprintf('%s_index', $route), [], Response::HTTP_SEE_OTHER);
    }
}
