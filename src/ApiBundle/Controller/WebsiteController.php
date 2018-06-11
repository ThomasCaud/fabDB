<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Website;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class WebsiteController extends AbstractController
{
    protected function getGroup() {
        return "website";
    }

    /**
     * @Rest\Get(
     *      path = "/websites"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns websites",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="logoURL", type="string"),
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Website')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/websites"
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Website", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Website $data)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }


    /**
     * @Rest\Put(
     *      path = "/websites/{id}",
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
    public function updateAction(Request $req, Website $website)
    {
        $logo_url = $req->get('logo_url');
        if(null == $logo_url) {
            throw new BadRequestException("logo_url is needed");
        }

        if(!is_string($logo_url)) {
            throw new BadRequestException("logo_url must be a string");
        }

        $website->setLogoURL($logo_url);

        $em = $this->getDoctrine()->getManager();
        $em->merge($website);
        $em->flush();

        return self::createResponse($website);
    }
}