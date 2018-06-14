<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\SkillDomain;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class SkillDomainController extends AbstractController
{

    /**
     * @Rest\Get(
     *      path = "/skill-domains"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns skill domains",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="title", type="string"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="detail", type="string")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:SkillDomain')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/skill-domains"
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\SkillDomain", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, SkillDomain $data)
    {
        if(null == $req->get('title')) {
            throw new BadRequestException('title (string) is needed');
        }

        if(null == $req->get('description')) {
            throw new BadRequestException('description (string) is needed');
        }

        if(null == $req->get('detail')) {
            throw new BadRequestException('detail (string) is needed');
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/skill-domains/{id}",
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
    public function updateAction(Request $req, SkillDomain $data)
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

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Delete(
     *      path = "/skill-domains/{id}",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when deleted"
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when product id doesn't exist"
     * )
     */
    public function deleteAction(SkillDomain $data)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}