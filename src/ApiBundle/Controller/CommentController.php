<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class CommentController extends AbstractController
{
    protected function getGroup() {
        return "comment";
    }

    /**
     * @Rest\Get(
     *      path = "/comments"
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns comments",
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
        $data = $this->getDoctrine()->getRepository('ApiBundle:Comment')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/comments",
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Comment", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Comment $data)
    {
        $writer_id = $req->get('writer_id');
        $product_id = $req->get('product_id');

        if(null == $writer_id || !is_int($writer_id)) {
            throw new BadRequestException("writer_id (integer) is needed");
        }
        if(null == $product_id || !is_int($product_id)) {
            throw new BadRequestException("product_id (integer) is needed");
        }

        $command = $this->getDoctrine()->getRepository('ApiBundle:User')->find($writer_id);
        if(null == $command) {
            throw new BadRequestException("user (writer) with id " . $writer_id . " doesn't exist");
        }

        $product = $this->getDoctrine()->getRepository('ApiBundle:Product')->find($product_id);
        if(null == $product) {
            throw new BadRequestException("product_id " . $product_id . " doesn't exist");
        }

        $data->setWriter($command);
        $data->setProduct($product);

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }
}