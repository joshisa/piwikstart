<?php
# Copyright IBM 2014
# Filename: bootstrap.php
# Purpose: Populate global environment vars with Bluemix runtime values
  
$_ENV["SQLDB"] = NULL;
$_ENV["SQLHOST"] = NULL;
$_ENV["SQLPORT"] = NULL;
$_ENV["SQLUSER"] = NULL;
$_ENV["SQLPASSWORD"] = NULL;
$_ENV["MAILUSER"] = NULL;
$_ENV["MAILPASSWORD"] = NULL;
$_ENV["MAILHOST"] = NULL;
$_ENV["SMSACCOUNT"] = NULL;
$_ENV["SMSTOKEN"] = NULL;
$_ENV["SMSURL"] = NULL;
$_ENV["REDISHOSTNAME"] = NULL;
$_ENV["REDISPASSWORD"] = NULL;
$_ENV["REDISPORT"] = NULL;
 
$application = getenv("VCAP_APPLICATION");
$application_json = json_decode($application,true);
if (isset($application_json["application_uris"])) {
  $_ENV["APPURIS"] = $application_json["application_uris"];
}
  
$services = getenv("VCAP_SERVICES");
$services_json = json_decode($services,true);
if (isset($services_json)) {
    if (isset($services_json["mysql-5.5"][0]["credentials"])) {
        $mysql_config = $services_json["mysql-5.5"][0]["credentials"];
        $_ENV["SQLDB"] = $mysql_config["name"];
        $_ENV["SQLHOST"] = $mysql_config["host"];
        $_ENV["SQLPORT"] = $mysql_config["port"];
        $_ENV["SQLUSER"] = $mysql_config["user"];
        $_ENV["SQLPASSWORD"] = $mysql_config["password"];
    }
 
    if (isset($services_json["cleardb"][0]["credentials"])) {
        $mysql_config = $services_json["cleardb"][0]["credentials"];
        $_ENV["SQLDB"] = $mysql_config["name"];
        $_ENV["SQLHOST"] = $mysql_config["hostname"];
        $_ENV["SQLPORT"] = $mysql_config["port"];
        $_ENV["SQLUSER"] = $mysql_config["username"];
        $_ENV["SQLPASSWORD"] = $mysql_config["password"];
    }
      
    if (isset($services_json["rediscloud"][0]["credentials"])) {
        $redis_config = $services_json["rediscloud"][0]["credentials"];
        $_ENV["REDISHOSTNAME"] = $redis_config["hostname"];
        $_ENV["REDISPASSWORD"] = $redis_config["password"];
        $_ENV["REDISPORT"] = $redis_config["port"];
    }
  
    if (isset($services_json["compose-for-redis"][0]["credentials"])) {
        $redis_config = $services_json["compose-for-redis"][0]["credentials"];
        uri = parse_url($redis_config["uri"]);
        $_ENV["REDISHOSTNAME"] = uri['host'];
        $_ENV["REDISPASSWORD"] = uri["pass"];
        $_ENV["REDISPORT"] = uri["port"];
    }

    if (isset($services_json["sendgrid"][0]["credentials"])) {
        $sendgrid_config = $services_json["sendgrid"][0]["credentials"];
        $_ENV["MAILUSER"] = $sendgrid_config["username"];
        $_ENV["MAILPASSWORD"] = $sendgrid_config["password"];
        $_ENV["MAILHOST"] = $sendgrid_config["hostname"];
    }
 
    if (isset($services_json["user-provided"][0]["credentials"])) {
        $twilio_config = $services_json["user-provided"][0]["credentials"];
        $_ENV["SMSACCOUNT"] = $twilio_config["accountSID"];
        $_ENV["SMSTOKEN"] = $twilio_config["authToken"];
    }
}
?>
