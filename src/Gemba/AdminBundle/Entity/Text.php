<?php

namespace Gemba\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Text
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Text
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="left_title", type="string", length=255)
     */
    private $leftTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="left_content", type="text")
     */
    private $leftContent;

    /**
     * @var string
     *
     * @ORM\Column(name="right_title", type="string", length=255)
     */
    private $rightTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="right_content", type="text")
     */
    private $rightContent;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="created_at", type="datetime")
    */
    private $createdAt;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="updated_at", type="datetime" , nullable=true)
    */
    private $updatedAt;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="deleted_at", type="datetime" , nullable=true)
    */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Layout" , inversedBy="text")
     * @ORM\JoinColumn(name="layout_id" , referencedColumnName="id")
     */
    private $layout;

    /**
     * @ORM\Column(name="layout_id" , type="integer")
     */
    private $layoutId;

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
     * Set title
     *
     * @param string $title
     * @return Text
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set leftTitle
     *
     * @param string $leftTitle
     * @return Text
     */
    public function setLeftTitle($leftTitle)
    {
        $this->leftTitle = $leftTitle;

        return $this;
    }

    /**
     * Get leftTitle
     *
     * @return string
     */
    public function getLeftTitle()
    {
        return $this->leftTitle;
    }

    /**
     * Set leftContent
     *
     * @param string $leftContent
     * @return Text
     */
    public function setLeftContent($leftContent)
    {
        $this->leftContent = $leftContent;

        return $this;
    }

    /**
     * Get leftContent
     *
     * @return string
     */
    public function getLeftContent()
    {
        return $this->leftContent;
    }

    /**
     * Set rightTitle
     *
     * @param string $rightTitle
     * @return Text
     */
    public function setRightTitle($rightTitle)
    {
        $this->rightTitle = $rightTitle;

        return $this;
    }

    /**
     * Get rightTitle
     *
     * @return string
     */
    public function getRightTitle()
    {
        return $this->rightTitle;
    }

    /**
     * Set rightContent
     *
     * @param string $rightContent
     * @return Text
     */
    public function setRightContent($rightContent)
    {
        $this->rightContent = $rightContent;

        return $this;
    }

    /**
     * Get rightContent
     *
     * @return string
     */
    public function getRightContent()
    {
        return $this->rightContent;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Text
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

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Text
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Text
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return Text
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLayoutId()
    {
        return $this->layoutId;
    }

    /**
     * @return Text
     * @param mixed $layoutId
     */
    public function setLayoutId($layoutId)
    {
        $this->layoutId = $layoutId;
        return $this;
    }
}
