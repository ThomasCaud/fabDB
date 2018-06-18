<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\SubsidiaryProfil;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;

class SubsidiaryProfilController extends AbstractController
{
    protected function getGroup() {
        return "subsidiaryProfil";
    }

    /**
     * @Rest\Options(
     *      path = "/subsidiary-profils"
     * )
     * @Rest\Options(
     *      path = "/subsidiary-profils/{id}"
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
     *      path = "/subsidiary-profils"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns subsidiary profils",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="name", type="text"),
     *              @SWG\Property(property="logo", type="text"),
     *              @SWG\Property(property="description", type="text")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:SubsidiaryProfil')->findAll();

        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/subsidiary-profils",
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\SubsidiaryProfil", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, SubsidiaryProfil $data)
    {
        
        if(!in_array($data->getName(),['avocat','logicien','architecte','commandant','innovateur','médiateur','protagoniste','inspirateur','logisticien','défenseur','directeur','consul', 'virtuose','aventurier','entrepreneur','amuseur'])) {
            throw $this->createNotFoundException("'name' should be 'avocat','logicien','architecte','commandant','innovateur','médiateur','protagoniste','inspirateur','logisticien','défenseur','directeur','consul', 'virtuose','aventurier','entrepreneur' or 'amuseur'");
        }

        if(null == $data->getDescription()) {
            throw new BadRequestException("'description' is needed");
        }

        if(null == $data->getLogo()) {
            throw new BadRequestException("'logo' is needed");
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/subsidiary-profils/{id}",
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
    public function updateAction(Request $req, SubsidiaryProfil $data)
    {
        if($this->isString($req, 'name')) {
            if(!in_array($req->get('name'),['avocat','logicien','architecte','commandant','innovateur','médiateur','protagoniste','inspirateur','logisticien','défenseur','directeur','consul', 'virtuose','aventurier','entrepreneur','amuseur'])) {
                throw $this->createNotFoundException("'name' should be 'avocat','logicien','architecte','commandant','innovateur','médiateur','protagoniste','inspirateur','logisticien','défenseur','directeur','consul', 'virtuose','aventurier','entrepreneur' or 'amuseur'");
            }
            $data->setName($req->get('name'));
        }

        if($this->isString($req, 'logo')) {
            $data->setLogo($req->get('logo'));
        }

        if($this->isString($req, 'description')) {
            $data->setDescription($req->get('description'));
        }
        
        $em = $this->getDoctrine()->getManager();

        $em->merge($data);
        $em->flush();

        return self::createResponse($data);
    }
}