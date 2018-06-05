<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;

class MakerController extends AbstractController
{
    protected function getGroup() {
        return "user";
    }

    /**
     * @Rest\Get(
     *      path = "/makers"
     * )
     *
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

        $makers = $repository->getAll();        
        
        return self::createResponse($makers);
    }
}