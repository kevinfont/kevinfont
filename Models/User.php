<?php namespace App\Models;

use App\Db\TBdd;
use PDO;
use PDOException;

class User extends TBdd
{
    private $id_user;
    private $nom;
    private $genre;
    private $statut;
    private $email;
    private $password;
    private $role;

    // public function __construct(int $id_user)
    // {
    //     $this->id_user = $id_user;
    // }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

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
     * Get the value of genre
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function formInscription($nom,$genre,$email,$password)
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                INSERT INTO user (nom,genre,email,password) VALUES (:nom,:genre,:email,:password)");
                $MyReq->bindValue(':nom', $this->nom, PDO::PARAM_STR);
                $MyReq->bindValue(':genre', $this->genre, PDO::PARAM_STR);
                $MyReq->bindValue(':email', $this->email, PDO::PARAM_STR);
                $MyReq->bindValue(':password', $this->password, PDO::PARAM_STR);

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

    public function verifEmail($email)
    {
        if($this->Database != null){
            $MyReq = $this->Database->prepare('SELECT * FROM user WHERE email = :email');
            $MyReq->bindValue(':email', $email, PDO::PARAM_STR);

            if ($MyReq->execute())
            {
                $MyReq->rowCount();
                $MyArray = $MyReq->fetch();
                return $MyArray;
            }
        }
    }

    public function updateStatut($id_user)
    {
        if($this->Database != null){
            $MyReq = $this->Database->prepare('UPDATE user SET statut = "1" WHERE (id_user = :id_user)');
            $MyReq->bindValue(':id_user', $id_user, PDO::PARAM_STR);

            if ($MyReq->execute())
            {
    
                $MyArray = $MyReq->fetch();
                return $MyArray;
            }
        }
    }

    public function deco($id_user)
    {
        if($this->Database != null){
            $MyReq = $this->Database->prepare('UPDATE user SET statut = "0" WHERE (id_user = :id_user)');
            $MyReq->bindValue(':id_user', $id_user, PDO::PARAM_STR);

            if ($MyReq->execute())
            {
    
                $MyArray = $MyReq->fetch();
                return $MyArray;
            }
        }
    }

    public function selectMessage()
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                SELECT * FROM mur order by id_mur desc LIMIT 5");
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

    public function listeConnecter()
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                SELECT nom,genre FROM user where statut = '1'");
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