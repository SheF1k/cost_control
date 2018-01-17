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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @JMS\ExclusionPolicy("all")
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", groups={"registration", "default"})
 */
class User implements UserInterface
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
     * @Assert\Email()
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
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
     * @JMS\Expose
     * @JMS\Groups({"default", "auth"})
     * @ORM\Column(type="string", nullable=true, options={"default" : "ROLE_USER"})
     */
    protected $role;

    /**
     * @JMS\Expose
     * @JMS\Groups({"auth"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $accessToken;

    /**
     * @JMS\Expose
     * @JMS\Groups({"auth"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $expirationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $salt;

    /**
     * Set salt.
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }


    /**
     * Get salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

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

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Set accessToken.
     *
     * @param string $accessToken
     *
     * @return User
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get role.
     *
     * @return string|null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set expirationDate.
     *
     * @param \DateTime|null $expirationDate
     *
     * @return User
     */
    public function setExpirationDate($expirationDate = null)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate.
     *
     * @return \DateTime|null
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }
}
