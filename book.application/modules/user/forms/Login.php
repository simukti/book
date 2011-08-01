<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Login
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class User_Form_Login extends Core_Form_BaseForm
{
    public function init()
    {
        $this->setOptions(array(
            'method' => 'post',
            'elements' => array(
                'uname' => array('text', array(
                    'label'      => 'Username',
                    'required'   => true,
                    'validators' => array(
                        array('StringLength', false, array('min' => 6, 'max' => 16))
                    ),
                    'attribs' => array(
                        'style' => 'width: 425px; padding: 12px;'
                    ),
                    //'errorMessages' => array('Required. You have to fill this field'),
                )),
                'passwd' => array('password', array(
                    'label'      => 'Password',
                    'required'   => true,
                    'validators' => array(
                        array('StringLength', false, array('min' => 6, 'max' => 20))
                    ),
                    'attribs' => array(
                        'style' => 'width: 425px; padding: 12px;'
                    ),
                    //'errorMessages' => array('Required. You have to fill this field'),
                )),
                /*
                'captcha' => array('Captcha', array(
                    'label'     => 'reCaptcha',
                    'required'  => true,
                    'captcha'        => 'ReCaptcha',
                    'captchaOptions' => array(
                                        'captcha' => 'ReCaptcha',
                                        'service' => $this->getRecaptcha()
                    ),
                    'errorMessages' => array('Required. You have to fill this field according to displayed image'),
                )),
                */
                'submit' => array('submit', array(
                    'label' => 'Login',
                    'attribs' => array(
                        'style' => 'width: 100px;'
                    )
                )),
                'csrf' => array('hash')
            ),
        ));
    }
}
