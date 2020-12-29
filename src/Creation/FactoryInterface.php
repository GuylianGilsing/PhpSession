<?php
namespace GuylianGilsing\PhpSession\Creation;

use GuylianGilsing\PhpSession\Configuration\ConfigurationInterface;

use GuylianGilsing\PhpSession\Session;

interface FactoryInterface
{
    /**
     * Adds a single configuration to the factory.
     * 
     * @param string $key The key of the configuration.
     * @param \GuylianGilsing\PhpSession\Configuration\ConfigurationInterface $configuration A valid configuration class.
     * @return void
     */
    public function addConfiguration(string $key, ConfigurationInterface $configuration) : void;

    /**
     * Selects a specific configuration to use when a new session has been created.
     * 
     * @param string $key The key of the configuration.
     * @return void
     */
    public function selectConfiguration(string $key) : void;

    /**
     * Creates a new session with enforced configuration rules.
     * 
     * @return \GuylianGilsing\PhpSession\Session
     */
    public function create(string $name, $data = null) : Session;
}
