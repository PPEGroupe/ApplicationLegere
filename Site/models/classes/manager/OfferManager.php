<?php
class OfferManager {
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
    public function Add(Offer $offer)
    {
        $queryString = 'INSERT INTO Offer (Title, Reference, DateStartPublication, PublicationDuration, JobQuantity, Latitude, Longitude, JobDescription, ProfileDescription, Address, City, ZipCode, IdTypeOfContract, IdJob, IdClient) VALUES '
                     . '(:Title, :Reference, :DateStartPublication, :PublicationDuration, :JobQuantity, :Latitude, :Longitude, :JobDescription, :ProfileDescription, :Address, :City, :ZipCode, :IdTypeOfContract, :IdJob, :IdClient)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Title',                 $offer->Title());
        $query->bindValue(':Reference',             $offer->Reference());
        $query->bindValue(':DateStartPublication',  $offer->DateStartPublication());
        $query->bindValue(':PublicationDuration',   $offer->PublicationDuration());
        $query->bindValue(':JobQuantity',           $offer->JobQuantity());
        $query->bindValue(':Latitude',              $offer->Latitude());
        $query->bindValue(':Longitude',             $offer->Longitude());
        $query->bindValue(':JobDescription',        $offer->JobDescription());
        $query->bindValue(':ProfileDescription',    $offer->ProfileDescription());
        $query->bindValue(':Address',               $offer->Address());
        $query->bindValue(':City',                  $offer->City());
        $query->bindValue(':ZipCode',               $offer->ZipCode());
        $query->bindValue(':IdTypeOfContract',      $offer->IdTypeOfContract());
        $query->bindValue(':IdJob',                 $offer->IdJob());
        $query->bindValue(':IdClient',              $offer->IdClient());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM Offer WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(Offer $offer)
    {
        $queryString = 'UPDATE Offer SET '
                     . 'Title = :Title, '
                     . 'Reference = :Reference, '
                     . 'DateStartPublication = :DateStartPublication, '
                     . 'PublicationDuration = :PublicationDuration, '
                     . 'JobQuantity = :JobQuantity, '
                     . 'Latitude = :Latitude, '
                     . 'Longitude = :Longitude, '
                     . 'JobDescription = :JobDescription, '
                     . 'ProfileDescription = :ProfileDescription, '
                     . 'Address = :Address, '
                     . 'City = :City, '
                     . 'ZipCode = :ZipCode, '
                     . 'IdTypeOfContract = : IdTypeOfContract, '
                     . 'IdJob = :IdJob, '
                     . 'IdClient = :IdClient '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Title',                 $offer->Title());
        $query->bindValue(':Reference',             $offer->Reference());
        $query->bindValue(':DateStartPublication',  $offer->DateStartPublication());
        $query->bindValue(':PublicationDuration',   $offer->PublicationDuration());
        $query->bindValue(':JobQuantity',           $offer->JobQuantity());
        $query->bindValue(':Latitude',              $offer->Latitude());
        $query->bindValue(':Longitude',             $offer->Longitude());
        $query->bindValue(':JobDescription',        $offer->JobDescription());
        $query->bindValue(':ProfileDescription',    $offer->ProfileDescription());
        $query->bindValue(':Address',               $offer->Address());
        $query->bindValue(':City',                  $offer->City());
        $query->bindValue(':ZipCode',               $offer->ZipCode());
        $query->bindValue(':IdTypeOfContract',      $offer->IdTypeOfContract());
        $query->bindValue(':IdJob',                 $offer->IdJob());
        $query->bindValue(':IdClient',              $offer->IdClient());
        $query->bindValue(':Identifier',    $offer->Identifier());

        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, Title, Reference, DateStartPublication, PublicationDuration, JobQuantity, Latitude, Longitude, JobDescription, ProfileDescription, Address, City, ZipCode, IdTypeOfContract, IdJob, IdClient '
                     . 'FROM Offer '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $offer = new Offer();
            $offer->Initialize($data);
            $offer->setObjects($this->_db);
            return $offer;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Title, Reference, DateStartPublication, PublicationDuration, JobQuantity, Latitude, Longitude, JobDescription, ProfileDescription, Address, City, ZipCode, IdTypeOfContract, IdJob, IdClient '
                     . 'FROM Offer';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $offer = new Offer();
            $offer->Initialize($data);
            $offer->setObjects($this->_db);
            $offerList[] = $offer;
        }

        return (isset($offerList)) ? $offerList : null;
    }

    public function GetAllByClient($idClient)
    {
        $queryString = 'SELECT Identifier, Title, Reference, DateStartPublication, PublicationDuration, JobQuantity, Latitude, Longitude, JobDescription, ProfileDescription, Address, City, ZipCode, IdTypeOfContract, IdJob, IdClient '
                     . 'FROM Offer '
                     . 'WHERE IdClient = :IdClient';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdClient', $idClient);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $offer = new Offer();
            $offer->Initialize($data);
            $offer->setObjects($this->_db);
            $offerList[] = $offer;
        }

        return (isset($offerList)) ? $offerList : null;
    }

    public function CountByClient($idClient)
    {
        $queryString = 'SELECT COUNT(Identifier) AS Number '
                     . 'FROM Offer '
                     . 'WHERE IdClient = :IdClient';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdClient', $idClient);
        $query->execute();

        if ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
			return $data['Number'];
        }

        return null;
    }
}
