<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractController extends Controller
{
    protected function createResponse($entities)
    {
        $entities = $this->get('serializer')->serialize($entities, 'json', array('groups' => array($this->getGroup())));

        $response = new Response($entities);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    protected function isString(Request $req, $variableName)
    {
    	$value = $req->get($variableName);

        if(!isset($value)) {
        	return false;
        }

        if(!is_string($value)) {
            throw new BadRequestException($variableName . " should be a string");
        }

        return true;
    }

    abstract protected function getGroup();
}