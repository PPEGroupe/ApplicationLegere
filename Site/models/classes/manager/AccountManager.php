<?php
class AccountManager {
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
    public function Add(Account $account)
    {
        $queryString = 'INSERT INTO Account (Email, Password) VALUES '
                     . '(:Email, :Password)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Email',    $account->Email());
        $query->bindValue(':Password', $account->Password());

        $query->execute();
    }

    public function Remove($identifier)
    {
        $query = $this->_db->prepare('DELETE FROM Account WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $identifier);

        $query->execute();
    }

    public function Update(Account $account)
    {
        $queryString = 'UPDATE Account SET '
                     . 'Email = :Email '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Email',      $account->Email());
        $query->bindValue(':Password',   $account->Password());
        $query->bindValue(':Identifier', $account->Identifier());

        $query->execute();
    }
    
    public function UpdatePassword(Account $account)
    {
        $queryString = 'UPDATE Account SET '
                     . 'Password = :Password '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $account->Identifier());
        $query->bindValue(':Password',   $account->Password());
        $query->execute();
    }

    public function Get($identifier)
    {
        $queryString = 'SELECT Identifier, Email, Password '
                     . 'FROM Account '
                     . 'WHERE Identifier = :Identifier';
        
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $identifier);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $account = new Account();
            $account->Initialize($data);
            return $account;
        }
        else
        {
            return null;
        }
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, Email, Password '
                     . 'FROM Account';
        
        $query = $this->_db->query($queryString);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $account = new Account();
            $account->Initialize($data);
            $account->SetObject($this->_db);
            $accountList[] = $account;
        }

        return (isset($accountList)) ? $accountList : null;
    }
    
    public function GetAccount($email, $password)
    {
        $queryString = 'SELECT Identifier, Email, Password '
                     . 'FROM Account '
                     . 'WHERE Email = :Email '
                     . 'AND Password = :Password';
        
        $query = $this->_db->prepare($queryString);
        
        $query->bindValue(':Email',    $email);
        $query->bindValue(':Password', $password);
        
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($data != null) 
        {
            $account = new Account();
            $account->Initialize($data);
            return $account;
        }
        else
        {
            return null;
        }
    }
    
    public function EmailExists($email)
    {
        $queryString = 'SELECT Identifier '
                     . 'FROM Account '
                     . 'WHERE Email = :Email';
        
        $query = $this->_db->prepare($queryString);
        
        $query->bindValue(':Email', $email);
        
        $query->execute();
        
        $data = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($data != null) 
        {
            return true;
        }
        return false;
    }
}
