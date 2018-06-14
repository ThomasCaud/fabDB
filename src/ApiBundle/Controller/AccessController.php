<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\Access;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class AccessController extends AbstractController
{
    
    /**
     * @Rest\Get(
     *      path = "/access"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns access",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="user_id", type="integer"),
     *              @SWG\Property(property="connected_object_id", type="integer"),
     *              @SWG\Property(property="type", type="string"),
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Access')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/access"
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Access", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Access $data)
    {
        $user_id = $req->get('user_id');
        $connected_object_id = $req->get('connected_object_id');

        if(null == $user_id || !is_int($user_id)) {
            throw new BadRequestException("user_id (integer) is needed");
        }
        if(null == $connected_object_id || !is_int($connected_object_id)) {
            throw new BadRequestException("connected_object_id (integer) is needed");
        }

        $user = $this->getDoctrine()->getRepository('ApiBundle:User')->find($user_id);
        if(null == $user) {
            throw new BadRequestException("user_id " . $user_id . " doesn't exist");
        }

        $connectedObject = $this->getDoctrine()->getRepository('ApiBundle:ConnectedObject')->find($connected_object_id);
        if(null == $connectedObject) {
            throw new BadRequestException("connected_object_id " . $connected_object_id . " doesn't exist");
        }

        $data->setUser($user);
        $data->setConnectedObject($connectedObject);

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/access",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when updated"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function updateAction(Request $req)
    {
        $body = (array)json_decode($req->getContent(), true);

        $user_id = $body['user_id'];
        $connected_object_id = $body['connected_object_id'];
        $type = $body['type'];

        if(!isset($user_id) || !is_int($user_id)) {
            throw $this->createNotFoundException("'user_id' (integer) must appear in body");
        }

        if(!isset($connected_object_id) || !is_int($connected_object_id)) {
            throw $this->createNotFoundException("'connected_object_id' (integer) must appear in body");
        }

        if(!in_array($type,['normal','premium','admin'])) {
            throw $this->createNotFoundException("'type' should be 'normal','premium' or 'admin'");
        }

        $em = $this->getDoctrine()->getManager();
        $access = $em->find("ApiBundle\Entity\Access", array("user" => $user_id, "connectedObject" => $connected_object_id));

        $access->setType($type);

        $em->flush();

        return self::createResponse($access);
    }

    /**
     * @Rest\Delete(
     *      path = "/access",
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
    public function deleteAction(Request $req)
    {
        $body = (array)json_decode($req->getContent(), true);

        $user_id = $body['user_id'];
        $connected_object_id = $body['connected_object_id'];

        if(!isset($user_id) || !is_int($user_id)) {
            throw $this->createNotFoundException("'user_id' (integer) must appear in body");
        }

        if(!isset($connected_object_id) || !is_int($connected_object_id)) {
            throw $this->createNotFoundException("'connected_object_id' (integer) must appear in body");
        }

        $em = $this->getDoctrine()->getManager();
        $access = $em->find("ApiBundle\Entity\Access", array("user" => $user_id, "connectedObject" => $connected_object_id));
        $em->remove($access);
        $em->flush();

        return self::createResponse($access);
    }
}