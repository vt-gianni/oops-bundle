<?php

namespace VTGianni\OopsBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use VTGianni\OopsBundle\Repository\OopsRepository;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OopsRepository")
 */
class Oops
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $url;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $error;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $errorMessage;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private ?array $headers = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private ?array $requestBody = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private ?array $responseContent = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $incidentDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getError(): ?int
    {
        return $this->error;
    }

    public function setError(int $error): self
    {
        $this->error = $error;

        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function setErrorMessage(?string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(?array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function getRequestBody(): array
    {
        return $this->requestBody;
    }

    public function setRequestBody(?array $requestBody): self
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    public function getResponseContent(): array
    {
        return $this->responseContent;
    }

    public function setResponseContent(?array $responseContent): self
    {
        $this->responseContent = $responseContent;

        return $this;
    }

    public function getIncidentDate(): ?\DateTimeInterface
    {
        return $this->incidentDate;
    }

    public function setIncidentDate(\DateTimeInterface $incidentDate): self
    {
        $this->incidentDate = $incidentDate;

        return $this;
    }
}
