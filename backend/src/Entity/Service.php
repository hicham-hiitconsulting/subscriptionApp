<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @ApiResource(
 *   attributes={"pagination_items_per_page"=30},
 *   normalizationContext={"groups"={"service"}},
 *   itemOperations={
 *       "get",
 *       "delete",
 *       "put"
 *     },
 *   collectionOperations={
 *        "get",
 *        "post"
 *     },
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *      "id"="exact",
 *      "name"="exact",
 *     }
 * )
 */
//todo Security based on role
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"service"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"service","subscription"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Subscription::class, mappedBy="service",cascade={"remove"})
     *
     */
    private $subscriptions;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"service"})
     */
    private $url;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    public function __construct()
    {
        $this->subscriptions = new ArrayCollection();
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

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setService($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getService() === $this) {
                $subscription->setService(null);
            }
        }

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
