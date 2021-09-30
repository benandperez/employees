<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use App\Util\TimeStampableEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AreaRepository::class)
 */
class Area
{
    use TimeStampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Employees::class, mappedBy="area")
     */
    private $employees;

    /**
     * @ORM\OneToMany(targetEntity=SubArea::class, mappedBy="area")
     */
    private $subAreas;


    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->subAreas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Employees[]
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employees $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setArea($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getArea() === $this) {
                $employee->setArea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SubArea[]
     */
    public function getSubAreas(): Collection
    {
        return $this->subAreas;
    }

    public function addSubArea(SubArea $subArea): self
    {
        if (!$this->subAreas->contains($subArea)) {
            $this->subAreas[] = $subArea;
            $subArea->setArea($this);
        }

        return $this;
    }

    public function removeSubArea(SubArea $subArea): self
    {
        if ($this->subAreas->removeElement($subArea)) {
            // set the owning side to null (unless already changed)
            if ($subArea->getArea() === $this) {
                $subArea->setArea(null);
            }
        }

        return $this;
    }
}
