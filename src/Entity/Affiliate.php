<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping AS ORM;

//Test comment

/**
 * @ORM\Entity()
 * @ORM\Table(name="affiliates")
 * @ORM\HasLifecycleCallbacks()
 */

class Affiliate
{
    /**
     * @var int
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $token;

    /**
     * @var bool
     * 
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var Category[]|ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="affiliates")
     * @ORM\JoinTable(name="affiliates_categories")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     *
     * @return self
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return boolean|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     *
     * @return self
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Category[]|ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category $category
     *
     * @return self
     */
    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    /**
     * @param Category $category
     *
     * @return self
     */
    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     *@ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }
}