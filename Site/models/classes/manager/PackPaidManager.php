<?php
class PackPaidManager {
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
    public function Add(PackPaid $packPaid)
    {
        $queryString = 'INSERT INTO PackPaid (Price, NumberDays, NumberOffers, DatePaiment, IdClient, IdPack) VALUES '
                     . '(:Label, :IdPackPaidDomain)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Price',        $packPaid->Price());
        $query->bindValue(':NumberDays',   $packPaid->NumberDays());
        $query->bindValue(':NumberOffers', $packPaid->NumberOffers());
        $query->bindValue(':DatePaiment',  $packPaid->DatePaiment());
        $query->bindValue(':IdClient',     $packPaid->IdClient());
        $query->bindValue(':IdPack',       $packPaid->IdPack());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM PackPaid WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(PackPaid $packPaid)
    {
        $queryString = 'UPDATE PackPaid SET '
                     . 'Price = :Price, '
                     . 'NumberDays = :NumberDays, '
                     . 'NumberOffers = :NumberOffers, '
                     . 'DatePaiment = :DatePaiment, '
                     . 'IdClient = :IdClient, '
                     . 'IdPack = :IdPack '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Price',        $packPaid->Price());
        $query->bindValue(':NumberDays',   $packPaid->NumberDays());
        $query->bindValue(':NumberOffers', $packPaid->NumberOffers());
        $query->bindValue(':DatePaiment',  $packPaid->DatePaiment());
        $query->bindValue(':IdClient',     $packPaid->IdClient());
        $query->bindValue(':IdPack',       $packPaid->IdPack());
        $query->bindValue(':Identifier',   $packPaid->Identifier());

        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, Price, NumberDays, NumberOffers, DatePaiment, IdClient, IdPack '
                     . 'FROM PackPaid '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $packPaid = new PackPaid();
            $packPaid->Initialize($data);
            $packPaid->setObjects($this->_db);
            return $packPaid;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Price, NumberDays, NumberOffers, DatePaiment, IdClient, IdPack '
                     . 'FROM PackPaid';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $packPaid = new PackPaid();
            $packPaid->Initialize($data);
            $packPaid->setObjects($this->_db);
            $packPaidList[] = $packPaid;
        }

        return (isset($packPaidList)) ? $packPaidList : null;
    }
}
