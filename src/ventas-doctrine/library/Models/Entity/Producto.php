<?php

namespace Models\Entity;

/**
 * @Entity(repositoryClass="Models\Entity\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var integer
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Fabricante", inversedBy="Productos")
     *
     */
    private $Fabricante;

    /**
     * @Column(type="string", length=50)
     * @var string
     */
    protected $name;
    
    /**
     * Get id
     *
     * @return bigint $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    
    public function getFabricante()
    {
        return $this->Fabricante;

    }

    public function setFabricante($Fabricante)
    {
        $this->Fabricante = $Fabricante;

    }



}
