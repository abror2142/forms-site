<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ApiResource]
class TextField 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Form::class, inversedBy: "textFields")]
    private Form $form;

    #[ORM\Column(nullable: true)]
    private ?string $title = null;

    #[ORM\Column(nullable: true, type: "text")]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $order = null;

    public function getForm(){
        return $this->form;
    }

    public function setForm(?Form $form) {
        $this->form = $form;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle(?string $title) {
        $this->title = $title;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription(?string $descriiption) {
        $this->description = $descriiption;
        return $$this;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder(?int $order) {
        $this->order = $order;
        return $this;
    }
}