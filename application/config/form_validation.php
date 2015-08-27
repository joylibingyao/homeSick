<?php 
$config = array(
   'login'=>array(       
      array(
             'field'   => 'email', 
             'label'   => 'Email', 
             'rules'   => 'required|valid_email'
          ),
       array(
             'field'   => 'password', 
             'label'   => 'Password', 
             'rules'   => 'required|min_length[8]'
          )
   ),
   'register'=>array(
      //  array(
      //        'field'   => 'name', 
      //        'label'   => 'Name', 
      //        'rules'   => 'required'
      //     ),

      //  array(
      //        'field'   => 'password', 
      //        'label'   => 'Password', 
      //        'rules'   => 'required|matches[passwordC]|min_length[8]'
      //     ),
      //  array(
      //        'field'   => 'passwordC', 
      //        'label'   => 'Password Confirmation', 
      //        'rules'   => 'required'
      //     ),   
      //  array(
      //        'field'   => 'email', 
      //        'label'   => 'Email', 
      //        'rules'   => 'required|valid_email'
      //     ),
      //  array(
      //        'field'   => 'city', 
      //        'label'   => 'City', 
      //        'rules'   => 'required'
      //     )

       )
);
 ?>