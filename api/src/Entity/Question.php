<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORm;
use ApiPlatform\Metadata\ApiResource;
use EasyRdf\Literal\Boolean;

#[ORM\Entity]
#[ApiResource]
class Question 
{
    #[ORM\Id]
    #[ORM\Generatedvalue]
    #[ORm\Column]
    private ?int $id = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $text = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $required = null;

    #[ORM\Column()]
    private ?int $order = null;

    #[ORM\ManyToOne(targetEntity: Form::class, inversedBy: "questions")]
    private ?Form $form = null;

    #[ORM\OneToOne(targetEntity: Element::class, mappedBy: "question")]
    private ?Element $element = null;

    public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function setText(string $text) {
        $this->text = $text;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription(string $description) {
        $this->description = $description;
        return $this;
    }

    public function getRequired() {
        return $this->required;
    }

    public function setRequired(bool $required) {
        $this->required = $required;
        return $this;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder(int $order) {
        $this->order = $order;
        return $this;
    }

    public function getForm() {
        return $this->form;
    }

    public function setForm(?Form $form) {
        $this->form = $form;
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