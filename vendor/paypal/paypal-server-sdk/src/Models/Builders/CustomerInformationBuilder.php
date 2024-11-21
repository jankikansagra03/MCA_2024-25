<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models\Builders;

use Core\Utils\CoreHelper;
use PaypalServerSdkLib\Models\CustomerInformation;
use PaypalServerSdkLib\Models\PhoneWithType;

/**
 * Builder for model CustomerInformation
 *
 * @see CustomerInformation
 */
class CustomerInformationBuilder
{
    /**
     * @var CustomerInformation
     */
    private $instance;

    private function __construct(CustomerInformation $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Initializes a new customer information Builder object.
     */
    public static function init(): self
    {
        return new self(new CustomerInformation());
    }

    /**
     * Sets id field.
     */
    public function id(?string $value): self
    {
        $this->instance->setId($value);
        return $this;
    }

    /**
     * Sets email address field.
     */
    public function emailAddress(?string $value): self
    {
        $this->instance->setEmailAddress($value);
        return $this;
    }

    /**
     * Sets phone field.
     */
    public function phone(?PhoneWithType $value): self
    {
        $this->instance->setPhone($value);
        return $this;
    }

    /**
     * Initializes a new customer information object.
     */
    public function build(): CustomerInformation
    {
        return CoreHelper::clone($this->instance);
    }
}
