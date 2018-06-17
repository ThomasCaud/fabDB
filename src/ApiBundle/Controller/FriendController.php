<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\Friend;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class FriendController extends AbstractController
{

    /**
     * @Rest\Options(
     *      path = "/friends"
     * )
     * @SWG\Tag(
     *   name="Groupe LENH",
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
     * @Rest\Get(
     *      path = "/friends"
     * )
     * @SWG\Tag(
     *   name="Groupe LENH",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns friends",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Friend')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/friends"
     * )
     * @SWG\Tag(
     *   name="Groupe LENH",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Friend", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Friend $data)
    {
        $user_id_a = $req->get('user_id_a');
        $user_id_b = $req->get('user_id_b');

        if(null == $user_id_a || !is_int($user_id_a)) {
            throw new BadRequestException("user_id_a(integer) is needed");
        }
        if(null == $user_id_b || !is_int($user_id_b)) {
            throw new BadRequestException("user_id_b (integer) is needed");
        }

        $user_a = $this->getDoctrine()->getRepository('ApiBundle:User')->find($user_id_a);
        if(null == $user_a) {
            throw new BadRequestException("user_id_a" . $user_id_a . " doesn't exist");
        }

        $user_b = $this->getDoctrine()->getRepository('ApiBundle:User')->find($user_id_b);
        if(null == $user_b) {
            throw new BadRequestException("user_id_b " . $user_id_b . " doesn't exist");
        }

        $data->setUserA($user_a);
        $data->setUserB($user_b);

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Delete(
     *      path = "/friends/{id}",
     * )
     * @SWG\Tag(
     *   name="Groupe LENH",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when deleted"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function deleteAction(Friend $data)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}