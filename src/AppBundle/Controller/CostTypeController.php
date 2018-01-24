<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CostType;
use AppBundle\Form\CostTypeForm;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class CostTypeController
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("CostType")
 */
class CostTypeController extends BaseRestController
{
    /**
     * @param CostType $cost_type
     * @return CostType
     *
     * @Rest\View(serializerGroups={"default", "detail"})
     * @Security("is_granted('ABILITY_TYPE_READ', cost_type)")
     */
    public function getAction(CostType $cost_type = null)
    {
        return $cost_type;
    }

    /**
     * Return CostTypes.
     *
     * @Rest\QueryParam(name="_sort")
     * @Rest\QueryParam(name="_limit",  requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="_offset", requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="user", description="User")
     * @Rest\QueryParam(name="name", description="Name")
     * @param ParamFetcher $paramFetcher
     * @return Response
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        /** @var EntityRepository $repository */
        $repository = $this->getRepository('AppBundle:CostType');
        $paramFetcher = $paramFetcher->all();
        $paramFetcher['user'] = $this->getUser()->getId();

        return $this->matching($repository, $paramFetcher, null, ['default', 'detail']);
    }

    /**
     * Create a new CostType.
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     * @Security("is_granted('ABILITY_TYPE_CREATE')")
     */
    public function postAction(Request $request)
    {
        $groups = [
            'serializerGroups' => [
                'default',
            ],
            'formOptions' => [
                'validation_groups' => [
                    'default',
                    'Default'
                ]
            ]
        ];
        return $this->handleForm($request, CostTypeForm::class, new CostType(), $groups);
    }

    /**
     * Edit existing CostType.
     * @param Request $request
     * @param CostType $cost_type
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     * @Security("is_granted('ABILITY_TYPE_UPDATE', cost_type)")
     */
    public function putAction(Request $request, CostType $cost_type)
    {
        $groups = [
            'serializerGroups' => [
                'default',
            ],
            'formOptions' => [
                'validation_groups' => [
                    'default',
                    'Default'
                ]
            ]
        ];

        return $this->handleForm($request, CostTypeForm::class, $cost_type, $groups, true);
    }

    /**
     * Delete CostType by id.
     *
     * @Rest\View(statusCode=204)
     *
     * @param CostType $cost_type
     * @return Response
     * @Security("is_granted('ABILITY_TYPE_DELETE', cost_type)")
     */
    public function deleteAction(CostType $cost_type = null)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cost_type);
        $em->flush();

        return null;
    }


}