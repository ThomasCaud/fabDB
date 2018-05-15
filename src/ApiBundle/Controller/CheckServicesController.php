<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;

class CheckServicesController extends Controller
{
    /**
     * @Route("/checkservices", methods={"GET"})
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns 'OK'",
     *     @SWG\Schema(
     *         type="string"
     *     )
     * )
     */
    public function getCheckservicesAction()
    {
        return new JsonResponse("OK");
    }
}