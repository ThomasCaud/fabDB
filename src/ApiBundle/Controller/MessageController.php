<?php
namespace ApiBundle\Controller;

use ApiBundle\Exception\BadRequestException;
use ApiBundle\Entity\Message;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class MessageController extends AbstractController
{
    protected function getGroup() {
        return "message";
    }

    /**
     * @Rest\Get(
     *      path = "/messages"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns messages",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="message", type="string"),
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Message')->findAll();

        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/messages"
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Message", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Message $data)
    {
        if(null == $data->getMessage()) {
            throw new BadRequestException("message (string) is needed");
        }

        $user_id_from = $req->get('user_id_from');
        $user_id_to = $req->get('user_id_to');

        if(!$this->isInteger($req, 'user_id_from')) {
            throw new BadRequestException("user_id_from (integer) is needed");
        }

        if(!$this->isInteger($req, 'user_id_to')) {
            throw new BadRequestException("user_id_to (integer) is needed");
        }

        $user_from = $this->getDoctrine()->getRepository('ApiBundle:User')->find($user_id_from);
        if(null == $user_from) {
            throw new BadRequestException("user_id_from " . $user_id_from . " doesn't exist");
        }

        $user_to = $this->getDoctrine()->getRepository('ApiBundle:User')->find($user_id_to);
        if(null == $user_to) {
            throw new BadRequestException("user_id_to " . $user_id_to . " doesn't exist");
        }

        $data->setFrom($user_from);
        $data->setTo($user_to);

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/messages/{id}",
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
    public function updateAction(Request $req, Message $data)
    {
        if(!$req->get('message')) {
            throw new BadRequestException("Only 'message' attribute can be updated");
        }
        $data->setMessage($req->get('message'));

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Delete(
     *      path = "/messages/{id}",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when deleted"
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when product id doesn't exist"
     * )
     */
    public function deleteAction(Message $data)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}