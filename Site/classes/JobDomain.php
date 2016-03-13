<?php
class JobDomain {
    // Attributs
    private $_Identifier;
    private $_Label;
    private $_Job;
    
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

    function Label() {
        return $this->_Label;
    }

    function Job() {
        return $this->_Job;
    }

    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setLabel($Label) {
        $this->_Label = $Label;
    }

    function setJob($Job) {
        $this->_Job = $Job;
    }
}