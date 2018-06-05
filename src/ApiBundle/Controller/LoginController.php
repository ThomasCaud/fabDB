<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\User;
use ApiBundle\Exception\AuthenticationException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class LoginController extends AbstractController
{
    protected function getGroup() {
        return "user";
    }

    /**
     * @Rest\Post(
     *      path = "/login"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="note", type="integer"),
     *              @SWG\Property(property="comment", type="string"),
     *              @SWG\Property(property="date", type="datetime"),
     *         )
     *     )
     * )
     */
    public function loginAction(Request $req)
    {
        $body = (array)json_decode($req->getContent());

        if(!isset($body['login'])) {
            throw new AuthenticationException('login is mandatory');
        }

        if(!isset($body['password'])) {
            throw new AuthenticationException('password is mandatory');
        }

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ApiBundle:User');

        $makers = $repository->connect($body['login'], $body['password']);        
        
        return self::createResponse($makers);
    }
}