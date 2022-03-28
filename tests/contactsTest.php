<?php
require ("./model/contacts.php");

use PHPUnit\Framework\TestCase;

class contactsTest extends TestCase
{
    public function testnameNOTNULL()
    {
        $contact = new contacts();
        $contact->name = "steph";
        try {
            if(empty($contact->name))
            $this->fail("Ca aurait du planter");
        } catch (Exception $ex) {
                $this->assertEquals($ex->getMessage(),"Le nom ne peut etre nul", "Saisir un nom");
        }

    }

    public function testsurnameNOTNULL()
    {
        $contact = new contacts();
        $contact->surname = "gilles";
        try {
            if(empty($contact->surname))
            $this->fail("Ca aurait du planter");
        } catch (Exception $ex) {
                $this->assertEquals($ex->getMessage(),"Le prenom ne peut etre nul", "Saisir un nom");
        }

    }

    // public function teste2e(){

    // }
}