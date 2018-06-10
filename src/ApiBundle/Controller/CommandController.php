<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\Command;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Exception\BadRequestException;

class CommandController extends AbstractController
{
    protected function getGroup() {
        return "command";
    }

    /**
     * @Rest\Get(
     *      path = "/commands"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns commands",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(
     *              type="object",
     *              @SWG\Property(property="id", type="integer"),
     *              @SWG\Property(property="lastDigitCard", type="integer"),
     *              @SWG\Property(property="dateCommand", type="string"),
     *              @SWG\Property(property="status", type="string"),
     *              @SWG\Property(property="billingAddress", type="string"),
     *              @SWG\Property(property="deliveryAddress", type="string")
     *         )
     *     )
     * )
     */
    public function getAllAction()
    {
        $data = $this->getDoctrine()->getRepository('ApiBundle:Command')->findAll();
        
        return self::createResponse($data);
    }

    /**
     * @Rest\Get(
     *      path = "/commands/{id}",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return the command data",
     *     @SWG\Schema(
     *          type="object",
     *          @SWG\Property(property="id", type="integer"),
     *          @SWG\Property(property="lastDigitCard", type="integer"),
     *          @SWG\Property(property="dateCommand", type="string"),
     *          @SWG\Property(property="status", type="string"),
     *          @SWG\Property(property="billingAddress", type="string"),
     *          @SWG\Property(property="deliveryAddress", type="string")
     *     )
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when the user ID doesn't exist"
     * )
     */
    public function getAction(Command $data)
    {
        return self::createResponse($data);
    }

    /**
     * @Rest\Post(
     *      path = "/commands",
     * )
     * @ParamConverter("command", class="ApiBundle\Entity\Command", converter="fos_rest.request_body")
     * @SWG\Response(
     *      response = 201,
     *      description="Returned when created"
     * )
     * @SWG\Response(
     *      response = 400,
     *      description="Returned when a violation is raised by validation"
     * )
     */
    public function createAction(Request $req, Command $command)
    {

        $purchaser_id = $req->get('purchaser_id');

        if(null == $purchaser_id || !is_int($purchaser_id)) {
            throw new BadRequestException("purchaser_id (integer) is needed");
        }

        $purchaser = $this->getDoctrine()->getRepository('ApiBundle:User')->find($purchaser_id);
        if(null == $purchaser) {
            throw new BadRequestException("user/purchaser " . $purchaser_id . " doesn't exist");
        }

        $command->setPurchaser($purchaser);
        $command->setBillingAddress($req->get('billingAddress'));
        $command->setDeliveryAddress($req->get('deliveryAddress'));
        $command->setLastDigitCard($req->get('lastDigitCard'));
        $command->setDateCommand(date_create_from_format('Y-m-d\TH:i:s',$req->get('dateCommand')));

        $em = $this->getDoctrine()->getManager();
        // on persiste la commande
        $em->persist($command);

        $purchases = $command->getPurchases();

        if(null == $purchases) {
            throw new BadRequestException("You must specified at least one purchase in a command");
        }

        $purchases = $purchases->toArray();

        for($i = 0 ; $i < count($purchases) ; $i++) {
            // on lie la commande aux achats
            $purchase = $purchases[$i];
            $purchase->setCommand($command);
            
            if(!isset($req->get('purchases')[$i]['product_id'])) {
                throw new BadRequestException("product_id is needed for adding purchase");
            }
            $product_id = $req->get('purchases')[$i]['product_id'];
            
            $product = $this->getDoctrine()->getRepository('ApiBundle:Product')->find($product_id);
            if(null == $product) {
                throw new BadRequestException("product with product_id " . $product_id . " doesn't exist");
            }

            // on lie le produit à l'achat
            $purchases[$i]->setProduct($product);
        }

        $em->flush();

        return self::createResponse($command);
    }

    /**
     * @Rest\Put(
     *      path = "/commands/{id}",
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
    public function updateAction(Request $req, Command $command)
    {
        $body = (array)json_decode($req->getContent(), true);
        $newStatus = $body['status'];

        if(!isset($newStatus)) {
            throw $this->createNotFoundException("'status' must appear in body");
        }

        if(!in_array($newStatus,['pending','paid','cancelled'])) {
            throw $this->createNotFoundException("'status' should be 'pending','paid' or 'cancelled'");
        }

        $command->setStatus($newStatus);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return self::createResponse($command);
    }

    /**
     * @Rest\Delete(
     *      path = "/commands/{id}",
     * )
     * @SWG\Response(
     *      response = 200,
     *      description="Returned when deleted"
     * )
     * @SWG\Response(
     *      response = 404,
     *      description="Returned when command id doesn't exist"
     * )
     */
    public function deleteAction(Command $data)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($data);
        $em->flush();

        return self::createResponse($data);
    }
}