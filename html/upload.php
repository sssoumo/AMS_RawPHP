<?php

if(isset($_POST["submit"])) {
$allowedExts = array("pdf", "doc", "docx","txt", "gif", "jpeg", "jpg", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if (($_FILES["file"]["type"] == "application/pdf")|| ($_FILES["file"]["type"] == "text/plain") ||($_FILES["file"]["type"] == "application/msword") || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/png")&& ($_FILES["file"]["size"] < 20000000) && in_array($extension, $allowedExts))
{
  if ($_FILES["file"]["error"] > 0)
  {
     echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  }
  else
  {
   echo "Upload: " . $_FILES["file"]["name"] . "<br>";
echo "Type: " . $_FILES["file"]["type"] . "<br>";
echo "Size: " . ($_FILES["file"]["size"] / 200000) . " kB<br>";
echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
  }
  if (file_exists("upload/" . $_FILES["file"]["name"]))
  {
  echo $_FILES["file"]["name"] . " already exists. ";
  }
else
  {
  move_uploaded_file($_FILES["file"]["tmp_name"],
  "upload/" . $_FILES["file"]["name"]);
  echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
  }
 

}

else
{
echo "Invalid file";
 }
}
?>
<html>
    <head>
<!--       <title>Dr Nancy</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">     
       
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/style1.css" type="text/css">
       <link rel="stylesheet" href="css/style2.css" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
        
        <style>
         body {

        height: 100%;
        background-color: #b2dba1;
        margin: 10px;
        text-align: center;
        font-family: verdana;
    }
        </style>
    </head>
    <body>  
    </body>
</html>