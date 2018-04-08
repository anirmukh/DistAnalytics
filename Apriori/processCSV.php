<?php
/*
Change the following values in php.ini and restart apache to support large post file upload.
Better to go for file chunking for reliability.

memory_limit = 256M
upload_max_filesize = 500M
post_max_size = 500M

*/

$target_dir = "./";
$target_file = $target_dir . "Online Retail.csv";
if(isset($_POST["csv_upload"])) {
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //file has been uploaded, processing further request
        //trying to remove already uploaded csv file if present
        shell_exec("rm Online Retail.csv");
        //running the R code from command line
        shell_exec("Rscript AprioriR.R");
        //running the java code to generate frequent.txt file
        $res = shell_exec("java Main 2>&1");
        session_start();
        //storing the results in a session variable named frequent items
        header('Location: ../SourceCodes/HW/sample_kpi14.php?done=1');
    }else{
        echo "Sorry, there was an error uploading your file.";
    }
}
?>