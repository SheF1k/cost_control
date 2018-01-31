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
        $cost = $this->em->getRepository('AppBundle:Cost')->getDataForLastMonth($user);
        $revenue = $this->em->getRepository('AppBundle:Revenue')->getDataForLastMonth($user);
        $html = $this->templating->render('::export.html.twig', array(
            'costs'  => $cost,
            'revenues' => $revenue
        ));
        $creation_date = new \DateTime();
        $creation_date = $creation_date->format('Y-m-d H:i:s');
        $file_name = $creation_date . 'pdf';
        return new PdfResponse(
            $this->generator->getOutputFromHtml($html),
            $file_name
        );
    }
}