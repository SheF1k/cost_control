<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Revenue;
use AppBundle\Form\RevenueForm;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class RevenueController
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("Revenue")
 */
class RevenueController extends BaseRestController
{
    /**
     * @param Revenue $revenue
     * @return Revenue
     *
     * @Rest\View(serializerGroups={"default"})
     * @Security("is_granted('ABILITY_REVENUE_READ', revenue)")
     */
    public function getAction(Revenue $revenue = null)
    {
        if (!$revenue instanceof Revenue) {
            throw new NotFoundHttpException('Revenue not found');
        }

        return $revenue;
    }

    /**
     * Return Revenues.
     *
     * @Rest\QueryParam(name="_sort")
     * @Rest\QueryParam(name="_limit",  requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="_offset", requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="user", description="User")
     * @Rest\QueryParam(name="name", description="Name")
     * @Rest\QueryParam(name="total", description="Total")
     * @Rest\QueryParam(name="creationDate", description="Date of creation")
     * @Rest\QueryParam(name="isRegular", description="Regular")
     * @Rest\QueryParam(name="isArchieved", description="Archieved")
     * @param ParamFetcher $paramFetcher
     * @return Response
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        /** @var EntityRepository $repository */
        $repository = $this->getRepository('AppBundle:Revenue');
        $paramFetcher = $paramFetcher->all();
        $paramFetcher['user'] = $this->getUser()->getId();

        return $this->matching($repository, $paramFetcher, null, ['default']);
    }

    /**
     * Create a new Revenue.
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     * @Security("is_granted('ABILITY_REVENUE_CREATE')")
     */
    public function postAction(Request $request)
    {
        return $this->handleForm($request, RevenueForm::class, new Revenue());
    }

    /**
     * Edit existing Revenue.
     * @param Request $request
     * @param Revenue $revenue
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     * @Security("is_granted('ABILITY_REVENUE_UPDATE', revenue)")
     */
    public function putAction(Request $request, Revenue $revenue)
    {
        $groups = [
            'serializerGroups' => [
                'default',
            ],
            'formOptions' => [
                'validation_groups' => [
                    'default',
                    'Default',
                ],
            ],
        ];

        return $this->handleForm($request, RevenueForm::class, $revenue, $groups, true);
    }

    /**
     * Delete Revenue by id.
     *
     * @Rest\View(statusCode=204)
     *
     * @param Revenue $revenue
     * @return Response
     * @Security("is_granted('ABILITY_REVENUE_DELETE', revenue)")
     */
    public function deleteAction(Revenue $revenue = null)
    {
        if (!$revenue instanceof Revenue) {
            throw new NotFoundHttpException('Revenue not found');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($revenue);
        $em->flush();

        return null;
    }

    /**
     * Delete all revenues.
     *
     * @Rest\View(statusCode=204)
     *
     * @return Response
     */
    public function cdeleteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Revenue')
            ->deleteByUser($this->getUser());

        return null;
    }

    /**
     * Archive all revenues.
     *
     * @Rest\View(statusCode=204)
     *
     * @return Response
     */
    public function archiveAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Revenue')
            ->updateIsArcievedByUser($this->getUser());

        return null;
    }


}