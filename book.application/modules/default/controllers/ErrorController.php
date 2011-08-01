<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * ErrorController
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
class ErrorController extends Core_Controller_Action
{
    /**
     * Default application error action
     */
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        if (! $errors) {
            $this->view->message = 'You have reached the error page';
            return;
        }

        $logger = new Zend_Log();

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);

                $this->view->message = 'Request parameter is not found';
                //$params = $this->getRequest()->getParams();
                $this->view->requestUri = $errors['request']->getRequestUri();
                //$this->render('noroute');
                $writer = new Zend_Log_Writer_Stream(LOG_PATH . DS . '404.log');
                $logger->addWriter($writer);
                $logger->log('[' . $_SERVER["REMOTE_ADDR"] . '] ' . $errors->exception->getMessage(), Zend_Log::ERR);

                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Application error';

                $writer = new Zend_Log_Writer_Stream(LOG_PATH . DS . '500.log');
                $logger->addWriter($writer);
                $logger->log($errors->exception->getMessage(), Zend_Log::ERR);
                
                break;
        }
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        $this->view->request   = $errors->request;
    }
}
