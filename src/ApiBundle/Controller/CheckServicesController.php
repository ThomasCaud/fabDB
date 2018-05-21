<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;

class CheckServicesController extends AbstractController
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
        return self::createResponse("OK");
    }
}