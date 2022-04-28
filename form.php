<?php
/**
 * @package Example_plugin
 * @version 1.0.0
 */
/*
Plugin Name: form plugin
Description: This is my description.
Author: nada bouyahya
Version: 1.0.0
*/

?>
<head>
    <title>contact form plugin</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }
        * {
            box-sizing: border-box !important;
        }
        input[type=text], select, textarea {
            width: 100% !important;
            padding: 12px !important;
            border: 1px solid #ccc !important;
            border-radius: 4px !important;
            box-sizing: border-box !important;
            margin-top: 6px !important;
            margin-bottom: 16px !important;
            resize: vertical !important;
        }
        input[type=submit] {
            background-color: #04AA6D !important;
            color: white !important;
            padding: 12px 20px !important;
            border: none !important;
            border-radius: 4px !important;
            cursor: pointer !important;
        }
        input[type=submit]:hover {
            background-color: #45a049 !important;
        }
        .container {
            border-radius: 5px !important;
            background-color: #f2f2f2 !important;
            padding: 20px !important;
        }

    </style>
</head>
<?php

// AFFICHER LA PAGE DE REGLAGES AU DASHBOARD ADMIN
function my_setup_page(){
    add_menu_page( 'Setup Form', 'Form Setup', 'manage_options', 'test-plugin','wp_setup_func',1 );
}
add_action('admin_menu', 'my_setup_page');


function wp_setup_func(){
    $fname_check = "";
    $lname_check = "";
    $email_check = "";
    $message_check = "";
    if(get_option('fname')){
        $fname_check = "checked";
    }
    if(get_option('lname')){
        $lname_check = "checked";
    }
    if(get_option('email')){
        $email_check = "checked";
    }
    if(get_option('message')){
        $message_check = "checked";
    }
    echo '
        <form method="POST" action="">
                <div style="display:flex; flex-direction: column; align-items: flex-start">
                    <Label><input type="checkbox" name="fname" '. $fname_check .'>First Name</Label>
                    <Label><input type="checkbox" name="lname" '. $lname_check .'>Last Name</Label>
                    <Label><input type="checkbox" name="email" '. $email_check .'>Email</Label>
                    <Label><input type="checkbox" name="message" '. $message_check .'>Message</Label>
                    <input type="submit" name="submit_btn">
                </div>
        </form>';

        
}

if(isset($_POST["submit_btn"])){
    $list["fname"] = 0;
    $list["lname"] = 0;
    $list["email"] = 0;
    $list["message"] = 0;
    if(isset($_POST["fname"])){
        $list["fname"] = 1;
        
    }
    if(isset($_POST["lname"])){
        $list["lname"] = 1;
        
    }
    if(isset($_POST["email"])){
        $list["email"] = 1;
        
    }
    if(isset($_POST["message"])){
        $list["message"] = 1;

    }

    update_option('fname', $list["fname"]);
    update_option('lname', $list["lname"]);
    update_option('email', $list["email"]);
    update_option('message', $list["message"]);

    echo '<div style="margin-left:160px;" class = "updated"> 
    The operation was completed successfully!!!!
    </div>'; 
}


// Form
function add_form(){
    $form_added = false;
    echo "
        <div class='container'>
        <form action='' method='POST'>
    ";
    if(get_option("fname")){
        echo '<label>First Name<input type="text"></label>';
        $form_added = true;
    }
    if(get_option("lname")){
        echo '<label>Last Name<input type="text"></label>';
        $form_added = true;
    }
    if(get_option("email")){
        echo '<label>Email<input type="text"></label>';
        $form_added = true;
    }
    if(get_option("message")){
        echo '<label>Message:<textarea name="message" cols="30" rows="10"></textarea></label>';
        $form_added = true;
    }
    if($form_added){
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="Submit">';
    }
    echo "
        </form>
        </div>
    ";
}
add_shortcode('inputs','add_form');
?>


<!-- <form class="form" action="" method="$_POST">
    <input name="f_name" type="text">
    <input name="l_name" type="text">
    <input name="email" type="text">
    <textarea name="message" id="" cols="30" rows="10"></textarea>
    <input name="submit" type="submit" value=""></input>
</form> -->

<!-- <style>
    .form{display: flex;
        flex-direction: column;
        /* width: 70%; */
        align-items: center;
        }
    
    input{
        margin-top: 20px;
    } -->

<!-- </style> -->