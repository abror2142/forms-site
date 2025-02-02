<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;


#[ORM\Entity]
#[ApiResource]
class ImageField
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Form::class, inversedBy: "imageFields")]
    private ?Form $form;

    #[ORM\Column]
    private ?string $imageUrl = null;

    #[ORM\Column]
    private ?int $order = null;

    public function getId(){
        return $this->id;
    }

    public function getForm(){
        return $this->form;
    }

    public function setForm(?Form $form){
        $this->form = $form;
        return $this;
    }

    public function getImageUrl(){
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl){
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getOrder(){
        return $this->order;
    }

    public function setOrder(int $order){
        $this->order = $order;
        return $this;
    }

}