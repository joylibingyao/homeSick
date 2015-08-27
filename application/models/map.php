<?php
class Map extends CI_Model {

     function add_user($userinfo)
     {
        if (!empty($this->get_locationID($userinfo['city']))) {
            $location_id=$this->get_locationID($userinfo['city'])['id'];//location exists

        }else{
            $this->add_location($userinfo);
           $location_id=$this->get_locationID($userinfo['city'])['id'];//added location
            //var_dump($location_id);
           

        }//we have location_id

        $query = "INSERT INTO users (name, email, password, location_id, created_at, updated_at ) VALUES (?,?,?,?,?,?)";
         $values = array($userinfo['name'], $userinfo['email'], $userinfo['password'], $location_id,
            date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
         return $this->db->query($query, $values);
     }
     public function get_all_comment()
     {
        return $this->db->query("SELECT comments.*,users.name from comments left join users on users.id=comments.user_id")->result_array();
     }
     public function get_user_by_email($email)
     {
        return $this->db->query("SELECT * from users where email='$email'")->row_array();
     }
     function get_all_users()
     {
         return $this->db->query("SELECT users.*,locations.city from locations left join users on users.location_id=locations.id;")->result_array();
     }
     function get_user_by_id($user_id)
     {
 
         return $this->db->query("SELECT * FROM users WHERE id = $user_id")->result_array();
     }
     function get_locationID($city)
     {
        $query = "select id from locations where city='$city'";
        return $this->db->query($query)->row_array();
     }
     function add_location($array)
     {
        $lat = $array['lat'];
        $long = $array['lng'];
        $city = $array['city'];
        $url=$array['url'];
 
        $query = "insert into locations (city, lng, lat,url) values ('$city','$lat','$long','$url')";
       $this->db->query($query);
     }
 
    function get_all_location()
     {
         return $this->db->query("SELECT * FROM locations")->result_array();
     }
    
    function add_comment($comment)
    {
        $query = "insert into comments (comment,user_id,location_id) values ('{$comment['comment']}','{$comment['user_id']}','{$comment['location_id']}')";
       $this->db->query($query);
    }
   
}
 
 
 
 
 
 ?>