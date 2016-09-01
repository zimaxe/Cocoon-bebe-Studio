<?php

namespace AE\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AE\BookingBundle\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="orderDate", type="date")
     */
    private $orderDate;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="babyName", type="string", length=255, nullable=true)
     */
    private $babyName;

    /**
     * @var string
     *
     * @ORM\Column(name="babyFirstName", type="string", length=50, nullable=true)
     */
    private $babyFirstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBirth", type="date", nullable=true)
     */
    private $dateBirth;

    /**
     * @var bool
     *
     * @ORM\Column(name="gender", type="boolean", nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=40, nullable=true)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=70)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=5)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobileMother", type="string", length=20)
     */
    private $mobileMother;

    /**
     * @var string
     *
     * @ORM\Column(name="mobileFather", type="string", length=20, nullable=true)
     */
    private $mobileFather;

    /**
     * @var string
     *
     * @ORM\Column(name="emailMother", type="string", length=80)
     */
    private $emailMother;

    /**
     * @var string
     *
     * @ORM\Column(name="emailFather", type="string", length=80, nullable=true)
     */
    private $emailFather;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="maternity_id", type="integer", nullable=true)
     */
    private $maternityId;

    /**
     * @var bool
     *
     * @ORM\Column(name="validate", type="boolean")
     */
    private $validate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;
    



    public function __construct()
    {
        $this->validate = 1;
        $this->createdAt = new \DateTime();

    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return Customer
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set babyName
     *
     * @param string $babyName
     *
     * @return Customer
     */
    public function setBabyName($babyName)
    {
        $this->babyName = $babyName;

        return $this;
    }

    /**
     * Get babyName
     *
     * @return string
     */
    public function getBabyName()
    {
        return $this->babyName;
    }

    /**
     * Set babyFirstName
     *
     * @param string $babyFirstName
     *
     * @return Customer
     */
    public function setBabyFirstName($babyFirstName)
    {
        $this->babyFirstName = $babyFirstName;

        return $this;
    }

    /**
     * Get babyFirstName
     *
     * @return string
     */
    public function getBabyFirstName()
    {
        return $this->babyFirstName;
    }

    /**
     * Set dateBirth
     *
     * @param \DateTime $dateBirth
     *
     * @return Customer
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * Get dateBirth
     *
     * @return \DateTime
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     *
     * @return Customer
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set weight
     *
     * @param float $weight
     *
     * @return Customer
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return Customer
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Customer
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobileMother
     *
     * @param string $mobileMother
     *
     * @return Customer
     */
    public function setMobileMother($mobileMother)
    {
        $this->mobileMother = $mobileMother;

        return $this;
    }

    /**
     * Get mobileMother
     *
     * @return string
     */
    public function getMobileMother()
    {
        return $this->mobileMother;
    }

    /**
     * Set mobileFather
     *
     * @param string $mobileFather
     *
     * @return Customer
     */
    public function setMobileFather($mobileFather)
    {
        $this->mobileFather = $mobileFather;

        return $this;
    }

    /**
     * Get mobileFather
     *
     * @return string
     */
    public function getMobileFather()
    {
        return $this->mobileFather;
    }

    /**
     * Set emailMother
     *
     * @param string $emailMother
     *
     * @return Customer
     */
    public function setEmailMother($emailMother)
    {
        $this->emailMother = $emailMother;

        return $this;
    }

    /**
     * Get emailMother
     *
     * @return string
     */
    public function getEmailMother()
    {
        return $this->emailMother;
    }

    /**
     * Set emailFather
     *
     * @param string $emailFather
     *
     * @return Customer
     */
    public function setEmailFather($emailFather)
    {
        $this->emailFather = $emailFather;

        return $this;
    }

    /**
     * Get emailFather
     *
     * @return string
     */
    public function getEmailFather()
    {
        return $this->emailFather;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Customer
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set maternityId
     *
     * @param integer $maternityId
     *
     * @return Customer
     */
    public function setMaternityId($maternityId)
    {
        $this->maternityId = $maternityId;

        return $this;
    }

    /**
     * Get maternityId
     *
     * @return integer
     */
    public function getMaternityId()
    {
        return $this->maternityId;
    }

    /**
     * Set validate
     *
     * @param boolean $validate
     *
     * @return Customer
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * Get validate
     *
     * @return boolean
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Customer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
}
