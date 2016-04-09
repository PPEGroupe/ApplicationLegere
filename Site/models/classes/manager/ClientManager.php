<?php
class ClientManager {
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
    public function Add(Client $client)
    {
        $queryString = 'INSERT INTO Client (URL, PhoneNumber, Fax, Address, City ,ZipCode, Company, DateRegister, IsValid, IdAccount) VALUES '
                     . '(:URL, :PhoneNumber, :Fax, :Address, :City, :ZipCode, :Company, :DateRegister, :IsValid, :IdAccount)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',           $client->URL());
        $query->bindValue(':PhoneNumber',   $client->PhoneNumber());
        $query->bindValue(':Fax',           $client->Fax());
        $query->bindValue(':Address',       $client->Address());
        $query->bindValue(':City',          $client->City());
        $query->bindValue(':ZipCode',       $client->ZipCode());
        $query->bindValue(':Company',       $client->Company());
        $query->bindValue(':DateRegister',  $client->DateRegister());
        $query->bindValue(':IsValid',       $client->IsValid());
        $query->bindValue(':IdAccount',     $client->IdAccount());

        $query->execute();
    }

    public function Remove($identifier)
    {
        $query = $this->_db->prepare('DELETE FROM Client WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $identifier);

        $query->execute();
    }

    public function Update(Client $client)
    {
        $queryString = 'UPDATE Client SET '
                     . 'URL = :URL, '
                     . 'PhoneNumber = :PhoneNumber, '
                     . 'Fax = :Fax, '
                     . 'Address = :Address, '
                     . 'City = :City, '
                     . 'ZipCode = :ZipCode, '
                     . 'Company = :Company, '
                     . 'DateRegister = :DateRegister, '
                     . 'IsValid = :IsValid, '
                     . 'IdAccount = :IdAccount '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',           $client->URL());
        $query->bindValue(':PhoneNumber',   $client->PhoneNumber());
        $query->bindValue(':Fax',           $client->Fax());
        $query->bindValue(':Address',       $client->Address());
        $query->bindValue(':City',          $client->City());
        $query->bindValue(':ZipCode',       $client->ZipCode());
        $query->bindValue(':Company',       $client->Company());
        $query->bindValue(':DateRegister',  $client->DateRegister());
        $query->bindValue(':IsValid',       $client->IsValid());
        $query->bindValue(':IdAccount',     $client->IdAccount());
        $query->bindValue(':Identifier',    $client->Identifier());

        $query->execute();
    }

    public function Get($identifier)
    {
        $queryString = 'SELECT Identifier, URL, PhoneNumber, Fax, Address, City ,ZipCode, Company, DateRegister, IsValid, IdAccount '
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
        // lazy loading / lazy load
        // injection de dépendance // container 
        $queryString = 'SELECT Identifier, URL, PhoneNumber, Fax, Address, City ,ZipCode, Company, DateRegister, IsValid, IdAccount '
                     . 'FROM Client';
        
        $query = $this->_db->query($queryString);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $client = new Client();
            $client->Initialize($data);
            $clientList[] = $client;
        }

        return (isset($clientList)) ? $clientList : null;
    }
    
    public function GetByAccount($idAccount)
    {
        $queryString = 'SELECT Identifier, URL, PhoneNumber, Fax, Address, City ,ZipCode, Company, DateRegister, IsValid, IdAccount '
                     . 'FROM Client '
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
    
    public function CompanyExists($company)
    {
        $queryString = 'SELECT Identifier '
                     . 'FROM Client '
                     . 'WHERE Company = :Company';
        
        $query = $this->_db->prepare($queryString);
        
        $query->bindValue(':Company', $company);
        
        $query->execute();
        
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($data != null) 
        {
            return true;
        }
        return false;
    }
}
