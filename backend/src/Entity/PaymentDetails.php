<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PaymentDetailsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PaymentDetailsRepository::class)
 *  @ApiResource(
 *      attributes={"pagination_items_per_page"=30},
 *      itemOperations={
 *       "get",
 *       "delete",
 *       "put",
 *     },
 *   collectionOperations={
 *        "get",
 *        "post",
 *     },
 * )
 */
//todo Security based on role
class PaymentDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cardType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cardNum;

    /**
     * @ORM\Column(type="date")
     * @Groups({"payment_details"})
     */
    private $cardExpiry;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cardHolderName;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="payment")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardType(): ?string
    {
        return $this->cardType;
    }

    public function setCardType(string $cardType): self
    {
        $this->cardType = $cardType;

        return $this;
    }

    public function getCardNum(): ?string
    {
        return $this->cardNum;
    }

    public function setCardNum(string $cardNum): self
    {
        $this->cardNum = $cardNum;

        return $this;
    }

    public function getCardExpiry(): ?\DateTimeInterface
    {
        return $this->cardExpiry;
    }

    public function setCardExpiry(\DateTimeInterface $cardExpiry): self
    {
        $this->cardExpiry = $cardExpiry;

        return $this;
    }

    public function getCardHolderName(): ?string
    {
        return $this->cardHolderName;
    }

    public function setCardHolderName(string $cardHolderName): self
    {
        $this->cardHolderName = $cardHolderName;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString(): string
    {
        return $this->cardType;
    }
}
