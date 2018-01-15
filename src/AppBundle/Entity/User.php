<?php
/**
 * Created by PhpStorm.
 * User: oleksandr
 * Date: 11.01.18
 * Time: 15:59
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @JMS\ExclusionPolicy("all")
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @var int
     *
     * @JMS\Expose
     * @JMS\Groups({"default", "Default", "auth"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default", "auth"})
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $fullName;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default", "auth"})
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @JMS\Expose
     * @JMS\Groups({"default", "auth"})
     * @ORM\Column(type="string", nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"registration"})
     */
    private $plainPassword = null;


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
     * Set fullName.
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plainPassword.
     *
     * @param string plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
}
