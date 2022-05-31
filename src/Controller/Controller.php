<?php

namespace src\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class Controller
{
    protected $twig;

    public function preloadTwig()
    {
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);

        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('BASE_PATH', BASE_PATH);
        $this->twig->addGlobal('HTTP_HOST', HTTP_HOST);
    }

    public function home(Request $request, Response $response, $args)
    {
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('home.twig.html'));
        return $response;
    }
}
