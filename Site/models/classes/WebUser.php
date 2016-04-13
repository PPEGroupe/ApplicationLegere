<?php
class WebUser {
    // Attributs
    private $_Identifier;
    private $_Firstname;
    private $_Lastname;
    private $_PhoneNumber;
    private $_Address;
    private $_City;
    private $_ZipCode;
    private $_DateRegister;
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
        return '{"Identifier":'. $this->Identifier(). ', "Firstname":"'. $this->Firstname(). '", "Lastname":"'. $this->Lastname(). '", "PhoneNumber":"'. $this->PhoneNumber(). '", "Address":"'. $this->Address(). '", "City":"'. $this->City(). '", "ZipCode":"'. $this->ZipCode(). '", "DateRegister":"'. $this->DateRegister(). '", "IdAccount":'. $this->IdAccount(). '}';
    }

    function Account($db) {
        $accountManager = new AccountManager($db);
        
        return $accountManager->Get($this->IdAccount());
    }
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function Firstname() {
        return $this->_Firstname;
    }

    function Lastname() {
        return $this->_Lastname;
    }

    function PhoneNumber() {
        return $this->_PhoneNumber;
    }

    function Address() {
        return $this->_Address;
    }

    function City() {
        return $this->_City;
    }

    function ZipCode() {
        return $this->_ZipCode;
    }

    function DateRegister() {
        return $this->_DateRegister;
    }

    function Letter() {
        return $this->_Letter;
    }

    function CV() {
        return $this->_CV;
    }
    
    function IdAccount() {
        return $this->_IdAccount;
    }
    
    function IdAccount() {
        return $this->_IdAccount;
    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setFirstname($Firstname) {
        $this->_Firstname = $Firstname;
    }

    function setLastname($Lastname) {
        $this->_Lastname = $Lastname;
    }

    function setPhoneNumber($PhoneNumber) {
        $this->_PhoneNumber = $PhoneNumber;
    }

    function setAddress($Address) {
        $this->_Address = $Address;
    }

    function setCity($City) {
        $this->_City = $City;
    }

    function setZipCode($ZipCode) {
        $this->_ZipCode = $ZipCode;
    }

    function setDatePost($DatePost) {
        $this->_DatePost = $DatePost;
    }

    function setLetter($Letter) {
        $this->_Letter = $Letter;
    }

    function setCV($CV) {
        $this->_CV = $CV;
    }

    function setIdOffer($IdOffer) {
        $this->_IdOffer = $IdOffer;
    }
    
    function setDateRegister($DateRegister) {
        $this->_DateRegister = $DateRegister;
    }

    function setIdAccount($IdAccount) {
        $this->_IdAccount = $IdAccount;
    }
}
