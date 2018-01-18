<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Revenue;
use AppBundle\Form\RevenueForm;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
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
     * @param Revenue $Revenue
     * @return Revenue
     *
     * @Rest\View(serializerGroups={"default"})
     */
    public function getAction(Revenue $Revenue = null)
    {
        if (!$Revenue instanceof Revenue) {
            throw new NotFoundHttpException('Revenue not found');
        }
        return $Revenue;
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
     * @param ParamFetcher $paramFetcher
     * @return Response
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        /** @var EntityRepository $repository */
        $repository = $this->getRepository('AppBundle:Revenue');
        $paramFetcher = $paramFetcher->all();
        return $this->matching($repository, $paramFetcher, null, ['default']);
    }

    /**
     * Create a new Revenue.
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     */
    public function postAction(Request $request)
    {
        return $this->handleForm($request, RevenueForm::class, new Revenue());
    }

    /**
     * Edit existing Revenue.
     * @param Request $request
     * @param Revenue $Revenue
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     */
    public function putAction(Request $request, Revenue $Revenue)
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

        return $this->handleForm($request, RevenueForm::class, $Revenue, $groups, true);
    }

    /**
     * Delete Revenue by id.
     *
     * @Rest\View(statusCode=204)
     *
     * @param Revenue $Revenue
     * @return Response
     */
    public function deleteAction(Revenue $Revenue = null)
    {
        if (!$Revenue instanceof Revenue) {
            throw new NotFoundHttpException('Revenue not found');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($Revenue);
        $em->flush();
        return null;
    }
}