<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\User;
use ApiBundle\Entity\UsersFablab;
use ApiBundle\Entity\Position;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use \Datetime;

class UserController extends AbstractController
{

    /**
     * @Rest\Get(
     *      path = "/users"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns users",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="fname", type="string"),
     *              @SWG\Property(property="lname", type="string"),
     *              @SWG\Property(property="email", type="string"),
     *              @SWG\Property(property="login", type="string"),
     *              @SWG\Property(property="wallet_address", type="string"),
     *              @SWG\Property(property="private_key", type="string")
     *         )
     *     )
     * )
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('ApiBundle:User')->findAll();
        
        return self::createResponse($users);
    }

    /**
     * @Rest\Get(
     *      path = "/users/{id}",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return the user data",
     *     @SWG\Schema(
     *          type="object",
     *          @SWG\Property(property="id", type="integer"),
     *          @SWG\Property(property="fname", type="string"),
     *          @SWG\Property(property="lname", type="string"),
     *          @SWG\Property(property="email", type="string"),
     *          @SWG\Property(property="login", type="string"),
     *          @SWG\Property(property="private_key", type="string"),
     *          @SWG\Property(property="wallet_address", type="string")
     *     )
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when the user ID doesn't exist"
     * )
     */
    public function getAction(User $user)
    {
        return self::createResponse($user);
    }

    private function addFablab(User $user, \ApiBundle\Entity\Fablab $fablab)
    {
        $userFablab = new UsersFabLab();
        $userFablab->setFablab($fablab);
        $userFablab->setUser($user);
        $dt = new DateTime();
        $userFablab->setJoinedAt(new DateTime());

        $user->addUsersFablab($userFablab);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);             
        $em->persist($userFablab);

        return $this;
    }

    /**
     * @Rest\Post(
     *      path = "/users",
     * )
     * @ParamConverter("user", class="ApiBundle\Entity\User", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, User $user)
    {
        if(null == $user->getFname()) {
            throw new BadRequestException("'fname' is needed");
        }

        if(null == $user->getLname()) {
            throw new BadRequestException("'lname' is needed");
        }

        if(null == $user->getLogin()) {
            throw new BadRequestException("'login' is needed");
        }

        if(null == $user->getPassword()) {
            throw new BadRequestException("'password' is needed");
        }

        $em = $this->getDoctrine()->getManager();
        $body = (array)json_decode($req->getContent());

        if(isset($body['usersFablabs']) && count($body['usersFablabs']) > 0) {
            $fablabsRaw = $body['usersFablabs'];

            foreach($fablabsRaw as $fablabRaw) {
                $fablabRaw = (array)$fablabRaw;
                $id = $fablabRaw["id"];

                $fablab = $this->getDoctrine()->getRepository('ApiBundle:Fablab')->find($id);
                if($fablab != null) {
                    $this->addFablab($user, $fablab);
                } else {
                    throw new BadRequestException("The fablab (id " . $id . ") doesn't exist.");
                }
            }
        }

        if($this->isFloat($req, 'longitude', -180, 180) && $this->isFloat($req, 'latitude', 0, 90)) {
            $position = new Position();
            $position->setLatitude($req->get('latitude'));
            $position->setLongitude($req->get('longitude'));
            $em->persist($position);
            $user->setPosition($position);
        }

        $em->persist($user);
        $em->flush();

        return self::createResponse($user);
    }

    /**
     * @Rest\Put(
     *      path = "/users/{id}",
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
    public function updateAction(Request $req, User $user)
    {
        $portrait_id = $req->get('portrait_id');
        if(isset($portrait_id)) {
            if(!is_int($portrait_id)) {
                throw new BadRequestException("portrait_id must be an integer");
            }

            $portrait = $this->getDoctrine()->getRepository('ApiBundle:Portrait')->find($portrait_id);
            if(null == $portrait) {
                throw new BadRequestException("portrait_id " . $portrait_id . " doesn't exist");
            }

            $user->setPortrait($portrait);
        }

        $motivation_id = $req->get('motivation_id');
        if(isset($motivation_id)) {
            if(!is_int($motivation_id)) {
                throw new BadRequestException("motivation_id must be an integer");
            }

            $motivation = $this->getDoctrine()->getRepository('ApiBundle:Motivation')->find($motivation_id);
            if(null == $motivation) {
                throw new BadRequestException("motivation_id " . $motivation_id . " doesn't exist");
            }

            $user->setMotivation($motivation);
        }

        $personnality_id = $req->get('personnality_id');
        if(isset($personnality_id)) {
            if(!is_int($personnality_id)) {
                throw new BadRequestException("personnality_id must be an integer");
            }

            $personnality = $this->getDoctrine()->getRepository('ApiBundle:Personnality')->find($personnality_id);
            if(null == $personnality) {
                throw new BadRequestException("personnality_id " . $personnality_id . " doesn't exist");
            }

            $user->setPersonnality($personnality);
        }

        if($this->isString($req, 'fname')) {
            $user->setFname($req->get('fname'));
        }

        if($this->isString($req, 'lname')) {
            $user->setLname($req->get('lname'));
        }

        if($this->isString($req, 'email')) {
            $user->setEmail($req->get('email'));
        }

        if($this->isString($req, 'login')) {
            $user->setLogin($req->get('login'));
        }
        
        if($this->isInteger($req, 'note')) {
            $user->setNote($req->get('note'));
        }

        if($this->isInteger($req, 'current_reward_points')) {
            $user->setCurrentRewardPoints($req->get('current_reward_points'));
        }

        if($this->isInteger($req, 'total_reward_points')) {
            $user->setTotalRewardPoints($req->get('total_reward_points'));
        }

        if($this->isString($req, 'wallet_address')) {
            $user->setWalletAddress($req->get('wallet_address'));
        }

        if($this->isString($req, 'private_key')) {
            $user->setPrivateKey($req->get('private_key'));
        }

        if($this->isString($req, 'password')) {
            $user->setPassword($req->get('password'));
        }

        if($this->isString($req, 'photo')) {
            $user->setPhoto($req->get('photo'));
        }

        if($this->isString($req, 'quote')) {
            $user->setQuote($req->get('quote'));
        }

        if($this->isString($req, 'biography')) {
            $user->setBiography($req->get('biography'));
        }
        
        if($this->isInteger($req, 'money')) {
            $user->setMoney($req->get('money'));
        }

        $em = $this->getDoctrine()->getManager();

        if($this->isFloat($req, 'longitude', -180, 180) && $this->isFloat($req, 'latitude', 0, 90)) {
            $position = new Position();
            $position->setLatitude($req->get('latitude'));
            $position->setLongitude($req->get('longitude'));
            $em->persist($position);
            $user->setPosition($position);
        }

        $em->merge($user);
        $em->flush();

        return self::createResponse($user);
    }
}