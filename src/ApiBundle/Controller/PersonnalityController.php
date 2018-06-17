<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Personnality;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class PersonnalityController extends AbstractController
{

    /**
     * @Rest\Get(
     *      path = "/personnalities"
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns personnalities",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="mind", type="integer"),
     *              @SWG\Property(property="energy", type="integer"),
     *              @SWG\Property(property="nature", type="integer"),
     *              @SWG\Property(property="tactical", type="integer"),
     *              @SWG\Property(property="identity", type="integer"),
     *              @SWG\Property(property="profil", type="text")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Personnality')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/personnalities",
     * )
     * @SWG\Tag(
     *   name="Groupe JCQ",
     * )
     * @ParamConverter("data", class="ApiBundle\Entity\Personnality", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Personnality $data)
    {
        if(!in_array($data->getProfil(),['analyst','diplomat','explorer','sentinel'])) {
            throw new BadRequestException("'profil' should be 'analyst','diplomat','explorer' or 'sentinel'");
        }

        $subprofil_id = $req->get('subprofil_id');
        if(isset($subprofil_id)) {
            if(!is_int($subprofil_id)) {
                throw new BadRequestException("subprofil_id must be an integer");
            }

            $subprofil = $this->getDoctrine()->getRepository('ApiBundle:SubsidiaryProfil')->find($subprofil_id);
            if(null == $subprofil) {
                throw new BadRequestException("subprofil_id " . $subprofil_id . " doesn't exist");
            }

            $data->setSubprofil($subprofil);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        return self::createResponse($data);
    }

    /**
     * @Rest\Put(
     *      path = "/personnalities/{id}",
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
    public function updateAction(Request $req, Personnality $personnality)
    {
        if($this->isInteger($req, 'mind', 0, 100)) {
            $personnality->setMind($req->get('mind'));
        }

        if($this->isInteger($req, 'energy', 0, 100)) {
            $personnality->setEnergy($req->get('energy'));
        }

        if($this->isInteger($req, 'nature', 0, 100)) {
            $personnality->setNature($req->get('nature'));
        }

        if($this->isInteger($req, 'tactical', 0, 100)) {
            $personnality->setTactical($req->get('tactical'));
        }
        
        if($this->isInteger($req, 'identity', 0, 100)) {
            $personnality->setIdentity($req->get('identity'));
        }
        
        if($this->isString($req, 'profil')) {
            if(!in_array($req->get('profil'),['analyst','diplomat','explorer','sentinel'])) {
                throw new BadRequestException("'profil' should be 'analyst','diplomat','explorer' or 'sentinel'");
            }
            $personnality->setProfil($req->get('profil'));
        }

        $subprofil_id = $req->get('subprofil_id');
        if(isset($subprofil_id)) {
            if(!is_int($subprofil_id)) {
                throw new BadRequestException("subprofil_id must be an integer");
            }

            $subprofil = $this->getDoctrine()->getRepository('ApiBundle:SubsidiaryProfil')->find($subprofil_id);
            if(null == $subprofil) {
                throw new BadRequestException("subprofil_id " . $subprofil_id . " doesn't exist");
            }

            $personnality->setSubprofil($subprofil);
        }
        
        $em = $this->getDoctrine()->getManager();

        $em->merge($personnality);
        $em->flush();

        return self::createResponse($personnality);
    }
}