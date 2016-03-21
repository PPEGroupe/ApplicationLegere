<?php
class Client {
    // Attributs
    private $_Identifier;
    private $_URL;
    private $_Email;
    private $_PhoneNumber;
    private $_Fax;
    private $_Address;
    private $_City;
    private $_ZipCode;
    private $_Company;
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
    
    function Password() {
        return $this->_Password;
    }

    function setIdentifier($_Identifier) {
        $this->_Identifier = $_Identifier;
    }

    function setURL($_URL) {
        $this->_URL = $_URL;
    }

    function setEmail($_Email) {
        $this->_Email = $_Email;
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
    
    function setPassword($_Password) {
        $this->_Password = $_Password;
    }
}