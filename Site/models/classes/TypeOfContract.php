<?php
class TypeOfContract {
    // Attributs
    private $_Identifier;
    private $_Label;
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
        return '{"Identifier":'. $this->Identifier(). ', "Label":"'. $this->Label(). '"}';
    }

    function Offer($db) {
        $offerManager = new OfferManager($db);
        
        return $offerManager->Get($this->IdOffer());
    }
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function Label() {
        return $this->_Label;
    }
    
    function getIdOffer() {
        return $this->_IdOffer;
    }

    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setLabel($Label) {
        $this->_Label = $Label;
    }

    function setIdOffer($IdOffer) {
        $this->_IdOffer = $IdOffer;
    }
}