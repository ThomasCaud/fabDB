<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class ProductController extends AbstractController
{
    protected function getGroup() {
        return "all";
    }

    /**
     * @Rest\Get(
     *      path = "/products"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns products",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="price", type="number"),
     *              @SWG\Property(property="discount", type="number"),
     *              @SWG\Property(property="stock", type="integer"),
     *              @SWG\Property(property="publication", type="string"),
     *              @SWG\Property(
     *                  property="urls", type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer"),
     *                      @SWG\Property(property="type", type="string"),
     *                      @SWG\Property(property="url", type="string")
     *                  )
     *              )
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Product')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Get(
     *      path = "/products/{id}",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return the product data",
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
     *      description="Returned when the product ID doesn't exist"
     * )
     */
    public function getAction(Product $data)
    {
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/products",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Product", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Product $data)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/products/{id}",
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
    public function updateAction(Request $req, Product $product)
    {
        if(null !== $req->get('name')) {
            $product->setName($req->get('name'));
        }

        if(null !== $req->get('description')) {
            $product->setDescription($req->get('description'));
        }

        if(null !== $req->get('price')) {
            if(!is_float($req->get('price')) && !is_int($req->get('price'))) {
                throw new BadRequestException("price should be a float value");
            }
            $product->setPrice($req->get('price'));
        }

        if(null !== $req->get('discount')) {
            if(!is_float($req->get('discount')) && !is_int($req->get('discount'))) {
                throw new BadRequestException("discount should be a float value");
            }
            if($req->get('discount') < 0 || $req->get('discount') > 1) {
                throw new BadRequestException("discount should be between 0 and 1");
            }
            $product->setDiscount($req->get('discount'));
        }

        if(null !== $req->get('stock')) {
            if(!is_int($req->get('stock'))) {
                throw new BadRequestException("stock should be an integer");
            }
            if($req->get('stock') < 0) {
                throw new BadRequestException("stock should be positive");
            }
            $product->setStock($req->get('stock'));
        }

        if(null !== $req->get('category')) {
            $product->setCategory($req->get('category'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return self::createResponse($product);
    }

    /**
     * @Rest\Delete(
     *      path = "/products/{id}",
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
    public function deleteAction(Product $data)
    {
        if (!$data) {
            throw $this->createNotFoundException('No product found');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}