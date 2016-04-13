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
    private $_NumberViews;
    private $_IsDeleted;
    private $_IdTypeOfContract;
    private $_IdJob;
    private $_IdClient;
    private $_TypeOfContract;
    private $_Job;
    private $_Client;
    
    // Méthodes
    public function Initialize(array $data)
    {
        foreach ($data as $key => $value) 
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
    
    public function ToJson()
    {
        return '{"Identifier":'. $this->Identifier(). ', "Title":"'. $this->Title(). '", "Reference":"'. $this->Reference(). '", "DateStartPublication":"'. $this->DateStartPublication(). '", "PublicationDuration":"'. $this->PublicationDuration(). '", "DateStartContract":"'. $this->DateStartContract(). '", "JobQuantity":'. $this->JobQuantity(). ', "Latitude":"'. $this->Latitude(). '", "Longitude":"'. $this->Longitude(). '", "JobDescription":"'. $this->JobDescription(). '", "ProfileDescription":"'. $this->ProfileDescription(). '", "Address":"'. $this->Address(). '", "City":"'. $this->City(). '", "ZipCode":"'. $this->ZipCode().'", "NumberViews":'. $this->NumberViews().', "IsDeleted":'. $this->IsDeleted().', "IdJob":'. $this->IdJob().', "IdTypeOfContract":'. $this->IdTypeOfContract().', "IdClient":'. $this->IdClient().'}';
    }

    function TypeOfContract($db) {
        $typeOfContractManager = new TypeOfContractManager($db);
        
        return $typeOfContractManager->Get($this->IdTypeOfContract());
    }

    function Job($db) {
        $jobManager = new JobManager($db);
        
        return $jobManager->Get($this->IdJob());
    }

    function Client($db) {
        $clientManager = new ClientManager($db);
        
        return $clientManager->Get($this->IdClient());
    }

    function AddView() {
        $this->_NumberViews++;
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
    
    function NumberViews() {
        return $this->_NumberViews;
    }

    function IsDeleted() {
        return $this->_IsDeleted;
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
    
    function setIdentifier($Identifier) {
        $this->_Identifier = (int)$Identifier;
    }

    function setTitle($Title) {
        $this->_Title = $Title;
    }

    function setReference($Reference) {
        $this->_Reference = $Reference;
    }

    function setDateStartPublication($DateStartPublication) {
        $this->_DateStartPublication = $DateStartPublication;
    }

    function setPublicationDuration($PublicationDuration) {
        $this->_PublicationDuration = $PublicationDuration;
    }

    function setDateStartContract($DateStartContract) {
        $this->_DateStartContract = $DateStartContract;
    }

    function setJobQuantity($JobQuantity) {
        $this->_JobQuantity = (int)$JobQuantity;
    }

    function setLatitude($Latitude) {
        $this->_Latitude = $Latitude;
    }

    function setLongitude($Longitude) {
        $this->_Longitude = $Longitude;
    }

    function setJobDescription($JobDescription) {
        $this->_JobDescription = $JobDescription;
    }

    function setProfileDescription($ProfileDescription) {
        $this->_ProfileDescription = $ProfileDescription;
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

    function setNumberViews($NumberViews) {
        $this->_NumberViews = $NumberViews;
    }

    function setIsDeleted($IsDeleted) {
        $this->_IsDeleted = $IsDeleted;
    }

    function setIdTypeOfContract($IdTypeOfContract) {
        $this->_IdTypeOfContract = (int)$IdTypeOfContract;
    }

    function setIdJob($IdJob) {
        $this->_IdJob = (int)$IdJob;
    }

    function setIdClient($IdClient) {
        $this->_IdClient = (int)$IdClient;
    }
}