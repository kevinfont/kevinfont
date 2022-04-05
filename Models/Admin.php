<?php namespace App\Models;

use App\Db\TBdd;
use PDO;
use PDOException;

class admin extends TBdd
{
    public function selectadmin()
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                SELECT * FROM user ");

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

    public function upAdmin($id_user,$nom,$genre,$statut,$email,$password,$role)
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                UPDATE user
                SET nom = :nom, 
                    genre = :genre, 
                    statut = :statut, 
                    email = :email,  
                    password = :password, 
                    role = :role 
                WHERE (id_user = :id_user)
                ");
                $MyReq->bindValue(':id_user', $id_user, PDO::PARAM_STR);
                $MyReq->bindValue(':nom', $nom, PDO::PARAM_STR);
                $MyReq->bindValue(':genre', $genre, PDO::PARAM_STR);
                $MyReq->bindValue(':statut', $statut, PDO::PARAM_STR);
                $MyReq->bindValue(':email', $email, PDO::PARAM_STR);
                $MyReq->bindValue(':password', $password, PDO::PARAM_STR);            
                $MyReq->bindValue(':role', $role, PDO::PARAM_STR);            

                try {
                    $MyReq->execute();
                } catch (PDOException $err){
                    print_r($err->getMessage());
                }

            }catch (PDOException $e)
            {
                return false;
            }
        }
    }

    public function deleteA($id_user)
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                delete FROM user where id_user = :id_user");
                $MyReq->bindValue(':id_user', $id_user, PDO::PARAM_STR);
                // $MyReq->execute();

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

    public function message()
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                SELECT * FROM mur ");
                // $MyReq->execute();

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

    public function deletMessage($id_mur)
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                DELETE FROM mur WHERE (id_mur = :id_mur);");
                $MyReq->bindValue(':id_mur', $id_mur, PDO::PARAM_STR);

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