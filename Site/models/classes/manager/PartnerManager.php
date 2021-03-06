<?php
class PartnerManager {
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
    public function Add(Partner $partner)
    {
        $queryString = 'INSERT INTO Partner (URL, IdAccount) VALUES '
                     . '(:URL,:IdAccount)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',          $partner->URL());
        $query->bindValue(':IdAccount',    $partner->IdAccount());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM Partner WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(Partner $partner)
    {
        $queryString = 'UPDATE Partner SET '
                     . 'URL = :URL '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',          $partner->URL());
        $query->bindValue(':Identifier',   $partner->Identifier());

        $query->execute();
    }

    public function Get($identifier)
    {
        $queryString = 'SELECT Identifier, URL, DateRegister, IsValid, IdAccount '
                     . 'FROM Partner '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $partner = new Partner();
            $partner->Initialize($data);
            return $partner;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, URL, DateRegister, IsValid, IdAccount '
                     . 'FROM Partner';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $partner = new Partner();
            $partner->Initialize($data);
            $partnerList[] = $partner;
        }
        
        return (isset($partnerList)) ? $partnerList : null;
    }
    
    public function GetByAccount($idAccount)
    {
        $queryString = 'SELECT Identifier, URL, DateRegister, IsValid, IdAccount '
                     . 'FROM Partner '
                     . 'WHERE IdAccount = :IdAccount';
        
        $query = $this->_db->prepare($queryString);
        
        $query->bindValue(':IdAccount', $idAccount);
        
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
    
    public function UrlExists($url)
    {
        $queryString = 'SELECT Identifier '
                     . 'FROM Partner '
                     . 'WHERE URL = :Url';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Url', $url);
        
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($data != null) 
        {
            return true;
        }
        return false;
    }
    
    public function AccountLinked($idAccount)
    {
        $queryString = 'SELECT Partner.Identifier '
                     . 'FROM Partner '
                     . 'INNER JOIN Account ON Account.Identifier = Partner.IdAccount '
                     . 'WHERE Account.Identifier = :IdAccount';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdAccount', $idAccount);
        
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($data != null) 
        {
            return true;
        }
        return false;
    }
}
