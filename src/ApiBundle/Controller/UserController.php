<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Entity\UsersFablab;
use \Datetime;

class UserController extends AbstractController
{
    protected function getGroup() {
        return "user";
    }

    /**
     * @Rest\Get(
     *      path = "/users"
     * )
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns users",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="fname", type="string"),
     *              @SWG\Property(property="lname", type="string"),
     *              @SWG\Property(property="email", type="string"),
     *              @SWG\Property(property="login", type="string")
     *         )
     *     )
     * )
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('ApiBundle:User')->findAll();
        
        return self::createResponse($users);
    }

    /**
     * @Rest\Get(
     *      path = "/users/{id}",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return the user data",
     *     @SWG\Schema(
     *          type="object",
     *          @SWG\Property(property="id", type="integer"),
     *          @SWG\Property(property="fname", type="string"),
     *          @SWG\Property(property="lname", type="string"),
     *          @SWG\Property(property="email", type="string"),
     *          @SWG\Property(property="login", type="string")
     *     )
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when the user ID doesn't exist"
     * )
     */
    public function getAction(User $user)
    {
        return self::createResponse($user);
    }

    private function addFablab(User $user, \ApiBundle\Entity\Fablab $fablab)
    {
        $userFablab = new UsersFabLab();
        $userFablab->setFablab($fablab);
        $userFablab->setUser($user);
        $dt = new DateTime();
        $userFablab->setJoinedAt(new DateTime());

        $user->addUsersFablab($userFablab);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);             
        $em->persist($userFablab);

        return $this;
    }

    /**
     * @Rest\Post(
     *      path = "/users",
     * )
     * @ParamConverter("user", class="ApiBundle\Entity\User", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $body = (array)json_decode($req->getContent());

        if(isset($body['usersFablabs']) && count($body['usersFablabs']) > 0) {
            $fablabsRaw = $body['usersFablabs'];

            foreach($fablabsRaw as $fablabRaw) {
                $fablabRaw = (array)$fablabRaw;
                $id = $fablabRaw["id"];

                $fablab = $this->getDoctrine()->getRepository('ApiBundle:Fablab')->find($id);
                if($fablab != null) {
                    $this->addFablab($user, $fablab);
                } else {
                    echo("Warning ! The fablab (id " . $id . ") doesn't exist!"); 
                }
            }
        }

        $em->merge($user);
        $em->flush();

        return self::createResponse($user);
    }
}