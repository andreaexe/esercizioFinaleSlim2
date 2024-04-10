<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require_once("./Classe.php");

class ApiAlunniController{

    function index(Request $request, Response $response, $args) {
        $classe = new Classe("5cia");
        $response->getBody()->write(json_encode($classe));
        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

    function show(Request $request, Response $response, $args) {
        $classe = new Classe("5cia");

        if ($classe->getApiAlunno($args["name"]) == null) {
            $response->getBody()->write("Alunno non trovato");
            return $response->withHeader("Content-Type", "application/json")->withStatus(404);
        }else{
            $response->getBody()->write(json_encode($classe->getApiAlunno($args["name"])));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        }
    }

}