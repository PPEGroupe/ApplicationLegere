<?php
class Partner {
    // Attributs
    private $_Identifier;
    private $_URL;
    private $_DateRegister;
    private $_IsValid;
    private $_IdAccount;
    
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
        return '{"Identifier":'. $this->Identifier(). ', "URL":"'. $this->URL(). '"DateRegister":"'. $this->DateRegister(). '", "IsValid":'. $this->IsValid(). ', "IdAccount":'. $this->IdAccount(). ' }';
    }

    function Account($db) {
        $accountManager = new AccountManager($db);
        
        return $accountManager->Get($this->IdAccount());
    }
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function URL() {
        return $this->_URL;
    }
    function DateRegister() {
        return $this->_DateRegister;
    }

    function IsValid() {
        return $this->_IsValid;
    }

    function IdAccount() {
        return $this->_IdAccount;
    }
    
    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setURL($URL) {
        $this->_URL = $URL;
    }

    function setDateRegister($DateRegister) {
        $this->_DateRegister = $DateRegister;
    }

    function setIsValid($IsValid) {
        $this->_IsValid = $IsValid;
    }

    function setIdAccount($IdAccount) {
        $this->_IdAccount = $IdAccount;
    }
}