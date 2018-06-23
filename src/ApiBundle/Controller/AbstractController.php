<?php
namespace ApiBundle\Controller;

use ApiBundle\Exception\BadRequestException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

abstract class AbstractController extends Controller
{
    protected function createResponse($entities)
    {
        $groups = ["common"];

        // Récupération du groupe courant, si existant
        $request = Request::createFromGlobals();
        $authTokenHeader = $request->headers->get('X-Auth-Token');
        
        $login = "";
        if($authTokenHeader) {
            $authToken = $this->getDoctrine()->getRepository('ApiBundle:AuthToken')->findOneByValue($authTokenHeader);
            if($authToken) { 
                $login = $authToken->getAuth()->getLogin();
                $groups[] = $login;
            }
        }

        // Ajout de tous les groupes pour le compte root
        if($login == "root") {
            $groups[] = "connectedobjects";
            $groups[] = "usersprofile";
            $groups[] = "marketplace";
            $groups[] = "blockchain";
            $groups[] = "userscommunication";
            $groups[] = "userskills";
        }

        $context = new SerializationContext();
        $context->setGroups($groups);
        $context->enableMaxDepthChecks();

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

    abstract public function optionsAction(Request $req);
}