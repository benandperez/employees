<?php

namespace App\Entity;

use App\Repository\EmployeesRepository;
use App\Util\TimeStampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeesRepository::class)
 */
class Employees
{
    use TimeStampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstNames;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastNames;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity=DocumentType::class, inversedBy="employees")
     */
    private $documentType;

    /**
     * @ORM\ManyToOne(targetEntity=SubArea::class, inversedBy="employees")
     */
    private $subArea;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstNames()
    {
        return $this->firstNames;
    }

    /**
     * @param mixed $firstNames
     */
    public function setFirstNames($firstNames): void
    {
        $this->firstNames = $firstNames;
    }


    public function getLastNames(): ?string
    {
        return $this->lastNames;
    }

    public function setLastNames(string $lastNames): self
    {
        $this->lastNames = $lastNames;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getDocumentType(): ?DocumentType
    {
        return $this->documentType;
    }

    public function setDocumentType(?DocumentType $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }

    public function getSubArea(): ?SubArea
    {
        return $this->subArea;
    }

    public function setSubArea(?SubArea $subArea): self
    {
        $this->subArea = $subArea;

        return $this;
    }
}
