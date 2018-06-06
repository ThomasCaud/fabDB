<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Command;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class CommandController extends AbstractController
{
    protected function getGroup() {
        return "command";
    }

    /**
     * @Rest\Get(
     *      path = "/commands"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns commands",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="lastDigitCard", type="integer"),
     *              @SWG\Property(property="dateCommand", type="string"),
     *              @SWG\Property(property="status", type="string"),
     *              @SWG\Property(property="billingAddress", type="string"),
     *              @SWG\Property(property="deliveryAddress", type="string")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Command')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Get(
     *      path = "/commands/{id}",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return the command data",
     *     @SWG\Schema(
     *          type="object",
     *          @SWG\Property(property="id", type="integer"),
     *          @SWG\Property(property="lastDigitCard", type="integer"),
     *          @SWG\Property(property="dateCommand", type="string"),
     *          @SWG\Property(property="status", type="string"),
     *          @SWG\Property(property="billingAddress", type="string"),
     *          @SWG\Property(property="deliveryAddress", type="string")
     *     )
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when the user ID doesn't exist"
     * )
     */
    public function getAction(Command $data)
    {
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/commands",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Command", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    // public function createAction(Command $data)
    // {
    //      Doesn't work! Converter seems forget some data...
    //     var_dump($data);
    //     $em = $this->getDoctrine()->getManager();

    //     $em->merge($data);
    //     $em->flush();

    //     return self::createResponse($data);
    // }

    /**
     * @Rest\Put(
     *      path = "/commands/{id}",
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
    public function updateAction(Request $req, Command $command)
    {
        $body = (array)json_decode($req->getContent(), true);
        $newStatus = $body['status'];

        if(!isset($newStatus)) {
            throw $this->createNotFoundException("'status' must appear in body");
        }

        if(!in_array($newStatus,['pending','paid','cancelled'])) {
            throw $this->createNotFoundException("'status' should be 'pending','paid' or 'cancelled'");
        }

        $command->setStatus($newStatus);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return self::createResponse($command);
    }

    /**
     * @Rest\Delete(
     *      path = "/commands/{id}",
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
    public function deleteAction(Command $data)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}