<?php
class Offer {
    // Attributs
    private $_Identifier;
    private $_Title;
    private $_Reference;
    private $_DateStartPublication;
    private $_PublicationDuration;
    private $_DateStartContract;
    private $_JobQuantity;
    private $_Latitude;
    private $_Longitude;
    private $_JobDescription;
    private $_ProfileDescription;
    private $_Address;
    private $_City;
    private $_ZipCode;
    private $_IdTypeOfContract;
    private $_IdJob;
    private $_IdClient;
    private $_Job;
    private $_TypeOfContract;
    private $_Client;
    
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

    function Title() {
        return $this->_Title;
    }

    function Reference() {
        return $this->_Reference;
    }

    function DateStartPublication() {
        return $this->_DateStartPublication;
    }

    function PublicationDuration() {
        return $this->_PublicationDuration;
    }

    function DateStartContract() {
        return $this->_DateStartContract;
    }

    function JobQuantity() {
        return $this->_JobQuantity;
    }

    function Latitude() {
        return $this->_Latitude;
    }

    function Longitude() {
        return $this->_Longitude;
    }

    function JobDescription() {
        return $this->_JobDescription;
    }

    function ProfileDescription() {
        return $this->_ProfileDescription;
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

    function IdTypeOfContract() {
        return $this->_IdTypeOfContract;
    }

    function IdJob() {
        return $this->_IdJob;
    }

    function IdClient() {
        return $this->_IdClient;
    }

    function Job() {
        return $this->_Job;
    }

    function TypeOfContract() {
        return $this->_TypeOfContract;
    }

    function Client() {
        return $this->_Client;
    }
    
    function setIdentifier($_Identifier) {
        $this->_Identifier = $_Identifier;
    }

    function setTitle($_Title) {
        $this->_Title = $_Title;
    }

    function setReference($_Reference) {
        $this->_Reference = $_Reference;
    }

    function setDateStartPublication($_DateStartPublication) {
        $this->_DateStartPublication = $_DateStartPublication;
    }

    function setPublicationDuration($_PublicationDuration) {
        $this->_PublicationDuration = $_PublicationDuration;
    }

    function setDateStartContract($_DateStartContract) {
        $this->_DateStartContract = $_DateStartContract;
    }

    function setJobQuantity($_JobQuantity) {
        $this->_JobQuantity = $_JobQuantity;
    }

    function setLatitude($_Latitude) {
        $this->_Latitude = $_Latitude;
    }

    function setLongitude($_Longitude) {
        $this->_Longitude = $_Longitude;
    }

    function setJobDescription($_JobDescription) {
        $this->_JobDescription = $_JobDescription;
    }

    function setProfileDescription($_ProfileDescription) {
        $this->_ProfileDescription = $_ProfileDescription;
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

    function setIdTypeOfContract($_IdTypeOfContract) {
        $this->_IdTypeOfContract = $_IdTypeOfContract;
    }

    function setIdJob($_IdJob) {
        $this->_IdJob = $_IdJob;
    }

    function setIdClient($_IdClient) {
        $this->_IdClient = $_IdClient;
    }

    function setJob($_Job) {
        $this->_Job = $_Job;
    }

    function setTypeOfContract($_TypeOfContract) {
        $this->_TypeOfContract = $_TypeOfContract;
    }

    function setClient($_Client) {
        $this->_Client = $_Client;
    }
}