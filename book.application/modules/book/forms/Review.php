<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Review
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class Book_Form_Review extends Core_Form_BaseForm
{
    public function init()
    {
        $this->setOptions(array(
            'method' => 'post',
            'elements' => array(
                'name' => array('text', array(
                    'label' => 'Your Name',
                    'required' => true,
                    'validators' => array(
                        array('StringLength', false, array('min' => 6, 'max' => 25))
                    ),
                    'description' => 'Placed next to your Gravatar image.',
                    'errorMessages' => array('Required. Minimum 6 chars, maximum 25 chars'),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                )),
                'email' => array('text', array(
                    'label' => 'Your Email',
                    'required' => true,
                    'validators' => array(
                        'emailAddress'
                    ),
                    'description' => 'For your Gravatar image purpose only.',
                    'errorMessages' => array('Empty or invalid email address format'),
                    'attribs' => array(
                        'style' => 'width: 300px;'
                    ),
                )),
                'review_content' => array('textarea', array(
                    'label' => 'Your Review',
                    'required' => true,
                    'validators' => array(
                        array('StringLength', false, array('min' => 10, 'max' => 768))
                    ),
                    'description' => 'Maximum: 768 characters.',
                    'attribs' => array(
                        'rows' => 10
                    ),
                    'errorMessages' => array('Required. Minimum 10 chars, maximum 768 chars'),
                )),
                'captcha' => array('captcha', array(
                    'label'     => 'reCaptcha',
                    'required'  => true,
                    'captcha'        => 'ReCaptcha',
                    'captchaOptions' => array(
                                        'captcha' => 'ReCaptcha',
                                        'service' => $this->getRecaptcha()
                    ),
                    'description' => 'It is a "human validator".',
                    'errorMessages' => array('Required. You have to fill this field according to displayed image'),
                )),
                'submit' => array('submit', array(
                    'label' => 'Submit'
                ))
            )
        ));
    }
}
