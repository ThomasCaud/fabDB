<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\ConnectedObject;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class ConnectedObjectController extends AbstractController
{

    /**
     * @Rest\Options(
     *      path = "/connected-objects"
     * )
     * @Rest\Options(
     *      path = "/connected-objects/{id}"
     * )
     * @SWG\Tag(
     *   name="Groupe YS",
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
     * @Rest\Get(
     *      path = "/connected-objects"
     * )
     * @SWG\Tag(
     *   name="Groupe YS",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns connected objects",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:ConnectedObject')->findAll();
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/connected-objects"
     * )
     * @SWG\Tag(
     *   name="Groupe YS",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\ConnectedObject", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, ConnectedObject $data)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/connected-objects/{id}",
     * )
     * @SWG\Tag(
     *   name="Groupe YS",
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
    public function updateAction(Request $req, ConnectedObject $data)
    {
        $body = (array)json_decode($req->getContent(), true);
        $name = $body['name'];
        
        if(!isset($name)) {
            throw $this->createNotFoundException("Only 'name' attribute can be updated");
        }
        $data->setName($name);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Delete(
     *      path = "/connected-objects/{id}",
     * )
     * @SWG\Tag(
     *   name="Groupe YS",
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
    public function deleteAction(ConnectedObject $data)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}