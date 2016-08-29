$(function(){
    
    $(".addTabLeftMenu").click(function(){
        $(".addTabOptions").hide()
        $(".addTabLeftMenu").removeClass("active")
        $(this).addClass("active")
        $("#"+$(this).attr("option")).show()
    })
    
    $(".btnResetAddTab").click(function(){
        
    })
    
    $(".PhoneBookDynamicAdd").click(function(){
        var strMode = $(this).attr("mode")
        var strClass = "txtPhoneBookPhone"
        var strPlaceholder = "Phone"
        
        if(strMode == "Mobile"){
            strClass = "txtPhoneBookMobile"
            strPlaceholder = "Mobile"
        }
        else if(strMode == "Phone"){
            strClass = "txtPhoneBookPhone"
            strPlaceholder = "phone"
        }
        else if(strMode == "Email"){
            strClass = "txtPhoneBookEmail"
            strPlaceholder = "Email"
        }
        else if(strMode == "Fax"){
            strClass = "txtPhoneBookFax"
            strPlaceholder = "Fax"
        }
        
        var strToAppend = "<div class='form-group'>\n\
                              <div class='col-sm-2'></div>\n\
                              <div class='col-sm-9'>\n\
                                <input type='text' class='form-control "+strClass+"' placeholder='"+strPlaceholder+"'>\n\
                              </div>\n\
                              <div class='col-sm-1'>\n\
                                <a><i class='fa fa-trash fa-2x PhoneBookDynamicDelete pointer'></i></a>\n\
                              </div>\n\
                            </div>"
        
        $(this).parent().parent().parent().parent().append(strToAppend)
        
    })
    
    $(document).on("click", ".PhoneBookDynamicDelete", function(){
        $(this).parent().parent().parent().remove()
    })
})