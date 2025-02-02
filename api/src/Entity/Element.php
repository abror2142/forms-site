<?php 

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ElementAttribute;
use App\Entity\ElementChild;


#[ORM\Entity]
#[ApiResource]
class Element
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column]
    private ?string $type = null;

    #[ORM\OneToMany(targetEntity: ElementAttribute::class, mappedBy: "element")]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $attributes;

    #[ORM\OneToMany(targetEntity: ElementChild::class, mappedBy: 'element')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $children;

    #[ORM\OneToOne(targetEntity: Question::class, inversedBy: "element")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    public function __construct() {
        $this->attributes = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setType(string $type) {
        $this->type = $type;
        return $this;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function addAttribute(ElementAttribute $elementAttribute) {
        if(!$this->attributes->contains($elementAttribute)) {
            $this->attributes[] = $elementAttribute;
            $elementAttribute->setElement($this);
        }
    }

    public function removeAttribute(ElementAttribute $elementAttribute) {
        if($this->attributes->removeElement($elementAttribute)) {
            if($elementAttribute->getElement() == $this) {
                $elementAttribute->setElement(null);
            }
        }
    }

    public function getChildren() {
        return $this->children;
    }

    public function addChild(ElementChild $elementChild) {
        if(!$this->children->contains($elementChild)) {
            $this->children[] = $elementChild;
            $elementChild->setElement($this);
        }
    }

    public function removeChild(ElementChild $elementChild) {
        if($this->children->removeElement($elementChild)) {
            if($elementChild->getElement() == $this) {
                $elementChild->setElement(null);
            }
        }
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setQuestion(Question $question) {
        $this->question = $question;
        return $this;
    }
}