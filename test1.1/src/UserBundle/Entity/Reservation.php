<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="reservation_ibfk_1", columns={"idu"}), @ORM\Index(name="reservation_ibfk_2", columns={"idformation"})})
 *@ORM\MappedSuperclass
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idr;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="avis", type="string", length=255, nullable=false)
     */
    private $avis;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idu", referencedColumnName="id")
     * })
     */
    private $idu;

    /**
     * @var \Formation
     *
     * @ORM\ManyToOne(targetEntity="Formation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idformation", referencedColumnName="id")
     * })
     */
    private $idformation;

    /**
     * @return int
     */
    public function getIdr()
    {
        return $this->idr;
    }

    /**
     * @param int $idr
     */
    public function setIdr($idr)
    {
        $this->idr = $idr;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * @param string $avis
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;
    }

    /**
     * @return \User
     */
    public function getIdu()
    {
        return $this->idu;
    }

    /**
     * @param \User $idu
     */
    public function setIdu($idu)
    {
        $this->idu = $idu;
    }

    /**
     * @return \Formation
     */
    public function getIdformation()
    {
        return $this->idformation;
    }

    /**
     * @param \Formation $idformation
     */
    public function setIdformation($idformation)
    {
        $this->idformation = $idformation;
    }


}

