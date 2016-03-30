<?php
class Job {
    // Attributs
    private $_Identifier;
    private $_Label;
    private $_IdJobDomain;
    private $_JobDomain;
    
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
    
    public function setObjects($db)
    {
        $jobDomainManager = new JobDomainManager($db);
        
        $this->setJobDomain($jobDomainManager->Get($this->IdJobDomain()));
    }
    
	public function ToJson()
	{
		return '{"Identifier":'. $this->Identifier(). ', "Label":"'. $this->Label(). '", "IdJobDomain":'. $this->IdJobDomain(). '}';
	}
    
    // Propriétés
    function Identifier() {
        return $this->_Identifier;
    }

    function Label() {
        return $this->_Label;
    }

    function IdJobDomain() {
        return $this->_IdJobDomain;
    }

    function JobDomain() {
        return $this->_JobDomain;
    }

    function setIdentifier($_Identifier) {
        $this->_Identifier = $_Identifier;
    }

    function setLabel($_Label) {
        $this->_Label = $_Label;
    }

    function setIdJobDomain($_IdJobDomain) {
        $this->_IdJobDomain = $_IdJobDomain;
    }

    function setJobDomain($_JobDomain) {
        $this->_JobDomain = $_JobDomain;
    }
}