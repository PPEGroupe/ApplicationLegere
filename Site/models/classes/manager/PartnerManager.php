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
        $queryString = 'INSERT INTO Partner (URL, Email, Password) VALUES '
                     . '(:URL, :Email, :Password)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',       $partner->URL());
        $query->bindValue(':Email',     $partner->Email());
        $query->bindValue(':Password',  $partner->Password());

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
                     . 'URL = :URL, '
                     . 'Email = :Email, '
                     . 'Password = :Password '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',        $partner->URL());
        $query->bindValue(':Email',      $partner->Email());
        $query->bindValue(':Password',   $partner->Password());
        $query->bindValue(':Identifier', $partner->Identifier());

        $query->execute();
    }
    
    public function UpdatePassword(Partner $partner)
    {
        $queryString = 'UPDATE Partner SET '
                     . 'Password = :Password '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $partner->Identifier());
        $query->bindValue(':Password',   $partner->Password());
        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, URL, Email, Password '
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
        $queryString = 'SELECT Identifier, URL, Email, Password '
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
    
    public function GetAccount($email, $password)
    {
        $queryString = 'SELECT Identifier, URL, Email, Password '
                     . 'FROM Partner '
                     . 'WHERE Email = :Email '
                     . 'AND Password = :Password';
        
        $query = $this->_db->prepare($queryString);
        
        $query->bindValue(':Email',     $email);
        $query->bindValue(':Password',  $password);
        
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
}
