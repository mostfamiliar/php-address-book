<?php
  class Contact {
    private $name;
    private $number;
    private $address;

  function __construct($name, $number, $address) {
    $this->name = $name;
    $this->number = $number;
    $this->address = $address;
  }

  function getName($new_name) {
    $this->name = $new_name;
  }

  function getNumber($new_number) {
    $this->number = $new_number;
  }

  function getAddress($new_address) {
    $this->address = $new_address;
  }

  function setName() {
    return $this->name;
  }

  function setNumber() {
    return $this->number;
  }

  function setAddress() {
    return $this->address;
  }

  function saveAddress() {
    array_push($_SESSION['list_of_addresses'], $this);
  }
}
 ?>
