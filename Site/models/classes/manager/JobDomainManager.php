<?php
class JobDomainManager {
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
    public function Add(JobDomain $jobDomain)
    {
        $queryString = 'INSERT INTO JobDomain (Label) VALUES '
                     . '(:Label)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Label', $jobDomain->Label());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM JobDomain WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(JobDomain $jobDomain)
    {
        $queryString = 'UPDATE JobDomain SET '
                     . 'Label = :Label '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Label',         $jobDomain->Label());
        $query->bindValue(':Identifier',    $jobDomain->Identifier());

        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, Label '
                     . 'FROM JobDomain '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $jobDomain = new JobDomain();
            $jobDomain->Initialize($data);
            return $jobDomain;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Label '
                     . 'FROM JobDomain';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $jobDomain = new JobDomain();
            $jobDomain->Initialize($data);
            $jobDomainList[] = $jobDomain;
        }

        return (isset($jobDomainList)) ? $jobDomainList : null;
    }
}
