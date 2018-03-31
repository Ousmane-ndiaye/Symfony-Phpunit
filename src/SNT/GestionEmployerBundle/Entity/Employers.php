<?php

namespace SNT\GestionEmployerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employers
 *
 * @ORM\Table(name="Employers", indexes={@ORM\Index(name="idService", columns={"idService"})})
 * @ORM\Entity
 */
class Employers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEmployer", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idemployer;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=30, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="nomComplet", type="string", length=50, nullable=false)
     */
    private $nomcomplet;

    /**
     * @var string
     *
     * @ORM\Column(name="birthDay", type="string", length=10, nullable=false)
     */
    private $birthday;

    /**
     * @var \SNT\GestionEmployerBundle\Entity\Service
     *
     * @ORM\ManyToOne(targetEntity="SNT\GestionEmployerBundle\Entity\Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idService", referencedColumnName="idService")
     * })
     */
    private $idservice;



    /**
     * Get idemployer
     *
     * @return integer
     */
    public function getIdemployer()
    {
        return $this->idemployer;
    }

    /**
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Employers
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set nomcomplet
     *
     * @param string $nomcomplet
     *
     * @return Employers
     */
    public function setNomcomplet($nomcomplet)
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    /**
     * Get nomcomplet
     *
     * @return string
     */
    public function getNomcomplet()
    {
        return $this->nomcomplet;
    }

    /**
     * Set birthday
     *
     * @param string $birthday
     *
     * @return Employers
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set idservice
     *
     * @param \SNT\GestionEmployerBundle\Entity\Service $idservice
     *
     * @return Employers
     */
    public function setIdservice(\SNT\GestionEmployerBundle\Entity\Service $idservice = null)
    {
        $this->idservice = $idservice;

        return $this;
    }

    /**
     * Get idservice
     *
     * @return \SNT\GestionEmployerBundle\Entity\Service
     */
    public function getIdservice()
    {
        return $this->idservice;
    }
}
