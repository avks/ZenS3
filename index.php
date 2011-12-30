<?php
require("config.php");
if (!class_exists('S3')) require_once 'libs/S3.php';
$s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
$buckets_array = $s3->listBuckets();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
<title>Simple S3 Upload</title>
<script type='text/javascript' src='js/jquery-1.5.2.min.js'></script>
<script type="text/javascript" src="swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.swfobject.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type='text/javascript' src='js/application.js'></script>
<link rel='stylesheet' href='css/bootstrap-1.2.0.min.css'></link>
<link rel='stylesheet' href='css/app.styles.css'></link>
</head>
<body>
<div id='wrapper'>
<div style="z-index: 5;" class="topbar-wrapper">
    <div class="topbar">
      <div class="topbar-inner">
        <div class="container">
          <h3><a href="">ZenS3</a></h3>
		  </ul>
        </div>
      </div><!-- /topbar-inner -->
    </div><!-- /topbar -->
  </div>
  
  <!-- Upload Modal -->
	<div style="position: relative; top: auto; left: auto; margin: 0 auto; z-index: 1" class="modal">
		<form name="s3_upload_form" id="s3_upload_form" method="post" action="">
		<div class="modal-header">
			<h3>Upload to S3 <small>AJAX Upload Interface</small></h3>
			<!-- <a class="close" href="#">&times;</a> -->
		</div>
		<div class="modal-body">
			<p>You can select one file at a time to upload to S3. Reload the page to upload more files.</p>
			<div class="clearfix">
            <label for="normalSelect">Select bucket</label>
            <div class="input">
              <select name="bucket_name" id="bucket_name">
					<?php foreach($buckets_array as $bucket): ?>
						<option value="<?php echo $bucket; ?>"> <?php echo $bucket; ?> </option>
					<?php endforeach; ?>
              </select>
            </div>
          </div>
			<div class="clearfix">
				<label for="xlInput">Select File to upload</label>
				<div class="input">
					<input type="text" size="30" name="FileInput" id="FileInput" class="xlarge" disabled="disabled" value="No file selected"/>
					<span id="spanButtonPlaceholder"></span>
				</div>
          </div>
		  <div class="clearfix">
            <label id="optionsRadio">Set Permission</label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input type="radio" value="public" name="perm" checked="checked">
                    <span><strong>Public</strong> <small>Anyone can read the files.</small></span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="radio" value="private" name="perm">
                    <span><strong>Private</strong> <small>Only authenticated users can read the files. </small></span>
                  </label>
                </li>
              </ul>
            </div>
          </div>
			<div class="clearfix">
				<label for="xlInput">S3 URL</label>
				<div class="input">
					<input type="text" size="30" name="s3_url" id="s3_url" class="xlarge" value="No file selected"/>
				</div>
          </div>
		</div>
		<div class="modal-footer">
			<div class="flash" id="fsUploadProgress"></div>
			<button class="btn primary" id="s3_upload" type="submit">Upload</button>
			<a class="btn secondary reload" title="Reload the page to upload another file" href="#">Reload</a>
		</div>
		</form>
	</div>
	
	<div class="center">
		Created by <a href='http://abhisekdutta.in'>Abhisek Dutta</a> on top of Twitter's <a href='https://github.com/twitter/bootstrap'>Bootstrap</a> and <a href='https://github.com/tpyo/amazon-s3-php-class'>S3 PHP Class</a>
	</div>
</div>
</body>
</html>