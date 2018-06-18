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
     * @Rest\Options(
     *      path = "/login"
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )   
     * @SWG\Response(
     *      response = 200,
     *      description="When a request can be executed"
     * )
     */
    public function optionsAction(Request $req)
    {
        return self::createResponse([]);
    }

    /**
     * @Rest\Post(
     *      path = "/login"
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return true if login and password match",
     * )
     */
    public function loginAction(Request $req)
    {
        $login = $req->get('login');
        $password = $req->get('password');

        if(null == $login) {
            throw new AuthenticationException('login is mandatory');
        }

        if(null == $password) {
            throw new AuthenticationException('password is mandatory');
        }

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ApiBundle:User');

        $user = $repository->findOneBy(
            Array(
                "login" => $login,
                "password" => $password
            )
        );

        if($user == null) {
            throw new AuthenticationException("login doesn't exist or login-password combination doesn't matched");
        }

        return self::createResponse($user);
    }
}