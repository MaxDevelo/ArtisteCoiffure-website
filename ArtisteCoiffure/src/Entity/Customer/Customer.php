<?php

namespace App\Entity\Customer;

use App\Entity\Booking;
use App\Repository\Customer\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_of_birth = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'customers')]
    private Collection $bookings_customer;

    /**
     * @var Collection<int, CustomerAddress>
     */
    #[ORM\ManyToMany(targetEntity: CustomerAddress::class, inversedBy: 'customers')]
    private Collection $customer_addresses;

    public function __construct()
    {
        $this->bookings_customer = new ArrayCollection();
        $this->customer_addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): static
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

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

    /**
     * @return Collection<int, Booking>
     */
    public function getBookingsCustomer(): Collection
    {
        return $this->bookings_customer;
    }

    public function addBookingsCustomer(Booking $bookingsCustomer): static
    {
        if (!$this->bookings_customer->contains($bookingsCustomer)) {
            $this->bookings_customer->add($bookingsCustomer);
            $bookingsCustomer->setCustomers($this);
        }

        return $this;
    }

    public function removeBookingsCustomer(Booking $bookingsCustomer): static
    {
        if ($this->bookings_customer->removeElement($bookingsCustomer)) {
            // set the owning side to null (unless already changed)
            if ($bookingsCustomer->getCustomers() === $this) {
                $bookingsCustomer->setCustomers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomerAddress>
     */
    public function getCustomerAddresses(): Collection
    {
        return $this->customer_addresses;
    }

    public function addCustomerAddress(CustomerAddress $customerAddress): static
    {
        if (!$this->customer_addresses->contains($customerAddress)) {
            $this->customer_addresses->add($customerAddress);
        }

        return $this;
    }

    public function removeCustomerAddress(CustomerAddress $customerAddress): static
    {
        $this->customer_addresses->removeElement($customerAddress);

        return $this;
    }
}
