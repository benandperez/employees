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
     * @ORM\OneToMany(targetEntity=SubArea::class, mappedBy="area")
     */
    private $subAreas;


    public function __construct()
    {
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
