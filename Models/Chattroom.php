<?php namespace App\Models;

use App\Db\TBdd;
use PDO;
use PDOException;

class Chattroom extends TBdd
{
    private $id_mur;
    private $message;
    private $nom;
    private $datte;

    /**
     * Get the value of id_mur
     */ 
    public function getId_mur()
    {
        return $this->id_mur;
    }

    /**
     * Set the value of id_mur
     *
     * @return  self
     */ 
    public function setId_mur($id_mur)
    {
        $this->id_mur = $id_mur;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of datte
     */ 
    public function getDatte()
    {
        return $this->datte;
    }

    /**
     * Set the value of datte
     *
     * @return  self
     */ 
    public function setDatte($datte)
    {
        $this->datte = $datte;

        return $this;
    }

    public function selectMessage()
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                SELECT * FROM mur order by id_mur desc LIMIT 10");
                if ($MyReq->execute())
                {
                    $MyArray = $MyReq->fetchAll();
                    return $MyArray;
                } else
                {
                    print'On a un pb' . PHP_EOL;
                    return false;
                }
            }catch (PDOException $e)
            {
                return false;
            }
        }
    }

    public function insetMessage($message,$nom)
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                INSERT INTO mur (message,nom) VALUES (:message,:nom) ");
                $MyReq->bindValue(':message', $message, PDO::PARAM_STR);
                $MyReq->bindValue(':nom', $nom, PDO::PARAM_STR);

                if ($MyReq->execute())
                {
                    $MyArray = $MyReq->fetchAll();
                    return $MyArray;
                } else
                {
                    print'On a un pb' . PHP_EOL;
                    return false;
                }
            }catch (PDOException $e)
            {
                return false;
            }
        }
    }
}

?>