<?php namespace App\Models;

use App\Db\TBdd;
use PDO;
use PDOException;

class Prophil extends TBdd
{
    public function selectProphil($id_user)
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                SELECT * FROM user where id_user = :id_user");
                $MyReq->bindValue(':id_user', $id_user, PDO::PARAM_STR);

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

    public function maj($id_user,$nom,$genre,$email,$password)
    {
        if ($this->Database != null)
        {
            try
            {
                $MyReq   = $this->Database->prepare("
                UPDATE user
                SET nom = :nom, 
                    genre = :genre, 
                    email = :email,  
                    password = :password 
                WHERE (id_user = :id_user)
                ");
                $MyReq->bindValue(':id_user', $id_user, PDO::PARAM_STR);
                $MyReq->bindValue(':nom', $nom, PDO::PARAM_STR);
                $MyReq->bindValue(':genre', $genre, PDO::PARAM_STR);
                $MyReq->bindValue(':email', $email, PDO::PARAM_STR);
                $MyReq->bindValue(':password', $password, PDO::PARAM_STR);            

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

    public function delete($id_user)
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
}
?>