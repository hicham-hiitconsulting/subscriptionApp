<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 *  * @ApiResource(
 *     normalizationContext={"groups"={"subscription"}},
 *      itemOperations={
 *       "get",
 *       "delete",
 *       "put"
 *
 *     },
 *   collectionOperations={
 *        "get",
 *        "post"
 *
 *     },
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *      "id"="exact",
 *      "startDate"="exact",
 *      "endDate"="exact",
 *      "status"="exact"
 *
 *     }
 * )
 */
//todo Security based on role
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"subscription"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;
    /**
     * @ORM\Column(type="datetime")
     * @Groups({"subscription"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"subscription"})
     */
    private $endDate;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"subscription"})
     */
    private $status;



    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"subscription"})
     * @ApiSubresource()
     *
     */
    private $service;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="subscriptions")
     */
    private $subscriber;

    public function __construct()
    {
        $this->subscriber = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }


    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }




    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }



    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
    public function __toString(): string
    {
        return $this->title;
    }

    /**
     * @return Collection|User[]
     */
    public function getSubscriber(): Collection
    {
        return $this->subscriber;
    }

    public function addSubscriber(User $subscriber): self
    {
        if (!$this->subscriber->contains($subscriber)) {
            $this->subscriber[] = $subscriber;
        }

        return $this;
    }

    public function removeSubscriber(User $subscriber): self
    {
        $this->subscriber->removeElement($subscriber);

        return $this;
    }
}
