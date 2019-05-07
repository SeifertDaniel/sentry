<?php

namespace OxidProfessionalServices\Sentry\Traits;

use OxidEsales\Eshop\Core\Registry;

trait ShopcontrolTrait
{
    public function start($sClass = null, $sFunction = null, $aParams = null, $aViewsChain = null)
    {
        $sentryUrl = Registry::getConfig()->getConfigParam('oxpsSentryPhpUrl');
        if ($sentryUrl != '' && class_exists('Sentry')) {
            \Sentry\init([
                'dsn'         => $sentryUrl,
                'environment' => Registry::getConfig()->getConfigParam('oxpsSentryEnvirnoment'),
            ]);
        }

        parent::start($sClass, $sFunction, $aParams, $aViewsChain);
    }

    protected function _handleCookieException($exception)
    {
        $this->reportToSentry($exception);
        parent::_handleCookieException($exception);
    }

    protected function _handleDbConnectionException($exception)
    {
        $this->reportToSentry($exception);
        parent::_handleDbConnectionException($exception);
    }

    protected function _handleBaseException($exception)
    {
        $this->reportToSentry($exception);
        parent::_handleBaseException($exception);
    }

    protected function _handleSystemException($exception)
    {
        $this->reportToSentry($exception);
        parent::_handleSystemException($exception);
    }

    protected function _handleAccessRightsException($exception)
    {
        $this->reportToSentry($exception);
        parent::_handleAccessRightsException($exception);
    }
}
