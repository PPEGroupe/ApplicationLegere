<?php
class Post {
    // Attributs
    private $_Identifier;
    private $_DatePost;
    private $_Letter;
    private $_CV;
    private $_IdOffer;
    private $_IdWebUser;
    
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

    function Offer($db) {
        $offerManager = new OfferManager($db);
        
        return $offerManager->Get($this->IdOffer());
    }

    function WebUser($db) {
        $webUserManager = new WebUserManager($db);
        
        return $webUserManager->Get($this->IdWebUser());
    }
    
    public function ToJson()
    {
        return '{"Identifier":'. $this->Identifier(). ', "DatePost":"'. $this->DatePost(). '", "Letter":"'. $this->Letter(). '", "CV":"'. $this->CV(). '", "IdWebUser":'. $this->IdWebUser(). ', "IdOffer":'. $this->IdOffer(). '}';
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
    function IdWebUser() {
        return $this->_IdWebUser;
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

    function setIdWebUser($IdWebUser) {
        $this->_IdWebUser = $IdWebUser;
    }
}
