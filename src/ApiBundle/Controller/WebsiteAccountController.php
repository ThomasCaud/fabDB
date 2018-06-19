<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\WebsiteAccount;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class WebsiteAccountController extends AbstractController
{

    /**
     * @Rest\Options(
     *      path = "/website-accounts"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
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
     * @Rest\Post(
     *      path = "/website-accounts"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\WebsiteAccount", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, WebsiteAccount $data)
    {
        $owner_id = $req->get('owner_id');
        $website_id = $req->get('website_id');

        if(null == $owner_id || !is_int($owner_id)) {
            throw new BadRequestException("owner_id (integer) is needed");
        }
        if(null == $website_id || !is_int($website_id)) {
            throw new BadRequestException("website_id (integer) is needed");
        }

        $owner = $this->getDoctrine()->getRepository('ApiBundle:User')->find($owner_id);
        if(null == $owner) {
            throw new BadRequestException("owner_id " . $owner_id . " doesn't exist");
        }

        $website = $this->getDoctrine()->getRepository('ApiBundle:Website')->find($website_id);
        if(null == $website) {
            throw new BadRequestException("website_id " . $website_id . " doesn't exist");
        }

        $data->setOwner($owner);
        $data->setWebsite($website);

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }
}