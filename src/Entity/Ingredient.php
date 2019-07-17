<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mesureUnit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IngredientQuantity", mappedBy="ingredient", orphanRemoval=true)
     */
    private $quantity;

    public function __construct()
    {
        $this->quantity = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMesureUnit(): ?string
    {
        return $this->mesureUnit;
    }

    public function setMesureUnit(string $mesureUnit): self
    {
        $this->mesureUnit = $mesureUnit;

        return $this;
    }

    /**
     * @return Collection|IngredientQuantity[]
     */
    public function getQuantity(): Collection
    {
        return $this->quantity;
    }

    public function addQuantity(IngredientQuantity $quantity): self
    {
        if (!$this->quantity->contains($quantity)) {
            $this->quantity[] = $quantity;
            $quantity->setIngredient($this);
        }

        return $this;
    }

    public function removeQuantity(IngredientQuantity $quantity): self
    {
        if ($this->quantity->contains($quantity)) {
            $this->quantity->removeElement($quantity);
            // set the owning side to null (unless already changed)
            if ($quantity->getIngredient() === $this) {
                $quantity->setIngredient(null);
            }
        }

        return $this;
    }
}
