<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Entity\User;

class UserController extends AbstractController
{
    /**
     * @Route("/users", methods={"GET"})
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns users",
     *     @SWG\Schema(
     *         type="array"
     *     )
     * )
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('ApiBundle:User')->findAll();
        
        return self::createResponse($users);
    }

    /**
     * @Route("/user", methods={"POST"})
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Create new user with given data",
     * )
     */
    public function addAction(Request $request)
    {
        $user = new User();
        $user->setFname('Ayoub');
        $user->setLname('Idrissi');
        $user->setEmail("ayoub.Idrissi2@outlook.fr");
        $user->setLogin("aidrissi2");

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'User have been saved.');
        return $this->redirectToRoute('oc_platform_view', array('id' => $user->getId()));
  }
}