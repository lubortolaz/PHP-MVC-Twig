<?php
namespace App\Controller;

/**
 * Manage the home page
 */
class DefaultController extends AbstractController
{

    public function index()
    {
        $this->render->display('default/index.html.twig', [
            'current' => 'This is the home page',
        ]);
    }

    public function error404()
    {
        $this->render->display('default/404.html.twig');
    }
}