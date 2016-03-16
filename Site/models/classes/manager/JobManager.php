<?php
class JobManager {
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
    public function Add(Job $job)
    {
        $queryString = 'INSERT INTO Job (Label, IdJobDomain) VALUES '
                     . '(:Label, :IdJobDomain)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Label',         $job->Label());
        $query->bindValue(':IdJobDomain',   $job->IdJobDomain());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM Job WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(Job $job)
    {
        $queryString = 'UPDATE Job SET '
                     . 'Label = :Label, '
                     . 'IdJobDomain = :IdJobDomain '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Label',         $job->Label());
        $query->bindValue(':IdJobDomain',   $job->IdJobDomain());
        $query->bindValue(':Identifier',    $job->Identifier());

        $query->execute();
    }

    public function Get($id)
    {
        $queryString = 'SELECT Identifier, Label, IdJobDomain '
                     . 'FROM Job '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $id);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $job = new Job();
            $job->Initialize($data);
            $job->setObjects($this->_db);
            return $job;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Label, IdJobDomain '
                     . 'FROM Job';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $job = new Job();
            $job->Initialize($data);
            $job->setObjects($this->_db);
            $jobList[] = $job;
        }

        return (isset($jobList)) ? $jobList : null;
    }
}