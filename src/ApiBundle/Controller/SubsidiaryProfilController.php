<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\SubsidiaryProfil;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class SubsidiaryProfilController extends AbstractController
{
    protected function getGroup() {
        return "subsidiaryProfil";
    }

    /**
     * @Rest\Get(
     *      path = "/subsidiary-profils"
     * )
     *
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