<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <meta name="description" content="">
    <?php $foundation_path = ""; ?>
    <link rel="stylesheet" href="<?php echo $foundation_path; ?>/foundation-6/css/foundation.css" />
    <link rel="stylesheet" href="<?php echo $foundation_path; ?>/foundation-6/css/app.css" />
  </head>
  <body>

  <div class="row">
  <div class="large-12 columns">

  <?php if( isset($_POST['file_uploaded']) ) { ?>

    <?php

    $target_dir = "output/";
    $target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
    $upload_file = "";

    # upload file to output directory
      if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {

        # alert
        echo 'The file ' . basename( $_FILES["uploadFile"]["name"]) . ' has been uploaded.';

        # open file and read data
        $file_handle = fopen($target_dir, 'r');
        while (!feof($file_handle) ) {
            $csv_data[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);

        $current_line = 1;

        # go through each line
        foreach($csv_data as $data) {

          echo $current_line . '<br>';

          # daily stats
          if ($current_line == 7) {
            $date = $data[0];
            $impressions = $data[3];
            echo $date . ' ' . $impressions . '<br>';
          }          

          # posts
          if ($current_line > 27) {
            $time = $data[1];
            $text = $data[3];
            echo $time . ' ' . $text . '<br>';
          }

          $current_line++;

        }

      } else {
          echo 'Sorry, there was an error uploading your file.';
      }

    ?>

  <?php } else { ?>

    <form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

      <strong>Upload Facebook</strong>

      <br><br>

      Choose CSV file to upload:

      <br><br>

      <div style="width:400px;background-color:#eee;padding:15px;"><input type="file" name="uploadFile" style="padding:0;margin:0;"></div>

      <br><br>

      <input type="submit" value="Upload File" class="button">

      <input type="hidden" value="yes" name="file_uploaded" id="file_uploaded">

    </form>

  <?php } ?>

    </div>
    </div>

    <!-- foundation js -->
    <script src="<?php echo $foundation_path; ?>/foundation-6/js/vendor/jquery.min.js"></script>
    <script src="<?php echo $foundation_path; ?>/foundation-6/js/vendor/what-input.min.js"></script>
    <script src="<?php echo $foundation_path; ?>/foundation-6/js/foundation.min.js"></script>
    <script src="<?php echo $foundation_path; ?>/foundation-6/js/app.js"></script>

    <script>
    $( document ).ready(function() {


    });
    </script>


  </body>
</html>
