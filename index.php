<form method="POST" enctype="multipart/form-data">
<input type="text" name="filename" placeholder="Please choose file name for PDF">
<input type="file" name="file">
<button type="submit" name="submit">Upload File</button>
</form>
<?php
if(isset($_FILES['file'])){
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      $file_ext = explode('.',$_FILES['file']['name']);
      $file_ext = end($file_ext);
      $file_ext=strtolower($file_ext);

	  //Specify the file type to upload	
      $expensions= array("pdf");

      if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a PDF file.";
      }

	  //Specify the file size	
      if($file_size > 51200){
         $errors[]='File size must be less than 5 MB';
      }

      if(empty($errors)==true){
		 $key1=rand(); //random key generator
		 $date=date('Y-m-d H:i:s'); // to get when the file is uploaded.
	 
		//Specify the value of filename using POST,GET or SESSION Method.
		//Here i am using Post method to achieve 
			$fname = $_POST['filename'];
		
			
		//The name of the directory that we need to create.
		$directoryName = "Folder_name/".$fname."_userid_".$key1;


	//$fpath = "upload/".$usern."_userid_".$id;
	$npath = $fname."/$fname.$key1"; //folder name path
	$path = $directoryName."/$key1.pdf"; // filename path



	//Check if the directory already exists.
	if(!is_dir($directoryName)){
    
	 //Directory does not exist, so lets create it.
		mkdir($directoryName, 0755);
	}

	    //Move uploaded files here
		move_uploaded_file($file_tmp,$path);
		$actualpath = "http://localhost/uploadpdftest/".$path;


		$PDFfile= $actualpath;
		//Once upload is done you can insert this path to your MYSQL Table.
		echo "Click <a href='".$PDFfile."'>here</a> to see uploaded file.";
      }else{
         print_r($errors);
      }
   }

   ?>
