<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\AuthToken;
use ApiBundle\Entity\Auth;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use \Datetime;


class AuthTokenController extends AbstractController
{
    protected function getGroup() {
        return "auth-token";
    }

    /**
     * @Rest\Post(
     *      path = "/auth-token",
     * )
     */
    public function createAction(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $body = (array)json_decode($req->getContent());

        $login = $body['login'];
        $password = $body['password'];

        if( !isset($password) || !isset($login) || empty($login) || empty($password) )
        {
           throw new BadRequestException("The field 'login' and 'password' are required."); 
        }

        if( !$this->isString($req,"login") || !$this->isString($req,"password") )
        {
           throw new BadRequestException("The field 'login' and 'password' must be string."); 
        }

        $auth = $em->getRepository('ApiBundle:Auth')->findOneByLogin($login);
        if(!$auth)
        {
            throw new BadRequestException("Invalid credentials.");   
        }

        $encoder = $this->get('security.password_encoder');

        $isPasswordValid = $encoder->isPasswordValid($auth, $password);
        if (!$isPasswordValid)
        { 
            throw new BadRequestException("Invalid credentials.");  
        }

        //if(isset($body['usersFablabs']) && count($body['usersFablabs']) > 0) {
        //    $fablabsRaw = $body['usersFablabs'];
//
        //    foreach($fablabsRaw as $fablabRaw) {
        //        $fablabRaw = (array)$fablabRaw;
        //        $id = $fablabRaw["id"];
//
        //        $fablab = $this->getDoctrine()->getRepository('ApiBundle:Fablab')->find($id);
        //        if($fablab != null) {
        //            $this->addFablab($user, $fablab);
        //        } else {
        //            throw new BadRequestException("The fablab (id " . $id . ") doesn't exist.");
        //        }
        //    }
        //}
//
        //$em->persist($user);
        //$em->flush();

        return self::createResponse($user);
    }
}