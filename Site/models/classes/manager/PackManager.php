<?php
class PackManager {
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
    public function Add(Pack $pack)
    {
        $queryString = 'INSERT INTO Pack (Price, NumberDays, NumberOffers) VALUES '
                     . '(:Label, :IdPackDomain)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Price',        $pack->Price());
        $query->bindValue(':NumberDays',   $pack->NumberDays());
        $query->bindValue(':NumberOffers', $pack->NumberOffers());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM Pack WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(Pack $pack)
    {
        $queryString = 'UPDATE Pack SET '
                     . 'Price = :Price, '
                     . 'NumberDays = :NumberDays, '
                     . 'NumberOffers = :NumberOffers '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Price',        $pack->Price());
        $query->bindValue(':NumberDays',   $pack->NumberDays());
        $query->bindValue(':NumberOffers', $pack->NumberOffers());
        $query->bindValue(':Identifier',   $pack->Identifier());

        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, Price, NumberDays, NumberOffers '
                     . 'FROM Pack '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $pack = new Pack();
            $pack->Initialize($data);
            $pack->setObjects($this->_db);
            return $pack;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Price, NumberDays, NumberOffers '
                     . 'FROM Pack';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $pack = new Pack();
            $pack->Initialize($data);
            $pack->setObjects($this->_db);
            $packList[] = $pack;
        }

        return (isset($packList)) ? $packList : null;
    }
}
