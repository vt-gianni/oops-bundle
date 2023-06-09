<?php

namespace VTGianni\OopsBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use VTGianni\OopsBundle\Repository\OopsRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="VTGianni\OopsBundle\Repository\OopsRepository")
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
     * @Assert\Url(
     *     message = "The url '{{ value }}' is not a valid url.",
     *     protocols = {"http", "https", "ftp"}
     * )
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "The url cannot be longer than {{ limit }} characters"
     * )
     */
    private ?string $url;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="The error must be a positive number or zero.")
     */
    private ?int $error;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *     max = 1000,
     *     maxMessage = "The error message cannot be longer than {{ limit }} characters."
     * )
     */
    private ?string $errorMessage;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private ?array $headers = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private ?array $requestBody = [];

    /**
     * @ORM\Column(type="json", nullable=true)
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
