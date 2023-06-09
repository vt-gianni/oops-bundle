<?php


namespace VTGianni\OopsBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use Exception;
use VTGianni\OopsBundle\Entity\Oops;

class OopsService
{
    private EntityManagerInterface $entityManager;
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Oops::class);
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
     * @param bool|null $desc
     * @param int $limit
     * @return array
     */
    public function filterErrors(?int $errorCode = null, ?bool $desc = true, int $limit = 10): array
    {
        return $this->repository->findBy(
            $errorCode ? ['error' => $errorCode] : [],
            ['incidentDate' => $desc ? 'DESC' : 'ASC'],
            $limit
        );
    }

    /**
     * @param int $nbDays
     * @param int|null $errorCode
     * @return int
     */
    public function countErrors(int $nbDays = 7, ?int $errorCode = null): int
    {
        $date = (new \DateTime())->modify('-' . $nbDays . ' days');

        return $this->repository->getNbErrors($date, $errorCode);
    }
}