<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * Formateur
 *
 * @ORM\Entity
 */
class Formateur
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;





    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }









    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }



    /**
     *@ORM\Column(name="img", type="string",length=255,nullable=true)
     */
    public $img;
    /**
     *@ORM\Column(name="nomImage", type="string",length=255,nullable=true)
     */
    public $nomImage;
    /**
     * @Assert\File(maxSize="500K")
     */
    public $file;
    /**
     * @return int
     */


    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }
    /////les methodes de l'image
    public function getWebPath(){
        return null===$this->nomImage ? null : $this->getUploadDir().'/'.$this->nomImage;
    }
    protected function getUploadRootDir(){
        return __DIR__ . '/../../../web/' .$this->getUploadDir();
    }
    protected function getUploadDir(){
        return 'imagesFormation';
    }
    public function uploadProfilePicture(){
        if (null === $this->file) {
            return ;
        }
        else{

            $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
            $this->nomImage=$this->file->getClientOriginalName();
            $this->file=null;
        }

    }
    ////

    /**
     * Set nomImage
     *
     * @param string $nomImage
     *
     * @return Categorie
     */
    public function setNomImage($nomImage){
        $this->nomImage==$nomImage;
        return $this;
    }

    /**
     * @param string $nomImage
     */
    public function setNomImg($nomImage)
    {
        $this->nomImage = $nomImage;
    }


    /**
     * Get nomImage
     *
     * @return string
     */
    public function getNomImage(){
        return $this->nomImage;
    }







}

