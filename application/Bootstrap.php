<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }


    protected function _initTranslate()
    {
        $translation = new Zend_Translate('Zend_Translate_Adapter_Csv', realpath(APPLICATION_PATH).'/../languages/ru/lang.csv', 'ru');

        return $translation;
    }


    public function getBaseUrlFromSettings()
    {
        $this->getOption('app.settings.baseUrl');
    }
}