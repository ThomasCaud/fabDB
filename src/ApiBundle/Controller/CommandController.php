<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Command;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;

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
     *              @SWG\Property(property="note", type="integer"),
     *              @SWG\Property(property="comment", type="string"),
     *              @SWG\Property(property="date", type="datetime"),
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
     * @Rest\Post(
     *      path = "/command",
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
    public function createAction(Command $data)
    {
        $em = $this->getDoctrine()->getManager();

        $em->merge($data);
        $em->flush();

        return self::createResponse($data);
    }
}