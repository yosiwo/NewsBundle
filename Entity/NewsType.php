<?php

namespace Lowtech\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Lowtech\NewsBundle\Entity\NewsTypeRepository")
 */
class NewsType
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
     * @ORM\ManyToOne(targetEntity="NewsType", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setParent(NewsType $parent = null)
    {   
        $this->parent = $parent;
    }   

    public function getParent()
    {   
        return $this->parent;
    }  

    /**
     * Set name
     *
     * @param string $name
     * @return NewsType
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

    public function __toString()
    {
        return (string)$this->getName();
    }

}
