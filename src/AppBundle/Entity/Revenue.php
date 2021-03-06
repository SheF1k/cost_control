<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * Revenue
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table(name="revenue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RevenueRepository")
 * @ORM\EntityListeners({"AppBundle\EventListener\DoctrineEntityListener\SetOwnerListener"})
 * @ORM\HasLifecycleCallbacks()
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
     * @Assert\DateTime()
     */
    private $creationDate;

    /**
     * @var bool|null
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="isRegular", type="boolean", nullable=true, options={"default" : false})
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
     * @var bool
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="isArchieved", type="boolean", nullable=true, options={"default" : false})
     */
    private $isArchieved = false;

    /**
     * @var string
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="period", type="smallint", nullable=true)
     * @AppAssert\RevenuePeriod()
     */
    private $period;

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
     *
     * @return Revenue
     * @ORM\PrePersist()
     */
    public function setCreationDate()
    {
        $this->creationDate = new \DateTime();

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
     * Set isArchieved.
     *
     * @param bool $isArchieved
     *
     * @return Revenue
     */
    public function setIsArchieved($isArchieved)
    {
        $this->isArchieved = $isArchieved;

        return $this;
    }

    /**
     * Get isArchieved.
     *
     * @return bool
     */
    public function getIsArchieved()
    {
        return $this->isArchieved;
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

    /**
     * Set period.
     *
     * @param int|null $period
     *
     * @return Revenue
     */
    public function setPeriod($period = null)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period.
     *
     * @return int|null
     */
    public function getPeriod()
    {
        return $this->period;
    }
}
