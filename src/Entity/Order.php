<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeOfCreation;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $statusOfPay;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $User;

    /**
    @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $orderPrice;

    /**
     * @var OrderItem[]
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="Orders")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private $orderItem;

    public function __construct()
    {
        $this->orderItem = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTimeOfCreation(): ?\DateTimeInterface
    {
        return $this->timeOfCreation;
    }

    public function setTimeOfCreation(\DateTimeInterface $timeOfCreation): self
    {
        $this->timeOfCreation = $timeOfCreation;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }


    public function getStatusOfPay(): ?string
    {
        return $this->statusOfPay;
    }

    public function setStatusOfPay(string $statusOfPay): self
    {
        $this->statusOfPay = $statusOfPay;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->User;
    }

    public function setUser(string $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getOrderPrice(): ?string
    {
        return $this->orderPrice;
    }

    public function setOrderPrice(string $orderPrice): self
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItem(): Collection
    {
        return $this->orderItem;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItem->contains($orderItem)) {
            $this->orderItem[] = $orderItem;
            $orderItem->setOrders($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItem->contains($orderItem)) {
            $this->orderItem->removeElement($orderItem);
            // set the owning side to null (unless already changed)
            if ($orderItem->getOrders() === $this) {
                $orderItem->setOrders(null);
            }
        }

        return $this;
    }

}
