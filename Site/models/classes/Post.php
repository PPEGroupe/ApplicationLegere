<?php
class Post {
    // Attributs
    private $_Identifier;
    private $_Firstname;
    private $_Lastname;
    private $_Email;
    private $_PhoneNumber;
    private $_Address;
    private $_City;
    private $_ZipCode;
    private $_DatePost;
    private $_Letter;
    private $_CV;
    private $_IdOffer;
    
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
		return '{"Identifier":'. $this->Identifier(). ', "Firstname":"'. $this->Firstname(). '", "Lastname":"'. $this->Lastname(). '", "Email":"'. $this->Email(). '", "PhoneNumber":"'. $this->PhoneNumber(). '", "Address":"'. $this->Address(). '", "City":"'. $this->City(). '", "ZipCode":"'. $this->ZipCode(). '", "DatePost":"'. $this->DatePost(). '", "Letter":"'. $this->Letter(). '", "CV":"'. $this->CV(). '", "IdOffer":'. $this->IdOffer(). '}';
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

    function Email() {
        return $this->_Email;
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

    function DatePost() {
        return $this->_DatePost;
    }

    function Letter() {
        return $this->_Letter;
    }

    function CV() {
        return $this->_CV;
    }
    
    function IdOffer() {
        return $this->_IdOffer;
    }

    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setFirstname($Firstname) {
        $this->_Firstname = $Firstname;
    }

    function setLastname($Lastname) {
        $this->_Lastname = $Lastname;
    }

    function setEmail($Email) {
        $this->_Email = $Email;
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
}
