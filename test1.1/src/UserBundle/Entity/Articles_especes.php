<?php

namespace UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;


/**
 * @ORM\Entity
 * @Vich\Uploadable
 */

class Articles_especes

{/**
 * Articles_especes
 *
 * @ORM\Table(name="Articles_especes")
 * @ORM\Entity(repositoryClass="UserBundle/Form/Articles_especesType.php")
 */
    /**
     * @return mixed
     */
    public function getEspeces()
    {
        return $this->Especes;
    }

    /**
     * @param mixed $Especes
     */
    public function setEspeces($Especes)
    {
        $this->Especes = $Especes;
    }
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="User_id",referencedColumnName="id")
    */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Espece")
     * @ORM\JoinColumn(name="Especes_id",referencedColumnName="id")
     */
    private $Especes;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="IdArticle", type="integer")
     */
    private $idArticle;

    /**
     * @var date
     *
     * @ORM\Column(name="datepub", type="date")
     */
    private $datepub;

    /**
     * @var int
     *
     * @ORM\Column(name="idEspeces", type="integer")
     */
    private $idEspeces;

    /**
     * @return date
     */
    public function getDatePub()
    {
        return $this->datepub;
    }

    /**
     * @return int
     */



    /**
     * @param date $datepub
     */
    public function setDatePub($datepub)
    {
        $this->datepub = $datepub;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="numlike", type="integer")
     */
    private $numlike;

    /**
     * @return int
     */
    public function getNumlike()
    {
        return $this->numlike;
    }

    /**
     * @param int $numlike
     */
    public function setNumlike($numlike)
    {
        $this->numlike = $numlike;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="idCat", type="integer")
     */
    private $idCat;

    /**
     * @var string
     * @Assert\NotBlank(message="vous dever entrez un titre")
     * @ORM\Column(name="Titre", type="string", length=255)
     * @Assert\Regex(pattern="/[A-Za-z]$/", message="saisie une chaine de charactere")


     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="string", length=1000)
     */
    private $contenu;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idArticle
     *
     * @param integer $idArticle
     *
     * @return Articles_especes
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Get idArticle
     *
     * @return int
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set idEspeces
     *
     * @param integer $idEspeces
     *
     * @return Articles_especes
     */
    public function setIdEspeces($idEspeces)
    {
        $this->idEspeces = $idEspeces;

        return $this;
    }
    /**
     * @ORM\Column(name="image", type="string")
     *  @var string
     */
    private $image;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @Vich\UploadableField(mapping="Articles_especes", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
    /**
     * Get idEspeces
     *
     * @return int
     */
    public function getIdEspeces()
    {
        return $this->idEspeces;
    }

    /**
     * Set idCat
     *
     * @param integer $idCat
     *
     * @return Articles_especes
     */
    public function setIdCat($idCat)
    {
        $this->idCat = $idCat;

        return $this;
    }

    /**
     * Get idCat
     *
     * @return int
     */
    public function getIdCat()
    {
        return $this->idCat;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Articles_especes
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Articles_especes
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

}

