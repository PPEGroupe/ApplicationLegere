<?php
class Account {
    // Attributs
    private $_Identifier;
    private $_Email;
    private $_Password;
    
    // Méthodes
    public function Initialize(array $data)
    {
        foreach ($data as $key => $value) 
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
    
    public function ToJson()
    {
        return '{"Identifier":'. $this->Identifier(). ', "Email":"'. $this->Email(). '"}';
    }
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function Email() {
        return $this->_Email;
    }

    function Password() {
        return $this->_Password;
    }

    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setEmail($Email) {
        $this->_Email = $Email;
    }

    function setPassword($Password) {
        $this->_Password = $Password;
    }
}
