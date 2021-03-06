<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\Fablab;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class FablabController extends AbstractController
{

    /**
     * @Rest\Options(
     *      path = "/fablabs"
     * )
     * @Rest\Options(
     *      path = "/fablabs/{id}"
     * )
     * @SWG\Tag(
     *   name="Common",
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
     *      path = "/fablabs"
     * )
     * @SWG\Tag(
     *   name="Common"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns fab labs",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="address", type="string"),
     *              @SWG\Property(property="pc", type="string"),
     *         )
     *     )
     * )
     */
    public function getFablabsAction()
    {
        $fablabs = $this->getDoctrine()->getRepository('ApiBundle:Fablab')->findAll();
        
        return self::createResponse($fablabs);
    }

    /**
     * @Rest\Get(
     *      path = "/fablabs/{id}",
     * )
     * @SWG\Tag(
     *   name="Common"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return the fab lab data",
     *     @SWG\Schema(
     *          type="object",
     *          @SWG\Property(property="id", type="integer"),
     *          @SWG\Property(property="address", type="string"),
     *          @SWG\Property(property="pc", type="string"),
     *     )
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when the fab lab ID doesn't exist"
     * )
     */
    public function getAction(Fablab $fablab)
    {
        return self::createResponse($fablab);
    }

    /**
     * @Rest\Post(
     *      path = "/fablabs",
     * )
     * @SWG\Tag(
     *   name="Common"
     * )
     * @ParamConverter("fablab", class="ApiBundle\Entity\Fablab", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Fablab $fablab)
    {
        $em = $this->getDoctrine()->getManager();

        $em->merge($fablab);
        $em->flush();

        return self::createResponse($fablab);
    }
}