<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Element;


#[ORM\Entity]
#[ApiResource]
class ElementAttribute 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column]
    private ?string $value = null;

    #[ORM\ManyToMany(targetEntity: Element::class, inversedBy: "attributes")]
    private ?Element $element = null;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue(string $value) {
        $this->value = $value;
        return $this;
    }

    public function getElement() {
        return $this->element;
    }

    public function setElement(?Element $element) {
        $this->element = $element;
        return $this;
    }
}