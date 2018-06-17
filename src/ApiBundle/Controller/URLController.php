<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\URL;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class URLController extends AbstractController
{
    protected function getGroup() {
        return "url";
    }

    /**
     * @Rest\Get(
     *      path = "/urls"
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns URLs",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="type", type="string"),
     *              @SWG\Property(property="url", type="string")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:URL')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Get(
     *      path = "/urls/{id}",
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return the URL data",
     *     @SWG\Schema(
     *          type="object",
     *          @SWG\Property(property="id", type="integer"),
     *          @SWG\Property(property="type", type="string"),
     *          @SWG\Property(property="url", type="string")
     *     )
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when the URL ID doesn't exist"
     * )
     */
    public function getAction(URL $data)
    {
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/urls",
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\URL", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, URL $data)
    {
        if(null == $data->getURL()) {
            throw new BadRequestException("url (string) is needed");
        }

        $type = $data->getType();
        if(null == $type || ($type != 'photo' && $type != 'video')) {
            throw new BadRequestException("'type' (string) is needed with value 'photo' or 'video'");
        }

        $product_id = $req->get('product_id');

        if(!$this->isInteger($req, 'product_id')) {
            throw new BadRequestException("product_id (integer) is needed");
        }

        $product = $this->getDoctrine()->getRepository('ApiBundle:Product')->find($product_id);
        if(null == $product) {
            throw new BadRequestException("product_id " . $product_id . " doesn't exist");
        }

        $data->setProduct($product);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/urls/{id}",
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
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
    public function updateAction(Request $req, URL $data)
    {
        if(null !== $req->get('url')) {
            $data->setUrl($req->get('url'));
        }

        $type = $req->get('type');
        if(null !== $type) {
            if($type != 'photo' && $type != 'video') {
                throw new BadRequestException("'type' must be 'photo' or 'video'");
            }
            $data->setType($req->get('type'));
        }

        $product_id = $req->get('product_id');
        if(null !== $product_id) {
            $product = $this->getDoctrine()->getRepository('ApiBundle:Product')->find($product_id);
            if(null == $product) {
                throw new BadRequestException("product_id " . $product_id . " doesn't exist");
            }

            $data->setProduct($product);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Delete(
     *      path = "/urls/{id}",
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when deleted"
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when URL id doesn't exist"
     * )
     */
    public function deleteAction(URL $data)
    {
        if (!$data) {
            throw $this->createNotFoundException('No url found');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}