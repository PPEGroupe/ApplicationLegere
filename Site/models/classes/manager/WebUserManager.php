<?php
class WebUserManager {
    // Attributs
    private $_db;

    // Constructeur
    public function __construct($db)
    {
        $this->setDb($db);
    }

    // Propriétés
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    // Méthodes	
    public function Add($idAccount)
    {
        $queryString = 'INSERT INTO WebUser (IdAccount) VALUES '
                     . '(:IdAccount)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdAccount', $idAccount);

        $query->execute();
    }

    public function Remove($identifier)
    {
        $query = $this->_db->prepare('DELETE FROM WebUser WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $identifier);

        $query->execute();
    }

    public function Update(WebUser $webUser)
    {
        $queryString = 'UPDATE WebUser SET '
                     . 'Firstname = :Firstname, '
                     . 'Lastname = :Lastname, '
                     . 'PhoneNumber = :PhoneNumber, '
                     . 'Address = :Address, '
                     . 'City = :City, '
                     . 'ZipCode = :ZipCode, '
                     . 'DateRegister = :DateRegister, '
                     . 'IdAccount = :IdAccount '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Firstname',    $webUser->Firstname());
        $query->bindValue(':Lastname',     $webUser->Lastname());
        $query->bindValue(':PhoneNumber',  $webUser->PhoneNumber());
        $query->bindValue(':Address',      $webUser->Address());
        $query->bindValue(':City',         $webUser->City());
        $query->bindValue(':ZipCode',      $webUser->ZipCode());
        $query->bindValue(':DateRegister', $webUser->DateRegister());
        $query->bindValue(':IdAccount',    $webUser->IdAccount());
        $query->bindValue(':Identifier',   $webUser->Identifier());

        $query->execute();
    }

    public function Get($identifier)
    {
        $queryString = 'SELECT Identifier, Firstname, Lastname, PhoneNumber, Address, City, ZipCode, DateRegister, IdAccount '
                     . 'FROM Client '
                     . 'WHERE Identifier = :Identifier';
        
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $identifier);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $client = new Client();
            $client->Initialize($data);
            return $client;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Firstname, Lastname, PhoneNumber, Address, City, ZipCode, DateRegister, IdAccount '
                     . 'FROM WebUser';
        
        $query = $this->_db->query($queryString);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $webUser = new WebUser();
            $webUser->Initialize($data);
            $webUserList[] = $webUser;
        }

        return (isset($webUserList)) ? $webUserList : null;
    }
    
    public function GetByAccount($idAccount)
    {
        $queryString = 'SELECT Identifier, Firstname, Lastname, PhoneNumber, Address, City, ZipCode, DateRegister, IdAccount '
                     . 'FROM WebUser '
                     . 'WHERE IdAccount = :IdAccount';
        
        $query = $this->_db->prepare($queryString);
        
        $query->bindValue(':IdAccount', $idAccount);
        
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($data != null) 
        {
            $webUser = new WebUser();
            $webUser->Initialize($data);
            return $webUser;
        }
        else
        {
            return null;
        }
    }
}
