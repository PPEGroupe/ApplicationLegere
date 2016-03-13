<?php
class TypeOfContractManager {
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
    public function Add(TypeOfContract $typeOfContract)
    {
        $queryString = 'INSERT INTO TypeOfContract (Label) VALUES '
                     . '(:Label)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Label', $typeOfContract->Label());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM TypeOfContract WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(TypeOfContract $typeOfContract)
    {
        $queryString = 'UPDATE TypeOfContract SET '
                     . 'Label = Label '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Label', $typeOfContract->Label());
        $query->bindValue(':Identifier', $typeOfContract->Identifier());

        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, Label '
                     . 'FROM TypeOfContract '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $typeOfContract = new TypeOfContract();
            $typeOfContract->Initialize($data);
            return $typeOfContract;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Label '
                     . 'FROM TypeOfContract';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $typeOfContract = new TypeOfContract();
            $typeOfContract->Initialize($data);
            $typeOfContractList[] = $typeOfContract;
        }

        return (isset($typeOfContractList)) ? $typeOfContractList : null;
    }
}
