<?php

namespace App\ThirdParty\GoogleWallet\Objects;

use Google\Collection as Google_Collection;
use Google_Service_Walletobjects_AppLinkData;
use Google_Service_Walletobjects_GroupingInfo;
use Google_Service_Walletobjects_Image;
use Google_Service_Walletobjects_LinksModuleData;
use Google_Service_Walletobjects_LocalizedString;
use Google_Service_Walletobjects_Notifications;
use Google_Service_Walletobjects_PassConstraints;
use Google_Service_Walletobjects_RotatingBarcode;
use Google_Service_Walletobjects_TimeInterval;

class Google_Service_Walletobjects_GenericObject extends Google_Collection {

    protected $collection_key = 'textModulesData';
    protected $internal_gapi_mappings = [];
    protected $appLinkDataType = 'Google_Service_Walletobjects_AppLinkData';
    protected $appLinkDataDataType = '';
    protected $barcodeType = 'Google_Service_Walletobjects_Barcode';
    protected $barcodeDataType = '';
    protected $cardTitleType = 'Google_Service_Walletobjects_LocalizedString';
    protected $cardTitleDataType = '';
    public $classId;
    public $genericType;
    protected $groupingInfoType = 'Google_Service_Walletobjects_GroupingInfo';
    protected $groupingInfoDataType = '';
    public $hasUsers;
    protected $headerType = 'Google_Service_Walletobjects_LocalizedString';
    protected $headerDataType = '';
    protected $heroImageType = 'Google_Service_Walletobjects_Image';
    protected $heroImageDataType = '';
    public $hexBackgroundColor;
    public $id;
    protected $imageModulesDataType = 'Google_Service_Walletobjects_ImageModuleData';
    protected $imageModulesDataDataType = 'array';
    protected $linksModuleDataType = 'Google_Service_Walletobjects_LinksModuleData';
    protected $linksModuleDataDataType = '';
    protected $logoType = 'Google_Service_Walletobjects_Image';
    protected $logoDataType = '';
    protected $notificationsType = 'Google_Service_Walletobjects_Notifications';
    protected $notificationsDataType = '';
    protected $passConstraintsType = 'Google_Service_Walletobjects_PassConstraints';
    protected $passConstraintsDataType = '';
    protected $rotatingBarcodeType = 'Google_Service_Walletobjects_RotatingBarcode';
    protected $rotatingBarcodeDataType = '';
    public $smartTapRedemptionValue;
    public $state;
    protected $subheaderType = 'Google_Service_Walletobjects_LocalizedString';
    protected $subheaderDataType = '';
    protected $textModulesDataType = 'Google_Service_Walletobjects_TextModuleData';
    protected $textModulesDataDataType = 'array';
    protected $validTimeIntervalType = 'Google_Service_Walletobjects_TimeInterval';
    protected $validTimeIntervalDataType = '';

    public function setAppLinkData(Google_Service_Walletobjects_AppLinkData $appLinkData) {
        $this->appLinkData = $appLinkData;
    }

    public function getAppLinkData() {
        return $this->appLinkData;
    }

    public function setBarcode(Google_Service_Walletobjects_Barcode $barcode) {
        $this->barcode = $barcode;
    }

    public function getBarcode() {
        return $this->barcode;
    }

    public function setCardTitle(Google_Service_Walletobjects_LocalizedString $cardTitle) {
        $this->cardTitle = $cardTitle;
    }

    public function getCardTitle() {
        return $this->cardTitle;
    }

    public function setClassId($classId) {
        $this->classId = $classId;
    }

    public function getClassId() {
        return $this->classId;
    }

    public function setGenericType($genericType) {
        $this->genericType = $genericType;
    }

    public function getGenericType() {
        return $this->genericType;
    }

    public function setGroupingInfo(Google_Service_Walletobjects_GroupingInfo $groupingInfo) {
        $this->groupingInfo = $groupingInfo;
    }

    public function getGroupingInfo() {
        return $this->groupingInfo;
    }

    public function setHasUsers($hasUsers) {
        $this->hasUsers = $hasUsers;
    }

    public function getHasUsers() {
        return $this->hasUsers;
    }

    public function setHeader(Google_Service_Walletobjects_LocalizedString $header) {
        $this->header = $header;
    }

    public function getHeader() {
        return $this->header;
    }

    public function setHeroImage(Google_Service_Walletobjects_Image $heroImage) {
        $this->heroImage = $heroImage;
    }

    public function getHeroImage() {
        return $this->heroImage;
    }

    public function setHexBackgroundColor($hexBackgroundColor) {
        $this->hexBackgroundColor = $hexBackgroundColor;
    }

    public function getHexBackgroundColor() {
        return $this->hexBackgroundColor;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setImageModulesData($imageModulesData) {
        $this->imageModulesData = $imageModulesData;
    }

    public function getImageModulesData() {
        return $this->imageModulesData;
    }

    public function setLinksModuleData(Google_Service_Walletobjects_LinksModuleData $linksModuleData) {
        $this->linksModuleData = $linksModuleData;
    }

    public function getLinksModuleData() {
        return $this->linksModuleData;
    }

    public function setLogo(Google_Service_Walletobjects_Image $logo) {
        $this->logo = $logo;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setNotifications(Google_Service_Walletobjects_Notifications $notifications) {
        $this->notifications = $notifications;
    }

    public function getNotifications() {
        return $this->notifications;
    }

    public function setPassConstraints(Google_Service_Walletobjects_PassConstraints $passConstraints) {
        $this->passConstraints = $passConstraints;
    }

    public function getPassConstraints() {
        return $this->passConstraints;
    }

    public function setRotatingBarcode(Google_Service_Walletobjects_RotatingBarcode $rotatingBarcode) {
        $this->rotatingBarcode = $rotatingBarcode;
    }

    public function getRotatingBarcode() {
        return $this->rotatingBarcode;
    }

    public function setSmartTapRedemptionValue($smartTapRedemptionValue) {
        $this->smartTapRedemptionValue = $smartTapRedemptionValue;
    }

    public function getSmartTapRedemptionValue() {
        return $this->smartTapRedemptionValue;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }

    public function setSubheader(Google_Service_Walletobjects_LocalizedString $subheader) {
        $this->subheader = $subheader;
    }

    public function getSubheader() {
        return $this->subheader;
    }

    public function setTextModulesData($textModulesData) {
        $this->textModulesData = $textModulesData;
    }

    public function getTextModulesData() {
        return $this->textModulesData;
    }

    public function setValidTimeInterval(Google_Service_Walletobjects_TimeInterval $validTimeInterval) {
        $this->validTimeInterval = $validTimeInterval;
    }

    public function getValidTimeInterval() {
        return $this->validTimeInterval;
    }
}
