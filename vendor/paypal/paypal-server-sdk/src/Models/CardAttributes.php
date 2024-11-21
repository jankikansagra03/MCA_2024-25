<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models;

use stdClass;

/**
 * Additional attributes associated with the use of this card.
 */
class CardAttributes implements \JsonSerializable
{
    /**
     * @var CardCustomerInformation|null
     */
    private $customer;

    /**
     * @var VaultInstructionBase|null
     */
    private $vault;

    /**
     * @var CardVerification|null
     */
    private $verification;

    /**
     * Returns Customer.
     * The details about a customer in PayPal's system of record.
     */
    public function getCustomer(): ?CardCustomerInformation
    {
        return $this->customer;
    }

    /**
     * Sets Customer.
     * The details about a customer in PayPal's system of record.
     *
     * @maps customer
     */
    public function setCustomer(?CardCustomerInformation $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * Returns Vault.
     * Basic vault instruction specification that can be extended by specific payment sources that supports
     * vaulting.
     */
    public function getVault(): ?VaultInstructionBase
    {
        return $this->vault;
    }

    /**
     * Sets Vault.
     * Basic vault instruction specification that can be extended by specific payment sources that supports
     * vaulting.
     *
     * @maps vault
     */
    public function setVault(?VaultInstructionBase $vault): void
    {
        $this->vault = $vault;
    }

    /**
     * Returns Verification.
     * The API caller can opt in to verify the card through PayPal offered verification services (e.g.
     * Smart Dollar Auth, 3DS).
     */
    public function getVerification(): ?CardVerification
    {
        return $this->verification;
    }

    /**
     * Sets Verification.
     * The API caller can opt in to verify the card through PayPal offered verification services (e.g.
     * Smart Dollar Auth, 3DS).
     *
     * @maps verification
     */
    public function setVerification(?CardVerification $verification): void
    {
        $this->verification = $verification;
    }

    /**
     * Encode this object to JSON
     *
     * @param bool $asArrayWhenEmpty Whether to serialize this model as an array whenever no fields
     *        are set. (default: false)
     *
     * @return array|stdClass
     */
    #[\ReturnTypeWillChange] // @phan-suppress-current-line PhanUndeclaredClassAttribute for (php < 8.1)
    public function jsonSerialize(bool $asArrayWhenEmpty = false)
    {
        $json = [];
        if (isset($this->customer)) {
            $json['customer']     = $this->customer;
        }
        if (isset($this->vault)) {
            $json['vault']        = $this->vault;
        }
        if (isset($this->verification)) {
            $json['verification'] = $this->verification;
        }

        return (!$asArrayWhenEmpty && empty($json)) ? new stdClass() : $json;
    }
}