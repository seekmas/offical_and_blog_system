<?php

namespace Gemba\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Layout
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Layout
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
     * @ORM\Column(name="subject" , type="string" , length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="layout", type="string", length=255)
     */
    private $layout;

    /**
     * @ORM\ManyToOne(targetEntity="Block" , inversedBy="layout")
     * @ORM\JoinColumn(name="block_id" , referencedColumnName="id")
     */
    private $block;

    /**
     * @var integer
     *
     * @ORM\Column(name="block_id", type="integer")
     */
    private $blockId;

    /**
     * @ORM\Column(name="sort" , type="integer")
     */
    private $sort;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime" , nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="Smalltext" , mappedBy="layout")
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    private $smalltext;

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
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return Layout
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Set layout
     *
     * @param string $layout
     * @return Layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return string 
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return mixed
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @return Layout
     * @param mixed $block
     */
    public function setBlock($block)
    {
        $this->block = $block;
        return $this;
    }

    /**
     * Set blockId
     *
     * @param integer $blockId
     * @return Layout
     */
    public function setBlockId($blockId)
    {
        $this->blockId = $blockId;

        return $this;
    }

    /**
     * Get blockId
     *
     * @return integer 
     */
    public function getBlockId()
    {
        return $this->blockId;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return Layout
     * @param mixed $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Layout
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
     * @return Layout
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
     * @return Layout
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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return Layout
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmalltext()
    {
        return $this->smalltext;
    }

    /**
     * @return Layout
     * @param mixed $smalltext
     */
    public function setSmalltext($smalltext)
    {
        $this->smalltext = $smalltext;
        return $this;
    }

}
