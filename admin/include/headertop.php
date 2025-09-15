<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $title;?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo $link;?>/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo $link;?>/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo $link;?>/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo $link;?>/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?php echo $link;?>/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo $link;?>/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo $link;?>/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo $link;?>/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo $link;?>/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo $link;?>/images/favicon.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="<?php echo $link;?>/vendors/js/vendor.bundle.base.js"></script>
  
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo $link;?>/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="<?php echo $link;?>/vendors/chart.js/Chart.min.js"></script>
<script src="<?php echo $link;?>/vendors/select2/select2.min.js"></script>
<script src="<?php echo $link;?>/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $link;?>/vendors/progressbar.js/progressbar.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo $link;?>/js/off-canvas.js"></script>
<script src="<?php echo $link;?>/js/hoverable-collapse.js"></script>
<script src="<?php echo $link;?>/js/template.js"></script>
<script src="<?php echo $link;?>/js/settings.js"></script>
<script src="<?php echo $link;?>/js/todolist.js"></script>
<script src="<?php echo $link;?>/js/custom.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?php echo $link;?>/js/dashboard.js"></script>
<script src="<?php echo $link;?>/js/Chart.roundedBarCharts.js"></script>
<script src="<?php echo $link;?>/ckeditor/ckeditor.js"></script>



<link href="<?php echo $link;?>/css/vertical-layout-light/typeahead.css"  rel="stylesheet" />
	<link href="<?php echo $link;?>/css/vertical-layout-light/bootstrap-tagsinput.css" rel="stylesheet">

<script src="<?php echo $link;?>/js/typehead.js"></script>
<script src="<?php echo $link;?>/js/bootstrap-tagsinput.js"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
  
$(function () {
  $(".chackindate").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
        format: "yyyy-mm-dd"
  });
  
});

	var countries = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  prefetch: {
		url: '<?php echo $link;?>/data/countries.json',
		filter: function(list) {
			//alert(list);
		  return $.map(list, function(name) {
			return { name: name }; });
		}
	  }
	});
	countries.initialize();

	$('#tags-input').tagsinput({
	  typeaheadjs: {
		name: 'countries',
		displayKey: 'name',
		valueKey: 'name',
		source: countries.ttAdapter()
	  }
	});
	</script>
 
<style>
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
                                    </style>
<script>
	$(document).ready(function() {
    var config = {};
  config.placeholder = 'some value'; 
  CKEDITOR.replace('terms', {removeButtons: 'PasteFromWord', toolbar : 'Basic', uiColor : '#9AB8F3',height: 200});
  CKEDITOR.replace('privacy', {removeButtons: 'PasteFromWord', toolbar : 'Basic', uiColor : '#9AB8F3',height: 200 });
  CKEDITOR.replace('refund', {removeButtons: 'PasteFromWord', toolbar : 'Basic', uiColor : '#9AB8F3',height: 200 });
  CKEDITOR.replace('tour_desc', {removeButtons: 'PasteFromWord', toolbar : 'Basic', uiColor : '#9AB8F3',height: 200 });
                             
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;

if(filesLength>4)

{
      alert('You can uploaded 4 extra images per news');
      $("#files").val('')
      return false;
}
else
{

      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
			$('#files').val(filesLength-1);
          });
          //alert(filesLength);
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }

    }

    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>
<style>
	.twitter-typeahead { display:initial !important; }
	.bootstrap-tagsinput {line-height:40px;display:block !important;}
	.bootstrap-tagsinput .tag {background:#09F;padding:5px;border-radius:4px;}
	.tt-hint {top:2px !important;}
	.tt-input{vertical-align:baseline !important;}
	.typeahead { border: 1px solid #CCCCCC;border-radius: 4px;padding: 8px 12px;width: 300px;font-size:1.5em;}
	.tt-menu { width:300px; }
	span.twitter-typeahead .tt-suggestion {padding: 10px 20px;	border-bottom:#CCC 1px solid;cursor:pointer;}
	span.twitter-typeahead .tt-suggestion:last-child { border-bottom:0px; }
	.demo-label {font-size:1.5em;color: #686868;font-weight: 500;}
	.bgcolor {max-width: 440px;height: 200px;background-color: #c3e8cb;padding: 40px 70px;border-radius:4px;margin:20px 0px;}
	
	</style>
  
</head>