<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Revenue
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table(name="revenue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RevenueRepository")
 */
class Revenue implements HasOwnerInterface
{
    /**
     * @var int
     * @JMS\Expose
     * @JMS\Groups({"default", "Default"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var float
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="total", type="float")
     * @Assert\NotBlank()
     */
    private $total;

    /**
     * @var \DateTime
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="creationDate", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $creationDate;

    /**
     * @var bool|null
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="isRegular", type="boolean", nullable=true)
     * @Assert\NotBlank()
     */
    private $isRegular;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var string
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Revenue
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set total.
     *
     * @param float $total
     *
     * @return Revenue
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total.
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return Revenue
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate.
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set isRegular.
     *
     * @param bool|null $isRegular
     *
     * @return Revenue
     */
    public function setIsRegular($isRegular = null)
    {
        $this->isRegular = $isRegular;

        return $this;
    }

    /**
     * Get isRegular.
     *
     * @return bool|null
     */
    public function getIsRegular()
    {
        return $this->isRegular;
    }

    /**
     * @return User[]
     */
    public function getOwners()
    {
        return [$this->getUser()];
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Revenue
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set note.
     *
     * @param string $note
     *
     * @return Revenue
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}
