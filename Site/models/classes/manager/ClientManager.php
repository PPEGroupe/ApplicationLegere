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
        $queryString = 'INSERT INTO Client (URL, Email, PhoneNumber, Fax, Address, ZipCode, Company) VALUES '
                     . '(:URL, :Email, :PhoneNumber, :Fax, :Address, :ZipCode, :Company)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',           $client->URL());
        $query->bindValue(':Email',         $client->Email());
        $query->bindValue(':PhoneNumber',   $client->PhoneNumber());
        $query->bindValue(':Fax',           $client->Fax());
        $query->bindValue(':Address',       $client->Address());
        $query->bindValue(':Address',       $client->Address());
        $query->bindValue(':Company',       $client->Company());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM Client WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(Client $client)
    {
        $queryString = 'UPDATE Client SET '
                     . 'URL = :URL, '
                     . 'Email = :Email, '
                     . 'PhoneNumber = :PhoneNumber, '
                     . 'Fax = :Fax, '
                     . 'Address = :Address, '
                     . 'ZipCode = :ZipCode, '
                     . 'Company = :Company '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':URL',           $client->URL());
        $query->bindValue(':Email',         $client->Email());
        $query->bindValue(':PhoneNumber',   $client->PhoneNumber());
        $query->bindValue(':Fax',           $client->Fax());
        $query->bindValue(':Address',       $client->Address());
        $query->bindValue(':Address',       $client->Address());
        $query->bindValue(':Company',       $client->Company());
        $query->bindValue(':Identifier',    $client->Identifier());

        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, URL, Email, PhoneNumber, Fax, Address, ZipCode, Company '
                     . 'FROM Client '
                     . 'WHERE Identifier = :Identifier';
        
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
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
        $queryString = 'SELECT Identifier, URL, Email, PhoneNumber, Fax, Address, ZipCode, Company '
                     . 'FROM Client';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $client = new Client();
            $client->Initialize($data);
            $clientList[] = $client;
        }

        return (isset($clientList)) ? $clientList : null;
    }
}