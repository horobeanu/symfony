$(document).ready(function() {


    var ObjCollectionHolder     = $('#innobyte_adminbundle_partnershiptype_links');
    var DeleteHTML              = '<a class="remove_form" href="#">delete this link</a>';
    var AddHTML                 = '<a href="#" class="add_link">Add a link</a>';
    var AddObjHolder            = '.add_link';

    addEndDeleteForm(ObjCollectionHolder, DeleteHTML, AddHTML, AddObjHolder)
 
    
    
    var ObjCollectionHolder2    = $('#innobyte_adminbundle_partnershiptype_videos');
    var DeleteHTML2             = '<a class="remove_form" href="#">delete this video</a>';
    var AddHTML2                = '<a href="#" class="add_video">Add a video</a>';
    var AddObjHolder2           = '.add_video';
    
    addEndDeleteForm(ObjCollectionHolder2, DeleteHTML2, AddHTML2, AddObjHolder2)
    
    
    
    var ObjCollectionHolder3    = $('#innobyte_adminbundle_partnershiptype_images');
    var DeleteHTML3             = '<a class="remove_form" href="#">delete this image</a>';
    var AddHTML3                = '<a href="#" class="add_image">Add an image</a>';
    var AddObjHolder3           = '.add_image';
    
    deleteAddImageLink();
    addEndDeleteForm(ObjCollectionHolder3, DeleteHTML3, AddHTML3, AddObjHolder3)
    
   
        
    var ObjCollectionHolder4    = $('#innobyte_adminbundle_partnershiptype_documents');
    var DeleteHTML4             = '<a class="remove_form" href="#">delete this document</a>';
    var AddHTML4                = '<a href="#" class="add_document">Add a document</a>';
    var AddObjHolder4           = '.add_document';
    
    addEndDeleteForm(ObjCollectionHolder4, DeleteHTML4, AddHTML4, AddObjHolder4)

    
    
    function addEndDeleteForm(ObjCollectionHolder, DeleteHTML, AddHTML, AddObjHolder)
    {
        ObjCollectionHolder.append(AddHTML);
        $(AddObjHolder).click(function(event){
            event.preventDefault();
            addObjForm(ObjCollectionHolder, AddHTML, AddObjHolder, DeleteHTML);
            
            setDatePicker();
            deleteAddImageLink();
        });

        ObjCollectionHolder.parent().children().find('input:last').each(function() {
            addTagFormDeleteObj($(this), DeleteHTML);
        });
    }  
    
    
    function addObjForm(ObjCollectionHolder, AddHTML, AddObjHolder, DeleteHTML) {
        // Get the data-prototype we explained earlier
        var prototype = ObjCollectionHolder.attr('data-prototype');
        // Replace '$$name$$' in the prototype's HTML to
        // instead be a number based on the current collection's length.
        form = prototype.replace(/\$\$name\$\$/g, ObjCollectionHolder.parent().children().length);
        form = form.replace('</div></div>', '</div>'+DeleteHTML + '</div>');
        
        form    = '<div>' + form + '</div>';
        // Display the form in the page
        $(AddObjHolder).parent().before(form);
        
        removeObj();
    }
    
    function addTagFormDeleteObj($tagFormInput, DeleteHTML) {
        $tagFormInput.parent().after($(DeleteHTML));
        removeObj();
    }
    
    function removeObj()
    {
        $('.remove_form').click(function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // remove the li for the tag form
            $(this).parent().parent().remove();
        });
    }
    
    
    
    
    
    
    function deleteAddImageLink(){
        if (ObjCollectionHolder3.parent().children('div').length > 10)
        {
            $(AddObjHolder3).parent().remove();
        } 
    }
    
    
    
    setDatePicker();
    function setDatePicker()
    {
        var myDate = new Date();
        var prettyDate = myDate.getFullYear() + '-' + ("0" + (myDate.getMonth() + 1)).slice(-2) + '-' + ("0" + (myDate.getDate())).slice(-2);
        $("input.date").each(function(){
            if ($(this).val() == "")
            {
                $(this).val(prettyDate)
            }
        })
        
        $("input.date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    }
    
   
    
    $('.select-list li .drop-select').click(function(){
        $(this).siblings('.select-list').show();
    });
    $('.select-list li .select-list').mouseenter(function(){
        $(this).show();
    });
    $('.select-list li .drop-select').mouseleave(function(){
        $(this).siblings('.select-list').hide();
    });
    $('.select-list li .select-list').mouseleave(function(){
        $(this).hide();
    });

    
    $('.total_checked').each(function(){
        setTotalChecked($(this));
    });
    
    $('ul.select-list li').each(function(){
        nr  = $(this).children('div.select-list').find(':checkbox').length;
        if (nr == 0)
        {
            html    = $(this).children('span').html() + $(this).children('p').children('label').html();
            $(this).children('div').html(html);
            resetTotalChecked();
            setTotalChecked($(this).children('.total_checked'));
        }
    });
    
    selectAll();
    
   
    function resetTotalChecked()
    {
        $('.select-list li input').click(function(){
            setTotalChecked($(this).parents('li').find('.total_checked'));
        });
    }

    function selectAll()
    {
        $('.input-select-all').click(function(){
            $(this).next().find(':checkbox').attr('checked', true);
            setTotalChecked($(this).parents('li').find('.total_checked'));
            
            $(this).removeClass("input-select-all");
            $(this).addClass("input-deselect-all");
            $(this).html('Remove All');
            deSelectAll();
        });
    }
    
    function deSelectAll()
    {
        $('.input-deselect-all').click(function(){
            $(this).next().find(':checkbox').attr('checked', false);
            setTotalChecked($(this).parents('li').find('.total_checked'));
            
            $(this).removeClass("input-deselect-all");
            $(this).addClass("input-select-all");
            $(this).html('Select All');
            selectAll();
        });
    }
    

    function setTotalChecked($elem)
    {
        nr  = $elem.parents('li').children('div.select-list').find(':checkbox[checked]').length;
        $elem.html('('+nr+')');
        if (nr > 0)
        {
            $elem.parents('li').children('span').find(':checkbox').attr('checked', true)
        } else 
        {
            $elem.parents('li').children('span').find(':checkbox').attr('checked', false)
        }

        nr_total_checkbox  = $elem.parents('li').children('div.select-list').find(':checkbox').length;
        if (nr == nr_total_checkbox)
        {
            $elem.parent().next('a').removeClass("input-select-all");
            $elem.parent().next('a').addClass("input-deselect-all");
            $elem.parent().next('a').html('Remove All');
            selectAll();
        } else {
            $elem.parent().next('a').removeClass("input-deselect-all");
            $elem.parent().next('a').addClass("input-select-all");
            $elem.parent().next('a').html('Select All');
            deSelectAll();
        }
    }
    
    
});