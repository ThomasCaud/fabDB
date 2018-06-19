<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\UserSkill;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Swagger\Annotations as SWG;

class UserSkillController extends AbstractController
{

    /**
     * @Rest\Options(
     *      path = "/user-skills"
     * )
     * @SWG\Tag(
     *   name="Groupe DDT",
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
     *      path = "/user-skills"
     * )
     * @SWG\Tag(
     *   name="Groupe DDT",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns skills for each user",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="user_id", type="integer"),
     *              @SWG\Property(property="connected_object_id", type="integer"),
     *              @SWG\Property(property="niveau", type="integer"),
     *              @SWG\Property(property="date", type="datetime"),
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:UserSkill')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/user-skills"
     * )
     * @SWG\Tag(
     *   name="Groupe DDT",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\UserSkill", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, UserSkill $data)
    {
        $user_id = $req->get('user_id');
        $skill_id = $req->get('skill_id');

        if(null == $user_id || !is_int($user_id)) {
            throw new BadRequestException("user_id (integer) is needed");
        }
        if(null == $skill_id || !is_int($skill_id)) {
            throw new BadRequestException("skill_id (integer) is needed");
        }

        $user = $this->getDoctrine()->getRepository('ApiBundle:User')->find($user_id);
        if(null == $user) {
            throw new BadRequestException("user_id " . $user_id . " doesn't exist");
        }

        $skill = $this->getDoctrine()->getRepository('ApiBundle:Skill')->find($skill_id);
        if(null == $skill) {
            throw new BadRequestException("skill_id " . $skill_id . " doesn't exist");
        }

        if(null == $data->getNiveau()) {
            throw new BadRequestException("niveau (integer) is needed");
        }

        if(null == $data->getDate()) {
            $data->setDate(date_create_from_format('Y-m-d H:i:s', date_create('now')->format('Y-m-d H:i:s')));
        }

        $data->setUser($user);
        $data->setSkill($skill);

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/user-skills",
     * )
     * @SWG\Tag(
     *   name="Groupe DDT",
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
    public function updateAction(Request $req)
    {
        $user_id = $req->get('user_id');
        $skill_id = $req->get('skill_id');

        if(!isset($user_id) || !is_int($user_id)) {
            throw $this->createNotFoundException("'user_id' (integer) must appear in body");
        }

        if(!isset($skill_id) || !is_int($skill_id)) {
            throw $this->createNotFoundException("'skill_id' (integer) must appear in body");
        }

        $em = $this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getManager();

        $userSkill = $em->find(
            "ApiBundle\Entity\UserSkill",
            array(
                "user" => $user_id,
                "skill" => $skill_id
            )
        );

        if(null == $userSkill) {
            return self::createResponse([]);
        }

        if($this->isInteger($req, 'niveau')) {
            $userSkill->setNiveau($req->get('niveau'));
        }

        $date = $req->get('date');
        if(null !== $date) {
            $userSkill->setNiveau($date);
        }

        $em->flush();
        return self::createResponse($userSkill);
    }

    /**
     * @Rest\Delete(
     *      path = "/user-skills",
     * )
     * @SWG\Tag(
     *   name="Groupe DDT",
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
        $user_id = $req->get('user_id');
        $skill_id = $req->get('skill_id');

        if(!isset($user_id) || !is_int($user_id)) {
            throw $this->createNotFoundException("'user_id' (integer) must appear in body");
        }

        if(!isset($skill_id) || !is_int($skill_id)) {
            throw $this->createNotFoundException("'skill_id' (integer) must appear in body");
        }

        $em = $this->getDoctrine()->getManager();
        $userSkill = $em->find(
            "ApiBundle\Entity\UserSkill",
            array(
                "user" => $user_id,
                "skill" => $skill_id
            )
        );

        $em->remove($userSkill);
        $em->flush();

        return self::createResponse($userSkill);
    }
}