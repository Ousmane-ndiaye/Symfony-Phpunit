<?php

namespace SNT\GestionEmployerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="Service")
 * @ORM\Entity
 */
class Service
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idService", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idservice;

    /**
     * @var string
     *
     * @ORM\Column(name="nomService", type="string", length=50, nullable=false)
     */
    private $nomservice;



    /**
     * Get idservice
     *
     * @return integer
     */
    public function getIdservice()
    {
        return $this->idservice;
    }

    /**
     * Set nomservice
     *
     * @param string $nomservice
     *
     * @return Service
     */
    public function setNomservice($nomservice)
    {
        $this->nomservice = $nomservice;

        return $this;
    }

    /**
     * Get nomservice
     *
     * @return string
     */
    public function getNomservice()
    {
        return $this->nomservice;
    }

    public  function __toString(){
        return $this->nomservice;
    }
}
