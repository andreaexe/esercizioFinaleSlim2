<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require_once("./Classe.php");

class AlunniController{

    function index(Request $request, Response $response, $args) {
        $classe = new Classe("5cia");
        $response->getBody()->write($classe->toString());
        return $response;
    }

    function show(Request $request, Response $response, $args) {
        $classe = new Classe("5cia");
        $response->getBody()->write($classe->getApiAlunno($args["name"]));
        return $response;
    }

    function createAlunno(Request $request, Response $response, $args)
    {
        $body = $request->getBody()-> getContents();
        $parseBody = json_decode($body,true);

        $nome = $parseBody['nome'];
        $cognome = $parseBody['cognome']; 
        $eta = $parseBody['eta'];

        $alunno = new Alunno($nome, $cognome, $eta);
        
        $response->getBody()->write($alunno->toString());

        return $response ->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    function deleteAlunno(Request $request, Response $response, $args)
    {
        $class = new Classe();
        $body=$request->getBody()-> getContents();
        $parseBody=json_decode($body,true);

        $alunno = $class->find($args['nome']);
        if($alunno != null)
        {
            $class->deleteAlunno($args['nome']);
            return $response ->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        else
        {
            $response->getBody()->write("Alunno non presente");
            return $response ->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

    function updateAlunno (Request $request, Response $response, $args)
    {
        $body=$request->getBody()-> getContents();
        $parseBody=json_decode($body,true);
        $class= new Classe();
        $alunno = $class->find($args['nome']);
        if($alunno != null)
        {
            $alunno->setNome($parseBody['nome']);
            $alunno->setCognome($parseBody['cognome']);
            $alunno->setEta($parseBody['eta']);
            $response->getBody()->write($alunno->toString());
            return $response ->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        else
        {
            $response->getBody()->write("Alunno non presente");
            return $response ->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

}