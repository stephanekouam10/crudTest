<?php
    require 'model/contactsModel.php';
    require 'model/contacts.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class contactsController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new contactsModel($this->objconfig);
		}

        // close database
		public function close_db()
		{
			$this->condb->close();
		}	

        // mvc handler request
		public function mvcHandler() 
		{
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                case 'add' :                    
					$this->insert();
					break;						
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;								
				default:
                    $this->list();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // check validation
		public function checkValidation($contacttb)
        {    $noerror=true;
            // Validate surname        
            if(empty($contacttb->surname)){
                $contacttb->surname_msg = "Field is empty.";$noerror=false;
            } elseif(!filter_var($contacttb->surname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $contacttb->surname_msg = "Invalid entry.";$noerror=false;
            }else{$contacttb->surname_msg ="";}            
            // Validate name            
            if(empty($contacttb->name)){
                $contacttb->name_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($contacttb->name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $contacttb->name_msg = "Invalid entry.";$noerror=false;
            }else{$contacttb->name_msg ="";}
            return $noerror;
        }
        // add new record
		public function insert()
		{
            try{
                $contacttb=new contacts();
                if (isset($_POST['addbtn'])) 
                {   
                    // read form value
                    $contacttb->surname = trim($_POST['surname']);
                    $contacttb->name = trim($_POST['name']);
                    //call validation
                    $chk=$this->checkValidation($contacttb);                    
                    if($chk)
                    {   
                        //call insert record            
                        $pid = $this -> objsm ->insertRecord($contacttb);
                        if($pid>0){			
                            $this->list();
                        }else{
                            echo "Somthing is wrong..., try again.";
                        }
                    }else
                    {    
                        $_SESSION['contacttbl0']=serialize($contacttb);//add session obj           
                        $this->pageRedirect("view/insert.php");                
                    }
                }
            }catch (Exception $e) 
            {
                $this->close_db();	
                throw $e;
            }
        }
        // update record
        public function update()
		{
            try
            {
                
                if (isset($_POST['updatebtn'])) 
                {
                    $contacttb=unserialize($_SESSION['contacttbl0']);
                    $contacttb->id = trim($_POST['id']);
                    $contacttb->surname = trim($_POST['surname']);
                    $contacttb->name = trim($_POST['name']);                    
                    // check validation  
                    $chk=$this->checkValidation($contacttb);
                    if($chk)
                    {
                        $res = $this -> objsm ->updateRecord($contacttb);	                        
                        if($res){			
                            $this->list();                           
                        }else{
                            echo "Somthing is wrong..., try again.";
                        }
                    }else
                    {         
                        $_SESSION['contacttbl0']=serialize($contacttb);      
                        $this->pageRedirect("view/update.php");                
                    }
                }elseif(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
                    $id=$_GET['id'];
                    $result=$this->objsm->selectRecord($id);
                    $row=mysqli_fetch_array($result);  
                    $contacttb=new contacts();                  
                    $contacttb->id=$row["id"];
                    $contacttb->name=$row["name"];
                    $contacttb->surname=$row["surname"];
                    $_SESSION['contacttbl0']=serialize($contacttb);
                    $this->pageRedirect('view/update.php');
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->close_db();				
                throw $e;
            }
        }
        // delete record
        public function delete()
		{
            try
            {
                if (isset($_GET['id'])) 
                {
                    $id=$_GET['id'];
                    $res=$this->objsm->deleteRecord($id);                
                    if($res){
                        $this->pageRedirect('index.php');
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->close_db();				
                throw $e;
            }
        }
        public function list(){
            $result=$this->objsm->selectRecord(0);
            include "view/list.php";                                        
        }
    }
		
	
?>