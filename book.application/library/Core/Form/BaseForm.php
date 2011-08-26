<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * BaseForm
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Core_Form_BaseForm extends Zend_Form
{
    /**
     * Proxy to get a service
     * 
     * @param string $service_name
     * @return Core_Service_ServiceAbstract
     */
    public function getService($service_name)
    {
        return Core_Service_Proxy::get($service_name);
    }
    
    /**
     * Get recaptcha options from config files, set it, and return as a 
     * Zend_Service_ReCaptcha object
     * 
     * @return Zend_Service_ReCaptcha 
     */
    public function getRecaptcha()
    {
        $recaptchaConfig = new Zend_Config_Ini(CONFIG_PATH . DS . 'misc.default.ini', 'simukti');
        $recaptcha_public   = $recaptchaConfig->recaptcha->public;
        $recaptcha_private  = $recaptchaConfig->recaptcha->private;

        $recaptcha = new Zend_Service_ReCaptcha($recaptcha_public, $recaptcha_private);
        $recaptcha->setOption('theme', 'clean');
        return $recaptcha;
    }
}
