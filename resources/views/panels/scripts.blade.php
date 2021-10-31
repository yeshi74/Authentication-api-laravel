<script src="{{ asset('public/vendors/js/ui/prism.min.js') }}"></script>
@yield('vendor-script')
<script src="{{ asset('public/js/core/app-menu.js') }}"></script>
<script src="{{ asset('public/js/core/app.js') }}"></script>
<script src="{{ asset('public/js/scripts/components.js') }}"></script>
<script src="{{ asset('public/js/scripts/jquery.validationEngine.js') }}"></script>
<script src="{{ asset('public/js/scripts/jquery.validationEngine-en.js') }}"></script>
<script src="{{ asset('public/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('public/js/scripts/forms/select/form-select2.js') }}"></script>
<script src="{{ asset('public/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('public/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{ asset('public/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('public/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
<script src="{{ asset('public/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/scripts/jszip.min.js') }}"></script>
<script src="{{ asset('public/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/js/scripts/datatables/datatable.js') }}"></script>
<script src="{{ asset('public/vendors/summernote/summernote-lite.min.js') }}"></script>
<script src="{{ asset('public/vendors/hummingbird/hummingbird-treeview.js') }}"></script>
<script src="{{ asset('public/vendors/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('public/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('public/vendors/chartjs/utils.js') }}"></script>
<script>
    $(window).on("load", function() {
    setTimeout(function() {
      $(".row.match-height").each(function() {
        $(this)
          .find(".card")
          .not(".card .card")
          .matchHeight(); // Not .card .card prevents collapsible cards from taking height
      });
    }, 700);
    $(".colorbox").colorbox({rel:'colorbox'});
});
    var curpage = "{{Route::currentRouteName() }}";
    var favURL = "{{url('admin/favorites/')}}";
    	$(document).ready(function(){
    		$(".frmValidate").validationEngine({promptPosition : "bottomLeft"});
            $('body').on('click', 'a#addfavorites', function() {
                var optid = $(this).data("id");
                var pURL = favURL + "/addFavorites/"+optid;
                $.get(pURL,
                    function(data, status){
                        showFavorites();
                    });
            });
            $('body').on('click', 'a#delfavorites', function() {
                var optid = $(this).data("id");
                var pURL = favURL + "/delFavorites/"+optid;
                $.get(pURL,
                    function(data, status){
                        showFavorites();
                    });
            });
                $('.htmlEditor').summernote();
                
    	});
        function showFavorites()
        {
          //  alert(curpage);
            $("#divFavorites").load(favURL + '/getFavorites/' + curpage);
        }
    </script>
<script>
var imgSize=0;
$('.uploadImage').bind('change', function() {
    imgSize = this.files[0].size;
  });
$("#btnAddAlbum").on('click',function(){
     $("#addGallery").show();
  });
$("form#frmUploadFiles").submit(function(e) {
    e.preventDefault();  
    if(imgSize  > maxFileLimit)
    {
      alert("Invalid Image Size");
      event.preventDefault();  
    }
    else
    {
        var b = true;
        if(_checkExtension == 0) b=validateFileExtension(this);
        if(b==true){
            var formData = new FormData(this);
            var uURL = "{{url('admin/file/save')}}";
            $.ajax({
                url: uURL,
                type: 'POST',
                data: formData,
                success: function (data) {
                    if(data.status == "SUCCESS"){
                        $("#divGallery").append(data.html);
                        $("#frmUploadFiles").trigger("reset");
                        $("#addGallery").hide();
                        $("#frmUploadFiles")[0].reset();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    }
});
function validateFileExtension(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, Allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}
$(document).on("click",".lnkDeleteGallery", function(){
    var id = $(this).data("id");
    if(confirm("Are you sure you want to delete this file?")){
        $("#hdfFileID").val(id);
        var formData = $("#frmDeleteGalleryFile").serialize();
        var uURL = "{{url('admin/file/delete')}}";
        $.ajax({
                url: uURL,
                type: 'POST',
                data: formData,
                success: function (data) {
                    if(data  == "SUCCESS"){
                        $("#divGallery" + id).hide();

                    }
                }
            });
    }
    
});
$(document).on("click",".lnkOrderGalleryUp", function(){
    var id = $(this).data("id");
    var uURL = "{{url('admin/file/up/')}}";
    $.ajax({
        url: uURL + "/" + id,
        type: 'GET',
        success: function (data) {
            $("#sectionGallery").html(data);
        }
    });
});
$(document).on("click",".lnkOrderGalleryDown", function(){
    var id = $(this).data("id");
    var uURL = "{{url('admin/file/down/')}}";
    $.ajax({
        url: uURL + "/" + id,
        type: 'GET',
        success: function (data) {
            $("#sectionGallery").html(data);
        }
    });
});
</script>