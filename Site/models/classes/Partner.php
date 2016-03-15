<?php
class Partner {
    // Attributs
    private $_Identifier;
    private $_URL;
    private $_Email;
    private $_Password;
    
    // Méthode
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
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function URL() {
        return $this->_URL;
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

    function setURL($URL) {
        $this->_URL = $URL;
    }

    function setEmail($Email) {
        $this->_Email = $Email;
    }

    function setPassword($Password) {
        $this->_Password = $Password;
    }
}