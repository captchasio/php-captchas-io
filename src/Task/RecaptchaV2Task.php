<?php

namespace CaptchasIO\Task;

use CaptchasIO\Helper\ProxySupportTrait;

/**
 * Class RecaptchaV2Task.
 */
class RecaptchaV2Task extends AbstractTask
{
    use ProxySupportTrait;

    /** @var string $websiteUrl */
    protected $websiteUrl;

    /** @var string $websiteKey */
    protected $websiteKey;

    /** @var string $recaptchaDataSValue */
    protected $recaptchaDataSValue;

    /** @var boolean $isInvisible */
    protected $isInvisible;

    /**
     * @param string $websiteUrl
     * @param string$websiteKey
     *
     * @return void
     */
    public function __construct(string $websiteUrl, string $websiteKey)
    {
        $this->websiteUrl = $websiteUrl;
        $this->websiteKey = $websiteKey;
    }


    public function setIsInvisible(bool $isInvisible)
    {
        $this->isInvisible = $isInvisible;
    }

    public function setRecaptchaDataSValue($recaptchaDataSValue)
    {
        $this->recaptchaDataSValue = $recaptchaDataSValue;
    }

    /**
     * @return array
     */
    public function getTaskParams()
    {
        $data = [];

        $data['type'] = $this->useProxy() ? 'RecaptchaV2Task' : 'RecaptchaV2TaskProxyless';
        $data['websiteURL'] = $this->websiteUrl;
        $data['websiteKey'] = $this->websiteKey;

        if (!is_null($this->recaptchaDataSValue)) {
            $data['recaptchaDataSValue'] = $this->recaptchaDataSValue;
        }

        if (!is_null($this->isInvisible)) {
            $data['isInvisible'] = $this->isInvisible;
        }

        if ($this->useProxy()) {
            $data = array_merge($data, $this->proxyParams);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function otherRequestParams()
    {
        return [];
    }
}
