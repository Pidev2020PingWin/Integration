<?php


namespace UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */



class Produit
{

    /**
     *@ORM\Column(type ="integer")
     *@ORM\Id
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type ="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type ="float")
     */
    private $prix;

    /**
     * @ORM\Column(type ="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     */
    private $categorie;
    /**
     * @ORM\Column(type ="string", length=255)
     */

    public $nomImage;
    /**
     * @Assert\File(maxSize="500K")
     */
    public $file;


    public function getWebPath()
    {
        return null === $this->nomImage ? null : $this->getUploadDir() . '/' . $this->nomImage;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'imageProduits';
    }


    public function uploadProfilePicture()
    {

if ($this->getFile())
        {
            $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
            $this->nomImage = $this->file->getClientOriginalName();
            $this->file = null;

    }
}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * @param mixed $nomImage
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


    /**
     * @ORM\Column(type ="integer")
     */
    private $quantite;

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @ORM\Column(type ="float")
     */
    private $rating;

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @ORM\Column(type ="integer")
     */
    private $nbrrating;

    /**
     * @return mixed
     */
    public function getNbrrating()
    {
        return $this->nbrrating;
    }

    /**
     * @param mixed $nbrrating
     */
    public function setNbrrating($nbrrating)
    {
        $this->nbrrating = $nbrrating;
    }

    /**
     * @ORM\Column(type ="integer")
     */
    private $sommerating;

    /**
     * @return mixed
     */
    public function getSommerating()
    {
        return $this->sommerating;
    }

    /**
     * @param mixed $sommerating
     */
    public function setSommerating($sommerating)
    {
        $this->sommerating = $sommerating;
    }





}