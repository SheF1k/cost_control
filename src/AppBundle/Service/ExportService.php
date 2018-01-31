<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;

class ExportService
{

    /** @var Pdf $generator */
    private $generator;

    /** @var EntityManagerInterface $em */
    protected $em;

    private $templating;

    public function __construct(Pdf $generator, EntityManagerInterface $em, $templating)
    {
        $this->generator = $generator;
        $this->em = $em;
        $this->templating = $templating;
    }

    public function generatePdf(User $user)
    {
        $cost = $this->em->getRepository('AppBundle:Cost')->getCostsForLastMonth($user);
        $html = $this->templating->render('::export.html.twig', array(
            'cost'  => $cost
        ));
        return new PdfResponse(
            $this->generator->getOutputFromHtml($html),
            'file.pdf'
        );
    }
}