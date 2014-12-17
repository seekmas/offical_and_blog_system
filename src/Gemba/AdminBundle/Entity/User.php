<?php


namespace Gemba\AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Userinfo" , mappedBy="user")
     */
    private $userinfo;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getUserinfo()
    {
        return $this->userinfo;
    }

    /**
     * @return User
     * @param mixed $userinfo
     */
    public function setUserinfo($userinfo)
    {
        $this->userinfo = $userinfo;
        return $this;
    }
}