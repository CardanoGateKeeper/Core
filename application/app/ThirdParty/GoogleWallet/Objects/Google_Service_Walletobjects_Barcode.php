<?php

namespace App\ThirdParty\GoogleWallet\Objects;

use Google\Model as Google_Model;

class Google_Service_Walletobjects_Barcode extends Google_Model
{
    protected $internal_gapi_mappings = array(
    );
    public $alternateText;
    public $kind;
    public $renderEncoding;
    protected $showCodeTextType = 'Google_Service_Walletobjects_LocalizedString';
    protected $showCodeTextDataType = '';
    public $type;
    public $value;


    public function setAlternateText($alternateText)
    {
        $this->alternateText = $alternateText;
    }
    public function getAlternateText()
    {
        return $this->alternateText;
    }
    public function setKind($kind)
    {
        $this->kind = $kind;
    }
    public function getKind()
    {
        return $this->kind;
    }
    public function setRenderEncoding($renderEncoding)
    {
        $this->renderEncoding = $renderEncoding;
    }
    public function getRenderEncoding()
    {
        return $this->renderEncoding;
    }
    public function setShowCodeText(Google_Service_Walletobjects_LocalizedString $showCodeText)
    {
        $this->showCodeText = $showCodeText;
    }
    public function getShowCodeText()
    {
        return $this->showCodeText;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setValue($value)
    {
        $this->value = $value;
    }
    public function getValue()
    {
        return $this->value;
    }
}
