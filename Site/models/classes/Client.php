<?php
class Client {
    // Attributs
    private $_Identifier;
    private $_URL;
    private $_PhoneNumber;
    private $_Fax;
    private $_Address;
    private $_City;
    private $_ZipCode;
    private $_Company;
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
        return '{"Identifier":'. $this->Identifier(). ', "URL":"'. $this->URL(). '", "PhoneNumber":"'. $this->PhoneNumber(). '", "Fax":"'. $this->Fax(). '", "Address":"'. $this->Address(). '", "City":"'. $this->City(). '", "ZipCode":"'. $this->ZipCode(). '", "Company":"'. $this->Company(). '", "DateRegister":"'. $this->DateRegister(). '", "IsValid":'. $this->IsValid(). ', "IdAccount":'. $this->IdAccount(). '}';
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

    function PhoneNumber() {
        return $this->_PhoneNumber;
    }

    function Fax() {
        return $this->_Fax;
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

    function Company() {
        return $this->_Company;
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

    function setIdentifier($_Identifier) {
        $this->_Identifier = $_Identifier;
    }

    function setURL($_URL) {
        $this->_URL = $_URL;
    }

    function setPhoneNumber($_PhoneNumber) {
        $this->_PhoneNumber = $_PhoneNumber;
    }

    function setFax($_Fax) {
        $this->_Fax = $_Fax;
    }

    function setAddress($_Address) {
        $this->_Address = $_Address;
    }

    function setCity($_City) {
        $this->_City = $_City;
    }

    function setZipCode($_ZipCode) {
        $this->_ZipCode = $_ZipCode;
    }

    function setCompany($_Company) {
        $this->_Company = $_Company;
    }

    function setDateRegister($DateRegister) {
        $this->_DateRegister = $DateRegister;
    }

    function setIsValid($IsValid) {
        $this->_IsValid = $IsValid;
    }
    
    function setDateRegister($_DateRegister) {
        $this->_DateRegister = $_DateRegister;
    }

    function setIdAccount($_IdAccount) {
        $this->_IdAccount = $_IdAccount;
    }
}