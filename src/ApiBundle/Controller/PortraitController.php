<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Portrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class PortraitController extends AbstractController
{
    protected function getGroup() {
        return "portrait";
    }

    /**
     * @Rest\Post(
     *      path = "/portraits"
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Portrait", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Portrait $data)
    {
        $em = $this->getDoctrine()->getManager();

        $em->merge($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/portraits/{id}",
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
    public function updateAction(Request $req, Portrait $portrait)
    {
        if($this->isString($req, 'about_me')) {
            $portrait->setAboutMe($req->get('about_me'));
        }

        if($this->isString($req, 'goal')) {
            $portrait->setGoal($req->get('goal'));
        }

        if($this->isString($req, 'fear')) {
            $portrait->setFear($req->get('fear'));
        }

        if($this->isString($req, 'challenge')) {
            $portrait->setChallenge($req->get('challenge'));
        }

        if($this->isString($req, 'frustration')) {
            $portrait->setFrustration($req->get('frustration'));
        }

        if($this->isString($req, 'hobby')) {
            $portrait->setHobby($req->get('hobby'));
        }

        if($this->isString($req, 'other')) {
            $portrait->setOther($req->get('other'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->merge($portrait);
        $em->flush();

        return self::createResponse($portrait);
    }

    /**
     * @Rest\Delete(
     *      path = "/access",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when deleted"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function deleteAction(Request $req)
    {
        $body = (array)json_decode($req->getContent(), true);

        $user_id = $body['user_id'];
        $connected_object_id = $body['connected_object_id'];

        if(!isset($user_id) || !is_int($user_id)) {
            throw $this->createNotFoundException("'user_id' (integer) must appear in body");
        }

        if(!isset($connected_object_id) || !is_int($connected_object_id)) {
            throw $this->createNotFoundException("'connected_object_id' (integer) must appear in body");
        }

        $em = $this->getDoctrine()->getManager();
        $access = $em->find("ApiBundle\Entity\Access", array("user" => $user_id, "connectedObject" => $connected_object_id));
        $em->remove($access);
        $em->flush();

        return self::createResponse($access);
    }
}