<?php
namespace ApiBundle\Controller;

use ApiBundle\Exception\BadRequestException;
use ApiBundle\Entity\Purchase;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class PurchaseController extends AbstractController
{
    protected function getGroup() {
        return "purchase";
    }

    /**
     * @Rest\Options(
     *      path = "/purchases"
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
     * @Rest\Get(
     *      path = "/purchases"
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns purchases",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="quantity", type="integer"),
     *              @SWG\Property(property="price", type="float"),
     *              @SWG\Property(property="date", type="datetime"),
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Purchase')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/purchases",
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Purchase", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Purchase $data)
    {
        $command_id = $req->get('command_id');
        $product_id = $req->get('product_id');

        if(null == $command_id || !is_int($command_id)) {
            throw new BadRequestException("command_id (integer) is needed");
        }
        if(null == $product_id || !is_int($product_id)) {
            throw new BadRequestException("product_id (integer) is needed");
        }

        $command = $this->getDoctrine()->getRepository('ApiBundle:Command')->find($command_id);
        if(null == $command) {
            throw new BadRequestException("command_id " . $command_id . " doesn't exist");
        }

        $product = $this->getDoctrine()->getRepository('ApiBundle:Product')->find($product_id);
        if(null == $product) {
            throw new BadRequestException("product_id " . $product_id . " doesn't exist");
        }

        $data->setCommand($command);
        $data->setProduct($product);

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }
}