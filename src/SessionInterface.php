<?php
namespace GuylianGilsing\PhpSession;

interface SessionInterface
{
    /**
     * Getter for the name of the session.
     * 
     * @return string
     */
    public function getName() : string;

    /**
     * Sets the session data.
     * @param mixed $data The data you want to put into the session.
     * 
     * @return void
     */
    public function setData($data) : void;

    /**
     * Retrieves the data in the session.
     * 
     * @return mixed
     */
    public function getData();

    /**
     * Creates the an entry in the $_SESSION variable.
     * 
     * @return bool Returns true when the data could be stored inside a $_SESSION variable, false when it couldn't.
     */
    public function create() : bool;

    /**
     * Updates the data of the entry in the $_SESSION variable.
     * 
     * @return bool Returns true when the data could be updated inside a $_SESSION variable, false when it couldn't.
     */
    public function update() : bool;

    /**
     * Destroys the session in the $_SESSION variable.
     * 
     * @return bool Returns true when the entry in the $_SESSION variable could be unset, false when it couldn't.
     */
    public function destroy() : bool;
}
