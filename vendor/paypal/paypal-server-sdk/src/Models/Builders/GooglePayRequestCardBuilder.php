<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models\Builders;

use Core\Utils\CoreHelper;
use PaypalServerSdkLib\Models\Address;
use PaypalServerSdkLib\Models\GooglePayRequestCard;

/**
 * Builder for model GooglePayRequestCard
 *
 * @see GooglePayRequestCard
 */
class GooglePayRequestCardBuilder
{
    /**
     * @var GooglePayRequestCard
     */
    private $instance;

    private function __construct(GooglePayRequestCard $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Initializes a new google pay request card Builder object.
     */
    public static function init(): self
    {
        return new self(new GooglePayRequestCard());
    }

    /**
     * Sets name field.
     */
    public function name(?string $value): self
    {
        $this->instance->setName($value);
        return $this;
    }

    /**
     * Sets type field.
     */
    public function type(?string $value): self
    {
        $this->instance->setType($value);
        return $this;
    }

    /**
     * Sets brand field.
     */
    public function brand(?string $value): self
    {
        $this->instance->setBrand($value);
        return $this;
    }

    /**
     * Sets billing address field.
     */
    public function billingAddress(?Address $value): self
    {
        $this->instance->setBillingAddress($value);
        return $this;
    }

    /**
     * Initializes a new google pay request card object.
     */
    public function build(): GooglePayRequestCard
    {
        return CoreHelper::clone($this->instance);
    }
}
