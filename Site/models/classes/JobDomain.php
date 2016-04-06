<?php
class JobDomain {
    // Attributs
    private $_Identifier;
    private $_Label;
    private $_IdJob;
    
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
    
    public function ToJson()
    {
        return '{"Identifier":'. $this->Identifier(). ', "Label":"'. $this->Label(). '", "IdJob":'. $this->IdJob(). '}';
    }
    
    function Job($db) {
        $jobManager = new JobManager($db);
        
        return $jobManager->Get($this->IdJob());
    }
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function Label() {
        return $this->_Label;
    }

    function IdJob() {
        return $this->_IdJob;
    }

    function setIdentifier($Identifier) {
        $this->_Identifier = $Identifier;
    }

    function setLabel($Label) {
        $this->_Label = $Label;
    }
    
    function setIdJob($IdJob) {
        $this->_IdJob = $IdJob;
    }
}