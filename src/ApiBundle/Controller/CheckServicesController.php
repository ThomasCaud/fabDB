<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;

class CheckServicesController extends AbstractController
{
    protected function getGroup() {
        return "checkservice";
    }

    /**
     * @Route("/checkservices", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns 'OK'. Created in order to test the good API access."
     * )
     */
    public function getCheckservicesAction()
    {
        return self::createResponse("OK");
    }
}