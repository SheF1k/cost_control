<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * Cost
 *
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table(name="cost")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CostRepository")
 * @ORM\EntityListeners({"AppBundle\EventListener\DoctrineEntityListener\SetOwnerListener"})
 * @ORM\HasLifecycleCallbacks()
 */
class Cost implements HasOwnerInterface
{
    /**
     * @var int
     *
     * @JMS\Expose
     * @JMS\Groups({"default", "Default"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var float
     *
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="sum", type="float")
     * @Assert\NotBlank()
     */
    private $sum;

    /**
     * @var \DateTime
     *
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="creationDate", type="datetime")
     * @Assert\DateTime()
     */
    private $creationDate;

    /**
     * @var bool|null
     *
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="isRegular", type="boolean", nullable=true, options={"default" : false})
     */
    private $isRegular = false;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @var string
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default"})
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CostType")
     * @ORM\JoinColumn(name="cost_type_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $type;

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
     * @return Cost
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
     * Set sum.
     *
     * @param float $sum
     *
     * @return Cost
     */
    public function setSum($sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * Get sum.
     *
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Set creationDate.
     *
     *
     * @return Cost
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
     * @return Cost
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Cost
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
     * @return Cost
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
     * Set type.
     *
     * @param CostType
     *
     * @return Cost
     */
    public function setType(CostType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return CostType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return User[]
     */
    public function getOwners()
    {
        return [$this->getUser()];
    }

    /**
     * Set period.
     *
     * @param int|null $period
     *
     * @return Cost
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
