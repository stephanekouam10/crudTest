<?php
require ("./model/contacts.php");
require("./controller/contactsController.php");
require("../model/contactsModel.php");

use PHPUnit\Framework\TestCase;

class contactsTest extends TestCase
{
    
    public function testCreationContactSansText(){
        $contact = new contacts();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom et le prenom doivent être renseignés');
        try {

            $pid = $this -> objsm ->insertRecord($contact);
            if($pid>0){			
            }else{
                echo "Something is wrong..., try again.";
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function testnameNOTNULL()
    {
        $contact = new contacts();
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
        try {
            if(empty($contact->surname))
            $this->fail("Ca aurait du planter");
        } catch (Exception $ex) {
                $this->assertEquals($ex->getMessage(),"Le prenom ne peut etre nul", "Saisir un nom");
        }

    }

    public function testupdateContactInvalidId()
    {
        $contact = new contacts();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");
        //static::assertTrue($contact->updateRecord(-1, '', ''));
    }

    public function testDeleteContactInvalidId()
    {
        $contact = new contacts();
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");
        //$contact->deleteRecord('abc');
    }


    // public function teste2e(){

    // }
}