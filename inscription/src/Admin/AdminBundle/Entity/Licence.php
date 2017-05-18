<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Licence
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Entity\LicenceRepository")
 */
class Licence
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
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionComplete", type="string", length=255)
     */
    private $descriptionComplete;

    /**
     * @var string
     *
     * @ORM\Column(name="description1", type="string", length=255)
     */
    private $description1;

    /**
     * @var string
     *
     * @ORM\Column(name="description2", type="string", length=255)
     */
    private $description2;

    /**
     * @var string
     *
     * @ORM\Column(name="description3", type="string", length=255)
     */
    private $description3;


    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reduction", type="boolean")
     */
    private $reduction;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible;


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
     * Set intitule
     *
     * @param string $intitule
     * @return Licence
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set descriptionComplete
     *
     * @param string $descriptionComplete
     * @return Licence
     */
    public function setDescriptionComplete($descriptionComplete)
    {
        $this->descriptionComplete = $descriptionComplete;

        return $this;
    }

    /**
     * Get descriptionComplete
     *
     * @return string 
     */
    public function getDescriptionComplete()
    {
        return $this->descriptionComplete;
    }

    /**
     * Set description1
     *
     * @param string $description1
     * @return Licence
     */
    public function setDescription1($description1)
    {
        $this->description1 = $description1;

        return $this;
    }

    /**
     * Get description1
     *
     * @return string 
     */
    public function getDescription1()
    {
        return $this->description1;
    }

    /**
     * Set description2
     *
     * @param string $description2
     * @return Licence
     */
    public function setDescription2($description2)
    {
        $this->description2 = $description2;

        return $this;
    }

    /**
     * Get description2
     *
     * @return string 
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * Set description3
     *
     * @param string $description3
     * @return Licence
     */
    public function setDescription3($description3)
    {
        $this->description3 = $description3;

        return $this;
    }

    /**
     * Get description3
     *
     * @return string 
     */
    public function getDescription3()
    {
        return $this->description3;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return Licence
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Licence
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set reduction
     *
     * @param boolean $reduction
     * @return Licence
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;

        return $this;
    }

    /**
     * Get reduction
     *
     * @return boolean 
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Licence
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }
}
