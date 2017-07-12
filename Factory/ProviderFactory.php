<?php
/**
 * This factory design pattern allow using multiple providers in the future
 * Just congigurating file "config/parameters.yml" and adding provider that you want
 *
 * @author sebastian
 */
class ProviderFactory {
    
    protected $provider;
    
    public function __construct($params) {
        $this->init($params);
    }
    
    //initialize configuration
    public function init($params) {

        if(isset($params['providers'])){
            $providers = $params['providers'];
            
            //select a random provider
            $providerName = array_rand($providers);
            $providerParams = $providers[$providerName];
            
            //initialize provider (hydrating)
            $this->provider = new ProviderBase($providerParams);
            $this->provider->setName($providerName);

        }else{
            //throw exception when missing configuration param
            throw new \Exception('Providers not defined!');
        }
        
        //This part is for sleep second between sending email and email
        if(isset($params['sleep'])){
            $this->provider->setSleep($params['sleep']);
        }else{
            //throw exception when missing configuration param
            throw new \Exception('Sleep not defined!');
        }
    }
    
    public function getProvider()
    {
        return $this->provider;
    }
    
}