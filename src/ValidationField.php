<?php
/**
 * @author Todd Burry <todd@vanillaforums.com>
 * @copyright 2009-2017 Vanilla Forums Inc.
 * @license Proprietary
 */

namespace Garden\Schema;

/**
 * A parameters class for field validation.
 */
class ValidationField {
    /**
     * @var array|Schema
     */
    private $field;

    /**
     * @var Validation
     */
    private $validation;

    /**
     * @var string
     */
    private $name;

    /**
     * Construct a new {@link ValidationField} object.
     *
     * @param Validation $validation The validation object that contains errors.
     * @param array|Schema $field The field definition.
     * @param string $name The path to the field.
     */
    public function __construct(Validation $validation, $field, $name) {
        $this->field = $field;
        $this->validation = $validation;
        $this->name = $name;
    }

    /**
     * Add a validation error.
     *
     * @param string $error The message code.
     * @param int|array $options An array of additional information to add to the error entry or a numeric error code.
     * @return $this
     * @see Validation::addError()
     */
    public function addError($error, array $options = []) {
        $this->validation->addError($this->field, $error, $options);
        return $this;
    }

    /**
     * Check whether or not this field is has errors.
     *
     * @return bool Returns true if the field has no errors, false otherwise.
     */
    public function isValid() {
        return $this->validation->isValidField($this->field);
    }

    /**
     * Merge a validation object to this one.
     *
     * @param Validation $validation The validation object to merge.
     * @return $this
     */
    public function merge(Validation $validation) {
        $this->getValidation()->merge($validation, $this->getName());
        return $this;
    }

    /**
     * Get the field.
     *
     * @return array|Schema Returns the field.
     */
    public function getField() {
        return $this->field;
    }

    /**
     * Set the field.
     *
     * @param array|Schema $field The new field.
     * @return $this
     */
    public function setField($field) {
        $this->field = $field;
        return $this;
    }

    /**
     * Get the validation.
     *
     * @return Validation Returns the validation.
     */
    public function getValidation() {
        return $this->validation;
    }

    /**
     * Get the name.
     *
     * @return string Returns the name.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the name.
     *
     * @param string $name The new name.
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the field type.
     *
     * @return string|null Returns a type string or null if there isn't one.
     */
    public function getType() {
        return isset($this->field['type']) ? $this->field['type'] : null;
    }
}
