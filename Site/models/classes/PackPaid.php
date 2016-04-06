<?php
class PackPaid {
    // Attributs
    private $_Identifier;
    private $_NumberOffers;
    private $_NumberDays;
    private $_DatePaiment;
    private $_IdClient;
    private $_IdPack;
    
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
        return '{"Identifier":'. $this->Identifier(). ', "NumberOffers":'. $this->NumberOffers(). '", "NumberDays":'. $this->NumberDays(). '", "DatePaiment":"'. $this->DatePaiment(). '", "IdClient":'. $this->IdClient(). ', "IdPack":'. $this->IdPack(). '}';
    }

    function Client($db) {
        $clientManager = new ClientManager($db);
        
        return $clientManager->Get($this->IdClient());
    }

    function Pack($db) {
        $packManager = new PackManager($db);
        
        return $packManager->Get($this->IdPack());
    }
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function NumberOffers() {
        return $this->_NumberOffers;
    }

    function NumberDays() {
        return $this->_NumberDays;
    }

    function DatePaiment() {
        return $this->_DatePaiment;
    }

    function IdClient() {
        return $this->_IdClient;
    }

    function IdPack() {
        return $this->_IdPack;
    }

    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setNumberOffers($NumberOffers) {
        $this->_NumberOffers = $NumberOffers;
    }

    function setNumberDays($NumberDays) {
        $this->_NumberDays = $NumberDays;
    }

    function setDatePaiment($DatePaiment) {
        $this->_DatePaiment = $DatePaiment;
    }

    function setIdClient($IdClient) {
        $this->_IdClient = $IdClient;
    }

    function setIdPack($IdPack) {
        $this->_IdPack = $IdPack;
    }
}
