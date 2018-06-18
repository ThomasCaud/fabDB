<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class MakerController extends AbstractController
{
    protected function getGroup() {
        return "user";
    }

    /**
     * @Rest\Options(
     *      path = "/makers"
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
     *      path = "/makers"
     * )
     * @SWG\Tag(
     *   name="Groupe SAL",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns makers",
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
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('ApiBundle:User');

        $makers = $repository->getAllMakers();        
        
        return self::createResponse($makers);
    }
}