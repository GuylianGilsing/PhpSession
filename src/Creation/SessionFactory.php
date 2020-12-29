<?php
namespace GuylianGilsing\PhpSession\Creation;

use GuylianGilsing\PhpSession\Configuration\ConfigurationInterface;

use ErrorException;
use InvalidArgumentException;
use GuylianGilsing\PhpSession\Session;

class SessionFactory implements FactoryInterface
{
    private array $configurations = [];
    private ?string $activeConfiguration = null;

    public function addConfiguration(string $key, ConfigurationInterface $configuration): void
    {
        if(isset($this->configurations[$key]))
            throw new InvalidArgumentException("Key '".$key."' is already in use.");

        $this->configurations[$key] = $configuration;

        if($this->activeConfiguration === null)
            $this->activeConfiguration = $key;
    }

    public function selectConfiguration(string $key): void
    {
        if(!isset($this->configurations[$key]))
            throw new InvalidArgumentException("Key does not exist.");

        $this->activeConfiguration = $key;
    }

    public function create(string $name, $data = null): Session
    {
        $session = new Session($name);

        if($data != null)
            $session->setData($data);

        $session->create();

        if($this->activeConfiguration === null || !isset($this->configurations[$this->activeConfiguration]))
            throw new ErrorException("No valid configuration has been specified.");

        $this->configurations[$this->activeConfiguration]->enforceRules($session);

        return $session;
    }
}
