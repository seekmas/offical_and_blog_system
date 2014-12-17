<?php

namespace Gemba\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smalltext
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Smalltext
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
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text" , nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(name="link" , type="string" , length=255 , nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(name="file" , type="string" , length=255 , nullable=true)
     */
    private $file;

    /**
     * @ORM\Column(name="style" , type="string" , length=255)
     */
    private $style;

    /**
     * @var string
     *
     * @ORM\Column(name="left_title", type="string", length=255 , nullable=true)
     */
    private $lTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="left_content", type="text" , nullable=true)
     */
    private $lContent;

    /**
     * @var string
     *
     * @ORM\Column(name="right_title", type="string", length=255 , nullable=true)
     */
    private $rTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="right_content", type="text" , nullable=true)
     */
    private $rContent;

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
     * Set subject
     *
     * @param string $subject
     * @return Smalltext
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Smalltext
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return Smalltext
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return Smalltext
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @return Smalltext
     * @param mixed $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @return Smalltext
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
     * @return Smalltext
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
     * @return Smalltext
     * @param mixed $layoutId
     */
    public function setLayoutId($layoutId)
    {
        $this->layoutId = $layoutId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLContent()
    {
        return $this->lContent;
    }

    /**
     * @return Smalltext
     * @param string $lContent
     */
    public function setLContent($lContent)
    {
        $this->lContent = $lContent;
        return $this;
    }

    /**
     * @return string
     */
    public function getLTitle()
    {
        return $this->lTitle;
    }

    /**
     * @return Smalltext
     * @param string $lTitle
     */
    public function setLTitle($lTitle)
    {
        $this->lTitle = $lTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getRContent()
    {
        return $this->rContent;
    }

    /**
     * @return Smalltext
     * @param string $rContent
     */
    public function setRContent($rContent)
    {
        $this->rContent = $rContent;
        return $this;
    }

    /**
     * @return string
     */
    public function getRTitle()
    {
        return $this->rTitle;
    }

    /**
     * @return Smalltext
     * @param string $rTitle
     */
    public function setRTitle($rTitle)
    {
        $this->rTitle = $rTitle;
        return $this;
    }
}
