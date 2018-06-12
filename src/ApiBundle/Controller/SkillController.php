<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Skill;
use ApiBundle\Entity\SkillTree;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class SkillController extends AbstractController
{
    protected function getGroup() {
        return "skill";
    }

    /**
     * @Rest\Get(
     *      path = "/skills"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns skills",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="title", type="string"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="detail", type="string"),
     *              @SWG\Property(property="level", type="string")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Skill')->findAll();
        
        return self::createResponse($data);
    }

    private function addParent(Skill $parent, Skill $child)
    {
        $skillTree = new SkillTree();
        $skillTree->setParent($parent);
        $skillTree->setChild($child);
        $child->addChild($skillTree);

        $em = $this->getDoctrine()->getManager();
        $em->persist($child);
        $em->persist($skillTree);

        return $this;
    }

    private function addChildren(Skill $parent, $children_id)
    {
        if(null !== $children_id) {
            foreach($children_id as $child_id) {
                $child_id = ((array)$child_id)["id"];

                $child = $this->getDoctrine()->getRepository('ApiBundle:Skill')->find($child_id);
                if($child != null) {
                    $this->addParent($parent, $child);
                } else {
                    throw new BadRequestException("The skill (id " . $child_id . ") doesn't exist.");
                }
            }
        }
    }

    /**
     * @Rest\Post(
     *      path = "/skills"
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Skill", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Skill $data)
    {
        if($data->getLevelMax() < 1) {
            throw new BadRequestException("level_max (integer) should be greater than 0");
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);

        $this->addChildren($data, $req->get('children_id'));

        $em->flush();
        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/skills/{id}",
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
    public function updateAction(Request $req, Skill $data)
    {
        if($this->isString($req, 'title')) {
            $data->setTitle($req->get('title'));
        }

        if($this->isString($req, 'description')) {
            $data->setDescription($req->get('description'));
        }

        if($this->isString($req, 'detail')) {
            $data->setDetail($req->get('detail'));
        }

        if($this->isInteger($req, 'level_max')) {
            $data->setLevelMax($req->get('level_max'));
        }

        $data->getChildren()->clear();
        $this->addChildren($data, $req->get('children_id'));

        $em = $this->getDoctrine()->getManager();
        $em->merge($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Delete(
     *      path = "/skills/{id}",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when deleted"
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when skill id doesn't exist"
     * )
     */
    public function deleteAction(Skill $data)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}