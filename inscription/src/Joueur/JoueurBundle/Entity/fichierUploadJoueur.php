<?php

namespace Joueur\JoueurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * fichierUploadJoueur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Joueur\JoueurBundle\Entity\fichierUploadJoueurRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table()
 */
class fichierUploadJoueur
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="IdJoueur", type="integer")
     */
    private $IdJoueur;

    /**
     * Set IdJoueur
     *
     * @param integer $prIdJoueurix
     * @return fichierUploadJoueur
     */
    public function setIdJoueur($IdJoueur)
    {
        $this->IdJoueur = $IdJoueur;

        return $this;
    }

    /**
     * Get IdJoueur
     *
     * @return integer 
     */
    public function getIdJoueur()
    {
        return $this->IdJoueur;
    }

    /**
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     */    
    private $date;
    
    /**
     * Set date
     *
     * @param \DateTime $date
     * @return fichierUpload
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/uploads/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'fichiersJoueur';
    }
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
  

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

     private $temp;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    public function verifExtension(){
        if (null !== $this->getFile()) {
            $extension = $this->getFile()->guessExtension();
            if ($extension == 'pdf' || $extension == 'jpeg' || $extension == 'jpg' || $extension == 'png')
            {
                return 1;
            }
            else{
                return 0;
            }
            
        }
        else{
            return 0;
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

}
