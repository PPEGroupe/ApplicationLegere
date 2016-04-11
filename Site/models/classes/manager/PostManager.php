<?php
class PostManager {
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
    public function Add(Post $post)
    {
        $queryString = 'INSERT INTO Post (DatePost, Letter, CV, IdWebUser, IdOffer) VALUES '
                     . '(:DatePost, :Letter, :CV, :IdWebUser, :IdOffer)';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':DatePost',  $post->DatePost());
        $query->bindValue(':Letter',    $post->Letter());
        $query->bindValue(':CV',        $post->CV());
        $query->bindValue(':IdWebUser', $post->IdWebUser());
        $query->bindValue(':IdOffer',   $post->IdOffer());

        $query->execute();
    }

    public function Remove($id)
    {
        $query = $this->_db->prepare('DELETE FROM Post WHERE Identifer = :Identifer');
        $query->bindValue(':Identifer', $id);

        $query->execute();
    }

    public function Update(Post $post)
    {
        $queryString = 'UPDATE Post SET '
                     . 'DatePost = :DatePost, '
                     . 'Letter = :Letter, '
                     . 'CV = :CV, '
                     . 'IdOffer = :IdOffer, '
                     . 'IdWebUser = :IdWebUser '
                     . 'WHERE Identifier = :Identifier';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':DatePost',   $post->DatePost());
        $query->bindValue(':Letter',     $post->Letter());
        $query->bindValue(':CV',         $post->CV());
        $query->bindValue(':IdWebUser',  $post->IdWebUser());
        $query->bindValue(':IdOffer',    $post->IdOffer());
        $query->bindValue(':Identifier', $post->Identifier());

        $query->execute();
    }

    public function Get($identifier)
    {
        $queryString = 'SELECT Identifier, DatePost, Letter, CV, IdWebUser, IdOffer '
                     . 'FROM Post '
                     . 'WHERE Identifier = :Identifier';
        
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':Identifier', $identifier);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data != null) 
        {
            $post = new Post();
            $post->Initialize($data);
            return $post;
        }
        else
        {
            return null;
        }
    }

    public function GetAllByOffer($idOffer)
    {
        $queryString = 'SELECT Identifier, DatePost, Letter, CV, IdWebUser, IdOffer '
                     . 'FROM Post '
                     . 'WHERE IdOffer = :IdOffer';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdOffer', $idOffer);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $post = new Post();
            $post->Initialize($data);
            $postList[] = $post;
        }

        return (isset($postList)) ? $postList : null;
    }

    public function GetAllByWebUser($idWebUser)
    {
        $queryString = 'SELECT Identifier, DatePost, Letter, CV, IdWebUser, IdOffer '
                     . 'FROM Post '
                     . 'WHERE IdWebUser = :IdWebUser';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdWebUser', $idWebUser);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $post = new Post();
            $post->Initialize($data);
            $postList[] = $post;
        }

        return (isset($postList)) ? $postList : null;
    }

    public function GetAll()
    {
        $queryString = 'SELECT Identifier, DatePost, Letter, CV, IdWebUser, IdOffer '
                     . 'FROM Post';
        
        $query = $this->_db->query($queryString);

        while ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
            $post = new Post();
            $post->Initialize($data);
            $postList[] = $post;
        }

        return (isset($postList)) ? $postList : null;
    }
	
	public function CountByOffer($idOffer)
    {
        $queryString = 'SELECT COUNT(Identifier) AS Number '
                     . 'FROM Post '
                     . 'WHERE IdOffer = :IdOffer';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdOffer', $idOffer);
        $query->execute();

        if ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
			return $data['Number'];
        }

        return null;
    }
    
	public function CountByWebUser($idWebUser)
    {
        $queryString = 'SELECT COUNT(Identifier) AS Number '
                     . 'FROM Post '
                     . 'WHERE IdWebUser = :IdWebUser';
        
        $query = $this->_db->prepare($queryString);
        $query->bindValue(':IdWebUser', $idWebUser);
        $query->execute();

        if ($data = $query->fetch(PDO::FETCH_ASSOC))
        {
			return $data['Number'];
        }

        return null;
    }
}
