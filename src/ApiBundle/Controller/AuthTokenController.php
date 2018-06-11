<?php
namespace ApiBundle\Controller;

use ApiBundle\Entity\AuthToken;
use ApiBundle\Entity\Credentials;
use ApiBundle\Exception\BadRequestException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use \Datetime;
use ApiBundle\Form\Type\CredentialsType;


class AuthTokenController extends AbstractController
{
    protected function getGroup() {
        return "auth-token";
    }

    /**
     * @Rest\Post(
     *      path = "/auth-token",
     * )
     * @ParamConverter("authToken", class="ApiBundle\Entity\AuthToken", converter="fos_rest.request_body")
     */
    public function createAction(Request $request, AuthToken $authToken)
    {
        return $this->invalidCredentials();
    }

    private function invalidCredentials()
    {
        throw new BadRequestException("Invalid credentials");
    }
}