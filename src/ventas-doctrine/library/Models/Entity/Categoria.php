<?php

namespace Models\Entity;

/**
 * @Entity(repositoryClass="Models\Entity\Repository\CategoriaRepository")
 */
class Categoria
{
    /**
     * @Id @GeneratedValue
     * @Column(type="bigint")
     * @var integer
     */
    protected $id;

    /**
     * @Column(type="string", length=250)
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", length=250)
     * @var string
     */
    protected $slug;


    /**
     * @OneToMany(targetEntity="Fabricante", mappedBy="Categoria")
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $Fabricantes;

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



    public function getFabricantes()
    {
        return $this->Fabricantes;

    }

    public function setFabricantes($Fabricantes)
    {
        $this->Fabricantes = $Fabricantes;

    }




}
