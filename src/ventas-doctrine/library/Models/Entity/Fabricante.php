<?php

namespace Models\Entity;

/**
 * @Entity(repositoryClass="Models\Entity\Repository\FabricanteRepository")
 */
class Fabricante
{
    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var integer
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Categoria", inversedBy="Fabricantes")
     *
     */
    private $Categoria;

    /**
     * @OneToMany(targetEntity="Producto", mappedBy="Fabricante")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $Productos;


    /**
     * @Column(type="string", length=250)
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


    /**
     *
     * @return Models\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->Categoria;

    }

    /**
     *
     * @param Models\Entity\Categoria $categoria
     */
    public function setCategoria($Categoria)
    {
        $this->Categoria = $Categoria;

    }


    public function getProductos()
    {
        return $this->Productos;

    }

    public function setProductos($Productos)
    {
        $this->Productos = $Productos;

    }






}
