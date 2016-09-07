$(function(){
    
    strGlobalCategory = ""
    strGlobalSubCategory = ""
    strGlobalGroup = ""
    strGlobalSubGroup = ""
    intBookMarkId = ""
    intNoteId = ""
    intPhoneBookId = ""
    
    $(".addTabLeftMenu").click(function(){
        if(!$(this).hasClass("active")){
            $("#btnReset"+$(this).attr("option").replace("Add","")).click()
            $(".AddTabMessage").hide()
        }
        $(".addTabOptions").hide()
        $(".addTabLeftMenu").removeClass("active")
        $(this).addClass("active")
        $("#"+$(this).attr("option")).show()
    })
    
    // book mark ****************************************************************************
     $("#btnSaveBookMark").click(function(){
         if($.trim($("#txtBookmarkName").val()) != "" && $.trim($("#txtBookmarkUrl").val()) != ""){
             var objBookMark = {
                 id          : intBookMarkId,
                 name        : $.trim($("#txtBookmarkName").val()),
                 url         : $.trim($("#txtBookmarkUrl").val()),
                 category    : $.trim($("#cmbBookmarkCategory").val()),
                 subcategory : $.trim($("#cmbBookmarkSubCategory").val()),
                 description : $.trim($("#txtBookmarkDescri").val()),
             }
             var strBookMark = JSON.stringify(objBookMark);
        
            $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/bookmark/savebookmark",
                data: "strBookmark="+strBookMark,
                async: false,
                success:  function(objResult){
                    if(objResult.Message == "SUCCESS"){
                        intBookMarkId = objResult.intId
                        setMessage("Bookmark Has Been Saved", 1)
                    }
                    else if(objResult == "DUPLICATE"){
                        setMessage("Duplicate Bookmark", 2)
                    }
                    else{
                        setMessage("Save Failed", 2)
                    }
                }
            });
        
         }
         
     })
     
     $("#btnResetBookMark").click(function(){
         intBookMarkId = ""
         $(".AddTabMessage").hide()
         $("#AddBookMark").find("input:text").val("")
         $("#AddBookMark").find("select").val("")
         $("#AddBookMark").find("textarea").val("")
     })
     
    // note ****************************************************************************
     $("#btnSaveNote").click(function(){
         if($.trim($("#txtNoteName").val()) != ""){
             var objNote = {
                 id          : intNoteId,
                 name        : $.trim($("#txtNoteName").val()),
                 category    : $.trim($("#cmbNoteCategory").val()),
                 subcategory : $.trim($("#cmbNoteSubCategory").val()),
                 note        : $.trim($("#txaNote").val()),
             }
         }
         var strNote = JSON.stringify(objNote);
         
         $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/note/savenote",
                data: "strNote="+strNote,
                async: false,
                success:  function(objResult){
                    if(objResult.Message == "SUCCESS"){
                        intNoteId = objResult.intId
                        setMessage("Note Has Been Saved", 1)
                    }
                    else if(objResult == "DUPLICATE"){
                        setMessage("Duplicate Note", 2)
                    }
                    else{
                        setMessage("Save Failed", 2)
                    }
                }
            });
     })
     
     $("#btnResetNote").click(function(){
         intNoteId = ""
         $(".AddTabMessage").hide()
         $("#AddNote").find("input:text").val("")
         $("#AddNote").find("select").val("")
         $("#AddNote").find("textarea").val("")
     })
     
    // phone book ****************************************************************************
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
    
    $("#btnSavePhoneBook").click(function(){
        
        if($.trim($("#txtPhoneBookName").val()) != ""){
            var objPhoneBook = {}
            var arrPhone = new Array()
            var arrMobile = new Array()
            var arrEmail = new Array()
            var arrFax = new Array()

            $(".txtPhoneBookPhone").each(function(){
                if($.trim($(this).val()) != ""){
                    arrPhone.push($.trim($(this).val()))
                }
            })

            $(".txtPhoneBookMobile").each(function(){
                if($.trim($(this).val()) != ""){
                    arrMobile.push($.trim($(this).val()))
                }
            })

            $(".txtPhoneBookEmail").each(function(){
                if($.trim($(this).val()) != ""){
                    arrEmail.push($.trim($(this).val()))
                }
            })

            $(".txtPhoneBookFax").each(function(){
                if($.trim($(this).val()) != ""){
                    arrFax.push($.trim($(this).val()))
                }
            })

            objPhoneBook["id"] = intPhoneBookId
            objPhoneBook["name"] = $.trim($("#txtPhoneBookName").val())
            objPhoneBook["group"] = $.trim($("#cmbPhoneBookGroup").val())
            objPhoneBook["subgroup"] = $.trim($("#cmbPhoneBookSubGroup").val())
            objPhoneBook["phone"] = arrPhone
            objPhoneBook["mobile"] = arrMobile
            objPhoneBook["email"] = arrEmail
            objPhoneBook["fax"] = arrFax
            objPhoneBook["address"] = $.trim($("#txaPhoneBookAddress").val())
            objPhoneBook["description"] = $.trim($("#txaPhoneBookDescription").val())
            
            var strPhoneBook = JSON.stringify(objPhoneBook)
         
            $.ajax({
                   type: "POST",
                   url: strBaseUrl+"/mybook/phoneBook/savephonebook",
                   data: "strPhoneBook="+strPhoneBook,
                   async: false,
                   success:  function(objResult){
                       if(objResult.Message == "SUCCESS"){
                           intPhoneBookId = objResult.intId
                           setMessage("Phone Book Has Been Saved", 1)
                       }
                       else if(objResult == "DUPLICATE"){
                           setMessage("Duplicate Phone Book", 2)
                       }
                       else{
                           setMessage("Save Failed", 2)
                       }
                   }
               });
        }
        
        
    })
    
    $("#btnResetPhoneBook").click(function(){
        intPhoneBookId = ""
        $(".AddTabMessage").hide()
        $("#AddPhoneBook").find("input:text").val("")
        $("#AddPhoneBook").find("select").val("")
        $("#AddPhoneBook").find("textarea").val("")
    })
    
    // main category ****************************************************************************
    $(document).on("click", ".editCategory", function(){
        var objCol = $(this).closest("tr").find("td").eq(1)
        var strCategory = $.trim(objCol.html())
        strGlobalCategory = strCategory
        var strTextBox = "<input type='text' placeholder='Category' class='form-control dynamicTextBox' value='"+strCategory+"'>"
        objCol.html(strTextBox)
        objCol.children().focus()
    })
    
    $(document).on("blur", ".dynamicTextBox", function(){
        var objTextBox = $(this).closest("tr").find("td").eq(1).children()
        var strCategory = $.trim(objTextBox.val())
        if(strCategory == ""){
            strCategory = strGlobalCategory
        }
        if(strCategory == ""){
            objTextBox.closest("tr").remove()
        }
        else{
            objTextBox.parent().html(strCategory)
        }
        
        setSerialNo("#addCategoryGrid .serial")
    })
    
    $(document).on("click", ".deleteCategory", function(){
        var objThis = $(this)
        var intCategoryId = $(this).closest("tr").attr("category")
        
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            
            if(intCategoryId != ""){
                $.ajax({
                    type: "POST",
                    url: strBaseUrl+"/mybook/categories/deletecategory",
                    data: "intCategoryId="+intCategoryId,
                    async: false,
                    success:  function(objResult){
                        if(objResult == "SUCCESS"){
                            objThis.closest("tr").remove()
                            setSerialNo("#addCategoryGrid .serial")
                            setMessage("Category Has Been Deleted", 1)
                        }
                        else{
                            setMessage("Delete Failed", 2)
                        }
                    }
                });
            }
            else{
                objThis.closest("tr").remove()
                setSerialNo("#addCategoryGrid .serial")
                setMessage("Category Has Been Deleted", 1)
            }
            
        })
    })
    
    $("#btnAddCategory").click(function(){
        strGlobalCategory = ""
        var strRow = "<tr category=''>\n\
                          <td class='serial'></td>\n\
                          <td><input type='text' placeholder='Category' class='form-control dynamicTextBox'></td>\n\
                          <td><a><i class='fa fa-pencil fa-fw pointer editCategory'></i></a></td>\n\
                          <td><a><i class='fa fa-trash fa-fw pointer deleteCategory'></i></a></td>\n\
                        </tr>"
        $("#addCategoryGrid").append(strRow)
        $("#addCategoryGrid").find("input:text").focus()
        setSerialNo("#addCategoryGrid .serial")
    })
    
    $("#btnSaveCategory").click(function(){
        var arrCategory = new Array()
        $("#addCategoryGrid").find("tr").each(function(){
            var objCategory = {}
            objCategory["id"] = $.trim($(this).attr("category"))
            objCategory["name"] = $.trim($(this).find("td").eq(1).html())
            objCategory["type"] = "C"
            if(objCategory["name"] != ""){
                arrCategory.push(objCategory)
            }
        })
        
        var strCategory = JSON.stringify(arrCategory);
        
        $.ajax({
            type: "POST",
            url: strBaseUrl+"/mybook/categories/savecategory",
            data: "strCategory="+strCategory,
            async: false,
            success:  function(objResult){
                if(objResult == "SUCCESS"){
                    setMessage("Category Has Been Saved", 1)
                }
                else if(objResult == "DUPLICATE"){
                    setMessage("Duplicate Group", 2)
                }
                else{
                    setMessage("Save Failed", 2)
                }
            }
        });
        
    })
    
    // sub category ****************************************************************************
    $(document).on("click", ".editSubCategory", function(){
        var objCol = $(this).closest("tr").find("td").eq(1)
        var strSubCategory = $.trim(objCol.html())
        strGlobalSubCategory = strSubCategory
        var strTextBox = "<input type='text' placeholder='Sub Category' class='form-control dynamicTextBoxSC' value='"+strSubCategory+"'>"
        objCol.html(strTextBox)
        objCol.children().focus()
    })
    
    $(document).on("blur", ".dynamicTextBoxSC", function(){
        var objTextBox = $(this).closest("tr").find("td").eq(1).children()
        var strSubCategory = $.trim(objTextBox.val())
        if(strSubCategory == ""){
            strSubCategory = strGlobalSubCategory
        }
        if(strSubCategory == ""){
            objTextBox.closest("tr").remove()
        }
        else{
            objTextBox.parent().html(strSubCategory)
        }
        
        setSerialNo("#addSubCategoryGrid .serial")
    })
    
    $(document).on("click", ".deleteSubCategory", function(){
        var objThis = $(this)
        var intCategoryId = $(this).closest("tr").attr("category")
        
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            
            if(intCategoryId != ""){
                $.ajax({
                    type: "POST",
                    url: strBaseUrl+"/mybook/categories/deletecategory",
                    data: "intCategoryId="+intCategoryId,
                    async: false,
                    success:  function(objResult){
                        if(objResult == "SUCCESS"){
                            objThis.closest("tr").remove()
                            setSerialNo("#addSubCategoryGrid .serial")
                            setMessage("Sub Category Has Been Deleted", 1)
                        }
                        else{
                            setMessage("Delete Failed", 2)
                        }
                    }
                });
            }
            else{
                objThis.closest("tr").remove()
                setSerialNo("#addSubCategoryGrid .serial")
                setMessage("Category Has Been Deleted", 1)
            }
            
        })
    })
    
    $("#btnAddSubCategory").click(function(){
        strGlobalSubCategory = ""
        var strRow = "<tr category=''>\n\
                          <td class='serial'></td>\n\
                          <td><input type='text' placeholder='Sub Category' class='form-control dynamicTextBoxSC'></td>\n\
                          <td><a><i class='fa fa-pencil fa-fw pointer editSubCategory'></i></a></td>\n\
                          <td><a><i class='fa fa-trash fa-fw pointer deleteSubCategory'></i></a></td>\n\
                        </tr>"
        $("#addSubCategoryGrid").append(strRow)
        $("#addSubCategoryGrid").find("input:text").focus()
        setSerialNo("#addSubCategoryGrid .serial")
    })
    
    $("#btnSaveSubCategory").click(function(){
        var arrSubCategory = new Array()
        $("#addSubCategoryGrid").find("tr").each(function(){
            var objSubCategory = {}
            objSubCategory["id"] = $.trim($(this).attr("category"))
            objSubCategory["name"] = $.trim($(this).find("td").eq(1).html())
            objSubCategory["type"] = "S"
            if(objSubCategory["name"] != ""){
                arrSubCategory.push(objSubCategory)
            }
        })
        
        var strSubCategory = JSON.stringify(arrSubCategory);
        
        $.ajax({
            type: "POST",
            url: strBaseUrl+"/mybook/categories/savecategory",
            data: "strCategory="+strSubCategory,
            async: false,
            success:  function(objResult){
                if(objResult == "SUCCESS"){
                    setMessage("Sub Category Has Been Saved", 1)
                }
                else if(objResult == "DUPLICATE"){
                    setMessage("Duplicate Group", 2)
                }
                else{
                    setMessage("Save Failed", 2)
                }
            }
        });
        
    })
    
    // group ****************************************************************************
    $(document).on("click", ".editGroup", function(){
        var objCol = $(this).closest("tr").find("td").eq(1)
        var strGroup = $.trim(objCol.html())
        strGlobalGroup = strGroup
        var strTextBox = "<input type='text' placeholder='Sub Group' class='form-control dynamicTextBoxG' value='"+strGroup+"'>"
        objCol.html(strTextBox)
        objCol.children().focus()
    })
    
    $(document).on("blur", ".dynamicTextBoxG", function(){
        var objTextBox = $(this).closest("tr").find("td").eq(1).children()
        var strGroup = $.trim(objTextBox.val())
        if(strGroup == ""){
            strGroup = strGlobalGroup
        }
        if(strGroup == ""){
            objTextBox.closest("tr").remove()
        }
        else{
            objTextBox.parent().html(strGroup)
        }
        
        setSerialNo("#addGroupGrid .serial")
    })
    
    $(document).on("click", ".deleteGroup", function(){
        var objThis = $(this)
        var intGroupId = $(this).closest("tr").attr("group")
        
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            
            if(intGroupId != ""){
                $.ajax({
                    type: "POST",
                    url: strBaseUrl+"/mybook/group/deletegroup",
                    data: "intGroupId="+intGroupId,
                    async: false,
                    success:  function(objResult){
                        if(objResult == "SUCCESS"){
                            objThis.closest("tr").remove()
                            setSerialNo("#addGroupGrid .serial")
                            setMessage("Group Has Been Deleted", 1)
                        }
                        else{
                            setMessage("Delete Failed", 2)
                        }
                    }
                });
            }
            else{
                objThis.closest("tr").remove()
                setSerialNo("#addGroupGrid .serial")
                setMessage("Group Has Been Deleted", 1)
            }
            
        })
    })
    
    $("#btnAddGroup").click(function(){
        strGlobalGroup = ""
        var strRow = "<tr group=''>\n\
                          <td class='serial'></td>\n\
                          <td><input type='text' placeholder='Sub Group' class='form-control dynamicTextBoxG'></td>\n\
                          <td><a><i class='fa fa-pencil fa-fw pointer editGroup'></i></a></td>\n\
                          <td><a><i class='fa fa-trash fa-fw pointer deleteGroup'></i></a></td>\n\
                        </tr>"
        $("#addGroupGrid").append(strRow)
        $("#addGroupGrid").find("input:text").focus()
        setSerialNo("#addGroupGrid .serial")
    })
    
    $("#btnSaveGroup").click(function(){
        var arrGroup = new Array()
        $("#addGroupGrid").find("tr").each(function(){
            var objGroup = {}
            objGroup["id"] = $.trim($(this).attr("group"))
            objGroup["name"] = $.trim($(this).find("td").eq(1).html())
            objGroup["type"] = "G"
            if(objGroup["name"] != ""){
                arrGroup.push(objGroup)
            }
        })
        
        var strGroup = JSON.stringify(arrGroup);
        
        $.ajax({
            type: "POST",
            url: strBaseUrl+"/mybook/group/savegroup",
            data: "strGroup="+strGroup,
            async: false,
            success:  function(objResult){
                if(objResult == "SUCCESS"){
                    setMessage("Group Has Been Saved", 1)
                }
                else if(objResult == "DUPLICATE"){
                    setMessage("Duplicate Group", 2)
                }
                else{
                    setMessage("Save Failed", 2)
                }
            }
        });
    })
    
    // sub group ****************************************************************************
    $(document).on("click", ".editSubGroup", function(){
        var objCol = $(this).closest("tr").find("td").eq(1)
        var strSubGroup = $.trim(objCol.html())
        strGlobalSubGroup = strSubGroup
        var strTextBox = "<input type='text' placeholder='Sub Group' class='form-control dynamicTextBoxSG' value='"+strSubGroup+"'>"
        objCol.html(strTextBox)
        objCol.children().focus()
    })
    
    $(document).on("blur", ".dynamicTextBoxSG", function(){
        var objTextBox = $(this).closest("tr").find("td").eq(1).children()
        var strSubGroup = $.trim(objTextBox.val())
        if(strSubGroup == ""){
            strSubGroup = strGlobalSubGroup
        }
        if(strSubGroup == ""){
            objTextBox.closest("tr").remove()
        }
        else{
            objTextBox.parent().html(strSubGroup)
        }
        
        setSerialNo("#addSubGroupGrid .serial")
    })
    
    $(document).on("click", ".deleteSubGroup", function(){
        var objThis = $(this)
        var intGroupId = $(this).closest("tr").attr("group")
        
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            
            if(intGroupId != ""){
                $.ajax({
                    type: "POST",
                    url: strBaseUrl+"/mybook/group/deletegroup",
                    data: "intGroupId="+intGroupId,
                    async: false,
                    success:  function(objResult){
                        if(objResult == "SUCCESS"){
                            objThis.closest("tr").remove()
                            setSerialNo("#addSubGroupGrid .serial")
                            setMessage("Sub Group Has Been Deleted", 1)
                        }
                        else{
                            setMessage("Delete Failed", 2)
                        }
                    }
                });
            }
            else{
                objThis.closest("tr").remove()
                setSerialNo("#addSubGroupGrid .serial")
                setMessage("Sub Group Has Been Deleted", 1)
            }
        })
        
    })
    
    $("#btnAddSubGroup").click(function(){
        strGlobalSubGroup = ""
        var strRow = "<tr group=''>\n\
                          <td class='serial'></td>\n\
                          <td><input type='text' placeholder='Sub Group' class='form-control dynamicTextBoxSG'></td>\n\
                          <td><a><i class='fa fa-pencil fa-fw pointer editSubGroup'></i></a></td>\n\
                          <td><a><i class='fa fa-trash fa-fw pointer deleteSubGroup'></i></a></td>\n\
                        </tr>"
        $("#addSubGroupGrid").append(strRow)
        $("#addSubGroupGrid").find("input:text").focus()
        setSerialNo("#addSubGroupGrid .serial")
    })
    
    $("#btnSaveSubGroup").click(function(){
        var arrSubGroup = new Array()
        $("#addSubGroupGrid").find("tr").each(function(){
            var objSubGroup = {}
            objSubGroup["id"] = $.trim($(this).attr("group"))
            objSubGroup["name"] = $.trim($(this).find("td").eq(1).html())
            objSubGroup["type"] = "S"
            if(objSubGroup["name"] != ""){
                arrSubGroup.push(objSubGroup)
            }
        })
        
        var strSubGroup = JSON.stringify(arrSubGroup);
        
        $.ajax({
            type: "POST",
            url: strBaseUrl+"/mybook/group/savegroup",
            data: "strGroup="+strSubGroup,
            async: false,
            success:  function(objResult){
                if(objResult == "SUCCESS"){
                    setMessage("Group Has Been Saved", 1)
                }
                else if(objResult == "DUPLICATE"){
                    setMessage("Duplicate Sub Group", 2)
                }
                else{
                    setMessage("Save Failed", 2)
                }
            }
        });
    })

})

function setSerialNo(strId){
    $(strId).each(function(intKey, strValue){
        $(this).html(intKey+1)
    })
}

function setMessage(strMessage, intMode){
    if(intMode == 1){
        $(".AddTabMessage").addClass("alert-success")
        $(".AddTabMessage").removeClass("alert-warning")
    }
    if(intMode == 2){
        $(".AddTabMessage").addClass("alert-warning")
        $(".AddTabMessage").removeClass("alert-success")
    }
    $(".AddTabMessage").html(strMessage)
    $(".AddTabMessage").show()
    $('html,body').animate({scrollTop: $(".AddTabMessage").offset().top},'slow');
}
