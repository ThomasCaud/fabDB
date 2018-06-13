<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;

class CategoryController extends AbstractController
{
    protected function getGroup() {
        return "all";
    }

    /**
     * @Rest\Get(
     *      path = "/categories"
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns categories",
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
        $data = $this->getDoctrine()->getRepository('ApiBundle:Category')->findAll();
        
        return self::createResponse($data);
    }
}