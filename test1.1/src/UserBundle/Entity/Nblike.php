<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nblike
 *
 * @ORM\Table(name="nblike")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\NblikeRepository")
 */

class Nblike
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")})
     */
    private $user;
    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Articles_especes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article", referencedColumnName="id")})
     *
     */
    private $article;

    /**
     * @return mixed
     */
    public function getLikesnumber()
    {
        return $this->Likesnumber;
    }

    /**
     * @param mixed $Likesnumber
     */
    public function setLikesnumber($Likesnumber)
    {
        $this->Likesnumber = $Likesnumber;
    }
    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Articles_especes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Likesnumber", referencedColumnName="id")})
     *
     */
    private $Likesnumber;
    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Commentaire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commentaire", referencedColumnName="id")})
     *
     */
    private $commentaire;

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
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }
}



