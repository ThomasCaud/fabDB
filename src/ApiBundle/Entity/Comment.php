<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     * @Groups({"marketplace"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Groups({"marketplace"})
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var string|null
     * @Groups({"marketplace"})
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var \DateTime
     * @Groups({"marketplace"})
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @Groups({"marketplace"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User")
     * @ORM\JoinColumn(name="writer_id", referencedColumnName="id", nullable=false)
     */
    private $writer;

    /**
     * @Groups({"marketplace"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    private $product;

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
     * Set note.
     *
     * @param int $note
     *
     * @return Comment
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return Comment
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set writer.
     *
     * @param \ApiBundle\Entity\User|null $writer
     *
     * @return Comment
     */
    public function setWriter(\ApiBundle\Entity\User $writer = null)
    {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Get writer.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Set product.
     *
     * @param \ApiBundle\Entity\Product|null $product
     *
     * @return Comment
     */
    public function setProduct(\ApiBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \ApiBundle\Entity\Product|null
     */
    public function getProduct()
    {
        return $this->product;
    }
}
