<?php
class Pack {
    // Attributs
    private $_Identifier;
    private $_NumberOffer;
    private $_NumberDays;
    private $_Price;
    private $_IdPackPaid;
    
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
        return '{"Identifier":'. $this->Identifier(). ', "NumberOffers":'. $this->NumberOffers(). '", "NumberDays":'. $this->NumberDays(). '", "Price":'. $this->Price(). ', "IdPackPaid":'. $this->IdPackPaid(). '}';
    }

    function PackPaid($db) {
        $packPaidManager = new PackPaidManager($db);
        
        return $packPaidManager->Get($this->IdPackPaid());
    }
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function NumberOffer() {
        return $this->_NumberOffer;
    }

    function NumberDays() {
        return $this->_NumberDays;
    }

    function Price() {
        return $this->_Price;
    }

    function IdPackPaid() {
        return $this->_IdPackPaid;
    }

    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setNumberOffer($NumberOffer) {
        $this->_NumberOffer = $NumberOffer;
    }

    function setNumberDays($NumberDays) {
        $this->_NumberDays = $NumberDays;
    }

    function setPrice($Price) {
        $this->_Price = $Price;
    }

    function setIdPackPaid($IdPackPaid) {
        $this->_IdPackPaid = $IdPackPaid;
    }
}
