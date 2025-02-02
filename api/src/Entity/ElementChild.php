<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Element;


#[ORM\Entity]
#[ApiResource()]
class ElementChild
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $type = null;

    #[ORM\Column]
    private ?string $content = null;

    #[ORM\ManyToOne(targetEntity: Element::class, inversedBy: "children")]
    private ?Element $element = null;

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType(string $type) {
        $this->type = $type;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent(string $content) {
        $this->content = $content;
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