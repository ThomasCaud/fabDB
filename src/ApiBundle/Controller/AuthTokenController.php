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

    /**
     * @Rest\Options(
     *      path = "/auth-token"
     * )
     * @SWG\Tag(
     *   name="common",
     * )
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     */
    public function optionsAction(Request $req)
    {
        return self::createResponse([]);
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

        $authToken = new AuthToken();
        $authToken->setValue(base64_encode(random_bytes(50)));
        $authToken->setCreatedAt(new \DateTime('now'));
        $authToken->setAuth($auth);

        $em->persist($authToken);
        $em->flush();

        return self::createResponse($authToken);    
    }
}