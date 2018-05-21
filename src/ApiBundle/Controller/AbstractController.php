<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends Controller
{
    protected function createResponse($entities)
    {
        $entities = $this->get('serializer')->serialize($entities, 'json');

        $response = new Response($entities);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
}