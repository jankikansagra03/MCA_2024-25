<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Logging;

use PaypalServerSdkLib\ConfigurationDefaults;
use Core\Logger\Configuration\RequestConfiguration;
use Core\Utils\CoreHelper;

class RequestLoggingConfigurationBuilder
{
    private $includeQueryInPath = ConfigurationDefaults::LOGGER_INCLUDE_QUERY_IN_PATH;
    private $body = ConfigurationDefaults::LOGGER_LOG_BODY;
    private $headers = ConfigurationDefaults::LOGGER_LOG_HEADERS;
    private $includeHeaders = ConfigurationDefaults::LOGGER_INCLUDE_HEADERS;
    private $excludeHeaders = ConfigurationDefaults::LOGGER_EXCLUDE_HEADERS;
    private $unmaskHeaders = ConfigurationDefaults::LOGGER_UNMASK_HEADERS;

    /**
     * Initializer for RequestLoggingConfigurationBuilder.
     */
    public static function init(): self
    {
        return new self();
    }

    public function includeQueryInPath(bool $includeQueryInPath): self
    {
        $this->includeQueryInPath = $includeQueryInPath;
        return $this;
    }

    public function body(bool $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function headers(bool $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    public function includeHeaders(string ...$includeHeaders): self
    {
        $this->includeHeaders = $includeHeaders;
        return $this;
    }

    public function excludeHeaders(string ...$excludeHeaders): self
    {
        $this->excludeHeaders = $excludeHeaders;
        return $this;
    }

    public function unmaskHeaders(string ...$unmaskHeaders): self
    {
        $this->unmaskHeaders = $unmaskHeaders;
        return $this;
    }

    public function getConfiguration(): array
    {
        return [
            'includeQueryInPath' => $this->includeQueryInPath,
            'body' => $this->body,
            'headers' => $this->headers,
            'includeHeaders' => CoreHelper::clone($this->includeHeaders),
            'excludeHeaders' => CoreHelper::clone($this->excludeHeaders),
            'unmaskHeaders' => CoreHelper::clone($this->unmaskHeaders)
        ];
    }

    public function build(): RequestConfiguration
    {
        return new RequestConfiguration(
            $this->includeQueryInPath,
            $this->body,
            $this->headers,
            $this->includeHeaders,
            $this->excludeHeaders,
            $this->unmaskHeaders
        );
    }
}