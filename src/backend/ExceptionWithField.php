<?php
class ExceptionWithField extends Exception {
    private $field;
    public function __construct($message, $field) {
        parent::__construct($message);
        $this->field = $field;
    }
    public function getField() {
        return $this->field;
    }
}
?>