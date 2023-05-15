<?php


namespace VTGianni\OopsBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use Exception;
use VTGianni\OopsBundle\Entity\Oops;
use VTGianni\OopsBundle\Repository\OopsRepository;

class OopsService
{
    private OopsRepository $repository;
    private EntityManagerInterface $entityManager;

    public function __construct(OopsRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $url
     * @param int $error
     * @param string|null $errorMessage
     * @param array|null $headers
     * @param array|null $requestBody
     * @param array|null $responseContent
     * @return Oops
     * @throws Exception
     */
    public function reportError(string $url, int $error, ?string $errorMessage = null, ?array $headers = null,
                                ?array $requestBody = null, ?array $responseContent = null): Oops
    {
        $oops = new Oops();
        $oops->setUrl($url);
        $oops->setError($error);
        $oops->setIncidentDate(
            new \DateTime(
                'now',
                new \DateTimeZone(
                    date_default_timezone_get()
                )
            )
        );
        $errorMessage && $oops->setErrorMessage($errorMessage);
        $headers && $oops->setHeaders($headers);
        $requestBody && $oops->setRequestBody($requestBody);
        $responseContent && $oops->setResponseContent($responseContent);

        $this->entityManager->persist($oops);
        $this->entityManager->flush();

        return $oops;
    }

    /**
     * @param int|null $errorCode
     * @param string|null $order
     * @param int $limit
     * @return array
     */
    public function getErrors(?int $errorCode = null, ?string $order = 'DESC', int $limit = 10): array
    {
        return $this->repository->findBy(
            $errorCode ? ['error' => $errorCode] : [],
            ['incidentDate' => $order],
            $limit
        );
    }

    /**
     * @param int $nb
     * @return int
     */
    public function getNbErrors(int $nb = 7): int
    {
        $date = (new \DateTime())->modify('-' . $nb . ' days');

        return $this->repository->getNbErrors($date);
    }
}