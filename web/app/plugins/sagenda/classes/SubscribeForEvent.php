<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubscribeForEvent
 *
 * @author zohaib
 */
class SubscribeForEvent {

    //put your code here
    private $ApiToken;
    private $EventIdentifier;
    private $BookableItemId;
    private $EventScheduleId;
    private $Courtesy;
    private $FirstName;
    private $LastName;
    private $PhoneNumber;
    private $Email;
    private $Description;

    public function __construct() {
        $this->ApiToken = get_option('mrs1_authentication_code');
    }

    public function getApiToken() {
        return $this->ApiToken;
    }

    public function getEventIdentifier() {
        return $this->EventIdentifier;
    }

    public function setEventIdentifier($EventIdentifier) {
        $this->EventIdentifier = $EventIdentifier;
    }

    public function getBookableItemId() {
        return $this->BookableItemId;
    }

    public function setBookableItemId($BookableItemId) {
        $this->BookableItemId = $BookableItemId;
    }

    public function getEventScheduleId() {
        return $this->EventScheduleId;
    }

    public function setEventScheduleId($EventScheduleId) {
        $this->EventScheduleId = $EventScheduleId;
    }

    public function getCourtesy() {
        return $this->Courtesy;
    }

    public function setCourtesy($Courtesy) {
        $this->Courtesy = $Courtesy;
    }

    public function getFirstName() {
        return $this->FirstName;
    }

    public function setFirstName($FirstName) {
        $this->FirstName = $FirstName;
    }

    public function getLastName() {
        return $this->LastName;
    }

    public function setLastName($LastName) {
        $this->LastName = $LastName;
    }

    public function getPhoneNumber() {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber($PhoneNumber) {
        $this->PhoneNumber = $PhoneNumber;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function getDescription() {
        return $this->Description;
    }

    public function setDescription($Description) {
        $this->Description = $Description;
    }

//    function jsonSerialize() {
//        $data = (array) $this;
//        return $data;
//    }

}

?>
