<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cost;
use AppBundle\Form\CostForm;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class CostController
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("Cost")
 */
class CostController extends BaseRestController
{
    /**
     * @param Cost $cost
     * @return Cost
     *
     * @Rest\View(serializerGroups={"default"})
     * @Security("is_granted('ABILITY_COST_READ', cost)")
     */
    public function getAction(Cost $cost = null)
    {
        return $cost;
    }

    /**
     * Return Costs.
     *
     * @Rest\QueryParam(name="_sort")
     * @Rest\QueryParam(name="_limit",  requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="_offset", requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="user", description="User")
     * @Rest\QueryParam(name="name", description="Name")
     * @Rest\QueryParam(name="type", description="Type of cost")
     * @Rest\QueryParam(name="sum", description="Total")
     * @Rest\QueryParam(name="creationDate", description="Date of creation")
     * @Rest\QueryParam(name="isRegular", description="Regular")
     * @param ParamFetcher $paramFetcher
     * @return Response
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        /** @var EntityRepository $repository */
        $repository = $this->getRepository('AppBundle:Cost');
        $paramFetcher = $paramFetcher->all();
        $paramFetcher['user'] = $this->getUser()->getId();

        return $this->matching($repository, $paramFetcher, null, ['default']);
    }

    /**
     * Create a new Cost.
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     * @Security("is_granted('ABILITY_COST_CREATE')")
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
        return $this->handleForm($request, CostForm::class, new Cost(), $groups);
    }

    /**
     * Edit existing Cost.
     * @param Request $request
     * @param Cost $cost
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     * @Security("is_granted('ABILITY_COST_UPDATE', cost)")
     */
    public function putAction(Request $request, Cost $cost)
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

        return $this->handleForm($request, CostForm::class, $cost, $groups, true);
    }

    /**
     * Delete Cost by id.
     *
     * @Rest\View(statusCode=204)
     *
     * @param Cost $cost
     * @return Response
     * @Security("is_granted('ABILITY_COST_DELETE', cost)")
     */
    public function deleteAction(Cost $cost = null)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cost);
        $em->flush();

        return null;
    }

}