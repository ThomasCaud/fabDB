<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\FamilyMember;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class FamilyMemberController extends AbstractController
{
    protected function getGroup() {
        return "user";
    }

    /**
     * @Rest\Options(
     *      path = "/family-members"
     * )
     * @Rest\Options(
     *      path = "/family-members/{id}"
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
     *      path = "/family-members"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\FamilyMember", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, FamilyMember $data)
    {
        $referrer_id = $req->get('referrer_id');
        $user_account_id = $req->get('user_account_id');

        if(null == $referrer_id || !is_int($referrer_id)) {
            throw new BadRequestException("referrer_id (integer) is needed");
        }
        if(null == $user_account_id || !is_int($user_account_id)) {
            throw new BadRequestException("user_account_id (integer) is needed");
        }

        $referrer = $this->getDoctrine()->getRepository('ApiBundle:User')->find($referrer_id);
        if(null == $referrer) {
            throw new BadRequestException("referrer_id " . $referrer_id . " doesn't exist");
        }

        $account = $this->getDoctrine()->getRepository('ApiBundle:User')->find($user_account_id);
        if(null == $account) {
            throw new BadRequestException("user_account_id " . $user_account_id . " doesn't exist");
        }

        $data->setReferrer($referrer);
        $data->setUserAccount($account);

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }
}