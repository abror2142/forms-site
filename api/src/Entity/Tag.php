<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Form;


#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ApiResource]
class Tag 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: Form::class, inversedBy: "tags")]
    #[ORM\JoinTable(name: "form_tags")]
    private Collection $forms;

    public function __construct()
    {
        $this->forms = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->descripton = $description;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getForms() 
    {
        return $this->forms;
    }

    public function addForm(Form $form)
    {
        if(!$this->forms->contains($form)){
            $this->forms->add($form);
            $form->addTag($this);
        }
        return $this;
    }

    public function removeForm(Form $form)
    {
        if($this->forms->removeElement($form)){
            $form->removeTag($this);
        }
    } 

}
