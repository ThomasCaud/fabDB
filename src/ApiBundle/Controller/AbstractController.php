<?php
namespace ApiBundle\Controller;

use ApiBundle\Exception\BadRequestException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;

abstract class AbstractController extends Controller
{
    protected function createResponse($entities)
    {
        $context = new SerializationContext();
        $context->setGroups([$this->getGroup()]);

        $entities = $this->get('jms_serializer')->serialize(
            $entities,
            'json',
            $context
        );

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

    protected function isInteger(Request $req, $variableName, $gt = 0, $lt = 999999)
    {
        $value = $req->get($variableName);

        if(!isset($value)) {
            return false;
        }

        if(!is_int($value)) {
            throw new BadRequestException($variableName . " should be an integer");
        }

        if($value < $gt || $value > $lt) {
            throw new BadRequestException($variableName . " should be between " . $gt . " and " . $lt);
        }

        return true;
    }

    protected function isFloat(Request $req, $variableName, $gt = 0, $lt = 999999)
    {
        $value = $req->get($variableName);

        if(!isset($value)) {
            return false;
        }

        if(!is_float($value) && !is_integer($value)) {
            throw new BadRequestException($variableName . " should be a float value");
        }

        if($value < $gt || $value > $lt) {
            throw new BadRequestException($variableName . " should be between " . $gt . " and " . $lt);
        }

        return true;
    }

    abstract protected function getGroup();
}