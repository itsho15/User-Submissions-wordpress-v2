jQuery(document).ready(function($) {

    $('#radioBtn a').on('click', function(){
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
       
        $('.'+tog).val(sel);
        
        $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    });

    $(document).on('click','.Edit_data',function(){
      var target = $(this).data('target');
       $('#'+target).modal('show');
    });
    
    $(document).on('click','.approve_data',function(){
      var target = $(this).data('target');
       $('#'+target).modal('show');
    });

    $(document).on('click','.delDoc',function(event){
      event.preventDefault();

      var getId = $(this).data('id');
       $('input[name="docId"]').val(getId);
       $( "#deletedoc" ).submit();
    });

    $(document).on('click','.view_data',function(){
        var target = $(this).data('target');
       $('#'+target).modal('show');
    });
    
     $('select[name="type"]').on('change',function(){
          
           if( $(this).val()=="journal")
           {
                $('.event').hide();
                $('.training').hide();

                $('.event').removeClass('show');
                $('.training').removeClass('show');

                $('.journal').show();
                
           }

           if($(this).val()=="event")
           {
                $('.journal').hide();
                $('.training').hide();

                $('.journal').removeClass('show');
                $('.training').removeClass('show');

                $('.event').show();
               
           }

           if($(this).val()=="training")
           {
                $('.event').hide();
                $('.journal').hide();

                $('.journal').removeClass('show');
                $('.event').removeClass('show');

                $('.training').show();  
           }

    });

     /*
    check all
    */
    $("#checkAll").click(function () {
         $('.item_checkbox').prop('checked', this.checked);
        
    });

    /*
    delete all
    */
    $(document).on('click','.del_all',function(){
    
            $('#formdata').submit();

    });
     $(document).on('click','.updateSub',function(){
            $action = $(this).data('act');
            $('#updatesub_'+action).submit();
            return false;

    });

        $(document).on('click','.delBtn',function(){
            var item_checked = $('input[class="item_checkbox"]:checked').filter(":checked").length;
            if (item_checked > 0) {
                $('.record_count').text(item_checked);
                $('.not_empty_record').removeClass('hidden');
                $('.empty_record').addClass('hidden');
            }else{
                $('.record_count').text('');
                $('.not_empty_record').addClass('hidden');
                $('.empty_record').removeClass('hidden');
            }
            var checkedIds = Array();
            $('.item_checkbox:checked').each( function(i,v)
            {
                checkedIds.push($(v).attr('value'));
            });
            $('#idsDel').val(checkedIds);
            console.log(checkedIds);

            $('#mutlipleDelete').modal('show');
  });


});