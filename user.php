<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samarth
 * Date: 24/6/14
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */

//namespace User;

require_once('database.php');
class user {

    var $id = 0;
    var $id_str = 0;
    var $name = '';
    var $screen_name = '';
    var $location = '';
    var $description = '';
    var $followers_count = 0;
    var $friends_count = 0;
    var $listed_count = 0;
    var $created_at = 0;
    var $access_token = '';
    var $favourites_count = 0;
    var $verified = '';
    var $geo_enabled = 0;
    var $statuses_count = 0;
    var $lang = '';

    function Create(){
        if($this->id_str == ''){return false;}
        if($this->name == ''){return false;}
        //if($this->access_token == ''){return false;}
        if($this->screen_name == ''){return false;}
        //echo "checking";
        if(!user_exists($this->screen_name)){
            $add_user = "INSERT IGNORE INTO tw_user (id_str,name,screen_name,location,description,followers_count,friends_count,listed_count,created_at,access_token,favourites_count,verified,geo_enabled,status_count,lang) VALUES (".$this->id_str.",'".$this->name."','".$this->screen_name."','".$this->location."','".$this->description."',".$this->followers_count.",".$this->friends_count.",".$this->listed_count.",'".$this->created_at."','".$this->access_token."',".$this->favourites_count.",'".$this->verified."',".$this->geo_enabled.",".$this->statuses_count.",'".$this->lang."')";
            //echo $add_user;
            //user_exists($this->screen_name);
            dbQuery($add_user);
            return true;
        }
        else{
            $update_user = "UPDATE `tw_user` SET name='".$this->name."',location = '".$this->location."',description = '".$this->description."',followers_count = '".$this->followers_count."',friends_count = '".$this->friends_count."',listed_count = '".$this->listed_count."',favourites_count = '".$this->favourites_count."',status_count = ".$this->statuses_count." WHERE id_str = ".$this->id_str."";
            //echo $update_user;
            dbQuery($update_user);
            echo "User already exists";
        }


    }

    function read(){
        echo "hello";
        /*if($this->id > 0){
            $where = "id = '".$this->id."'";
        }*/
        if(!empty($this->screen_name)){
            $where = "screen_name = '".escape($this->screen_name)."'";
        }
        if(!empty($where)){
            //echo "me";
            $sql = "SELECT * FROM `tw_user` WHERE ".$where."";
            //echo $sql;
            $result = dbQuery($sql);
            $result1 = dbFetchArray($result) or die(mysql_error());
            print_r($result1);
        }

    }

}