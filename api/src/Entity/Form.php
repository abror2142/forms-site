<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FormRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Tag;
use App\Entity\Topic;
use App\Entity\Question;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: FormRepository::class)]
#[ApiResource]
class Form
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'forms')]
    private ?User $owner = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true, type: "text")]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: "forms")]
    private Collection $tags;

    #[ORM\ManyToOne(targetEntity: Topic::class, inversedBy: "forms")]
    #[ORM\JoinColumn(nullable: true)]
    private ?Topic $topic = null;

    #[ORM\OneToMany(targetEntity: ImageField::class, mappedBy: "form")]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $imageFields;

    #[ORM\OneToMany(targetEntity: TextField::class, mappedBy: 'form')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $textFields;

    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: "form")]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $questions;
    
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->imageFields = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getTag()
    {
        return $this->tags;
    }

    public function addTag(Tag $tag) 
    {
        if(!$this->tags->contains($tag)){
            $this->tags->add($tag);
            $tag->addForm($this);
        }
    }

    public function removeTag(Tag $tag)
    {
        if($this->tags->removeElement($tag)){
            $tag->removeForm($this);
        }
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function setTopic(?Topic $topic)
    {
        $this->topic = $topic;
        return $this;
    }

    public function getImageFields() {
        return $this->imageFields;
    }

    public function addImageField(ImageField $imageField){
        if(!$this->imageFields->contains($imageField)){
            $this->imageFields->add($imageField);
            $imageField->setForm($this);
        }
        return $this;
    }

    public function removeImageField(Imagefield $imageField) {
        if($this->imageFields->removeElement($imageField)){
            if($imageField->getForm() === $this) {
                $imageField->setForm(null);
            }
        }
    }

    public function getTextFields() {
        return $this->textFields;
    }

    public function addTextField(TextField $textField){
        if(!$this->textFields->contains($textField)){
            $this->textFields->add($textField);
            $textField->setForm($this);
        }
    }

    public function removeTextField(TextField $textField) {
        if($this->textFields->removeElement($textField)){
            if($textField->getForm() === $this) {
                $textField->setForm(null);
            }
        }
    }

    public function getQuestions() {
        return $this->questions;
    }

    public function addQuestion(Question $question){
        if(!$this->questions->contains($question)){
            $this->questions->add($question);
            $question->setForm($this);
        }
    }

    public function removeQuestion(Question $question) {
        if($this->questions->removeElement($question)){
            if($question->getForm() === $this) {
                $question->setForm(null);
            }
        }
    }

}
