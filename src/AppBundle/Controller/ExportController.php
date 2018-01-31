<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

/**
 * Class ExportController
 *
 * @Rest\NamePrefix("api_")
 */
class ExportController extends BaseRestController
{
    /**
     * @return PdfResponse
     */
    public function exportAction()
    {
        $user = $this->getUser();
        $exporter = $this->get("app.export_service");
        $pdf = $exporter->generatePdf($user);
        return $pdf;
    }

}
