<?php
namespace GuylianGilsing\PhpSession;

use Exception;

abstract class AbstractSession implements SessionInterface
{
    protected string $name = "";
    protected array $data = [
        '_data' => []
    ];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setData($data) : void
    {
        if(!is_array($data))
        {
            if(count($this->data['_data']) > 0)
            {
                $this->data['_data'][0] = $data;
            }
            else
            {
                $this->data['_data'][] = $data;
            }
        }
        else
        {
            $this->data['_data'] = $data;
        }
    }

    public function getData()
    {
        if(count($this->data['_data']) == 1)
            return $this->data['_data'][0];

        return $this->data['_data'];
    }

    public function create() : bool
    {
        if(isset($_SESSION[$this->name]))
        {
            throw new Exception("Session with name: '".$this->name."' already exists.");
            return false;   
        }
        
        $this->updateData();

        return true;
    }

    public function update() : bool
    {
        if(!isset($_SESSION[$this->name]))
        {
            $this->throwSessionNotExistException();
            return false;
        }

        $this->updateData();

        return true;
    }

    public function destroy() : bool
    {
        if(!isset($_SESSION[$this->name]))
        {
            $this->throwSessionNotExistException();
            return false;
        }

        unset($_SESSION[$this->name]);

        return true;
    }

    private function updateData()
    {
        $_SESSION[$this->name]['_data'] = $this->data['_data'];
    }

    private function throwSessionNotExistException()
    {
        throw new Exception("Session with name: '".$this->name."' does not exist.");
    }
}
