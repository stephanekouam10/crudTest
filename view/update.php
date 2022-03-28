<?php
        require '../model/contacts.php'; 
        session_start();             
        $contacttb=isset($_SESSION['contacttbl0'])?unserialize($_SESSION['contacttbl0']):new contacts();            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Contact</h2>
                    </div>
                    <p>Please fill this form and submit to add contacts record in the database.</p>
                    <form action="../index.php?act=update" method="post" >
                        <div class="form-group <?php echo (!empty($contacttb->surname_msg)) ? 'has-error' : ''; ?>">
                            <label>Contact surname</label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $contacttb->surname; ?>">
                            <span class="help-block"><?php echo $contacttb->surname_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($contacttb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>contact Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $contacttb->name; ?> ">
                            <span class="help-block"><?php echo $contacttb->name_msg;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $contacttb->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>