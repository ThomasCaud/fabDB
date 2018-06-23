<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\Portrait;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class PortraitController extends AbstractController
{
    
    /**
     * @Rest\Options(
     *      path = "/portraits"
     * )
     * @Rest\Options(
     *      path = "/portraits/{id}"
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
     * @Rest\Get(
     *      path = "/portraits"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )   
     * @SWG\Response(
     *     response=200,
     *     description="Returns portraits",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="aboutMe", type="string"),
     *              @SWG\Property(property="goal", type="string"),
     *              @SWG\Property(property="fear", type="string"),
     *              @SWG\Property(property="challenge", type="string"),
     *              @SWG\Property(property="hobby", type="string"),
     *              @SWG\Property(property="other", type="string")
     *         )
     *     )
     * )
     */
    public function getAction()
    {
        $portraits = $this->getDoctrine()->getRepository('ApiBundle:Portrait')->findAll();
        
        return self::createResponse($portraits);
    }

    /**
     * @Rest\Post(
     *      path = "/portraits"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
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

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/portraits/{id}",
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
}