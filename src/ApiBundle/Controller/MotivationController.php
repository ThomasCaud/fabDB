<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Motivation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class MotivationController extends AbstractController
{

    /**
     * @Rest\Post(
     *      path = "/motivations"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Motivation", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Motivation $data)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/motivations/{id}",
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
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
    public function updateAction(Request $req, Motivation $motivation)
    {
        if($this->isInteger($req, 'meaning')) {
            $motivation->setMeaning($req->get('meaning'));
        }

        if($this->isInteger($req, 'empowerment')) {
            $motivation->setEmpowerment($req->get('empowerment'));
        }

        if($this->isInteger($req, 'social_influence')) {
            $motivation->setSocialInfluence($req->get('social_influence'));
        }

        if($this->isInteger($req, 'unpredictability')) {
            $motivation->setUnpredictability($req->get('unpredictability'));
        }

        if($this->isInteger($req, 'avoidance')) {
            $motivation->setAvoidance($req->get('avoidance'));
        }

        if($this->isInteger($req, 'scarcity')) {
            $motivation->setScarcity($req->get('scarcity'));
        }

        if($this->isInteger($req, 'ownership')) {
            $motivation->setOwnership($req->get('ownership'));
        }

        if($this->isInteger($req, 'accomplishment')) {
            $motivation->setAccomplishment($req->get('accomplishment'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->merge($motivation);
        $em->flush();

        return self::createResponse($motivation);
    }
}