$(function(){
    
    strGlobalCategory = ""
    strGlobalSubCategory = ""
    strGlobalGroup = ""
    strGlobalSubGroup = ""
    intGlobalBookMarkId = ""
    intGlobalNoteId = ""
    intGlobalPhoneBookId = ""
    
    $(document).ready(function(){
//        CKEDITOR.editorConfig = function( config ) {
//                config.uiColor = '#F7B42C';
//                config.height = 700;
//                config.toolbarCanCollapse = true;
//        };

        CKEDITOR.replace("txaNote", {
            uiColor: '#9AB8F3', 
            height: 400,
            
            toolbarGroups: [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'forms', groups: [ 'forms' ] },
                { name: 'tools', groups: [ 'tools' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'colors', groups: [ 'colors' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
                { name: 'links', groups: [ 'links' ] },
		{ name: 'others', groups: [ 'others' ] },
//		{ name: 'about', groups: [ 'about' ] }
            ]
        });
    })
    
    $("#logout").click(function(){
        window.location.href = "login/logout"
    })
    
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
                 id          : intGlobalBookMarkId,
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
                        intGlobalBookMarkId = objResult.intId
                        $("#BookMarkSearch").click()
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
     
     $(document).on("click", ".deleteBookmark", function(){
        var objThis = $(this)
        var intBookmarkId = $(this).closest("tr").attr("bookmark")
        
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            
            $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/bookmark/deletebookmark",
                data: "intBookmarkId="+intBookmarkId,
                async: false,
                success:  function(objResult){
                    if(objResult == "SUCCESS"){
                        if(intGlobalBookMarkId == intBookmarkId){
                            $("#btnResetBookMark").click()
                        }
                        objThis.closest("tr").remove()
                        setSerialNo("#BookmarkGrid .serial")
                    }
                }
            });
            
        })
    })
    
    $("#BookMarkSearch").click(function(){
        var objSearchData = {
            strLoadId : "",
            name : $.trim($("#searchBookmarkName").val()),
            category : $("#searchBookmarkCategory").val(),
            subcategory : $("#searchBookmarkSubCategory").val(),
        }
        
        var strSearchData = JSON.stringify(objSearchData)
        
        $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/bookmark/getbookmark",
                data: "strSearchData="+strSearchData,
                async: false,
                success:  function(objResult){
                    var strBookMarks = ""
                    $.each(objResult, function(intKey, objData){
                        strBookMarks += "<tr bookmark='"+objData.id+"'>\n\
                                          <td class='serial'>"+(intKey+1)+"</td>\n\
                                          <td url='"+objData.url+"' class='goToUrl pointer' style='color:#337cbb'>"+objData.name+"</td>\n\
                                          <td>"+objData.category_name+"</td>\n\
                                          <td>"+objData.subcategory_name+"</td>\n\
                                          <td>"+objData.description+"</td>\n\
                                          <td><a><i class='fa fa-pencil fa-fw pointer editBookmark'></i></a></td>\n\
                                          <td><a><i class='fa fa-trash fa-fw pointer deleteBookmark'></i></a></td>\n\
                                        </tr>"
                    })
                    $("#BookmarkGrid").html(strBookMarks)
                }
            });
    })
     
     $("#BookMarkReset").click(function(){
         $("#searchBookmarkName, #searchBookmarkCategory, #searchBookmarkSubCategory").val("")
     })
     
     $("#btnResetBookMark").click(function(){
         intGlobalBookMarkId = ""
         $(".AddTabMessage").hide()
         $("#AddBookMark").find("input:text").val("")
         $("#AddBookMark").find("select").val("")
         $("#AddBookMark").find("textarea").val("")
     })
     
     $(document).on("click", ".goToUrl", function(){
         var strUrl = $(this).attr("url")
         if(strUrl != ""){
             window.open(strUrl, "_blank");
         }
     })
     
     $(document).on("click", ".editBookmark", function(){
         var objGetData = {
            strLoadId : $(this).closest("tr").attr("bookmark"),
            name : "",
            category : "",
            subcategory : "",
        }
        
        var strGetData = JSON.stringify(objGetData)
        
         $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/bookmark/getbookmark",
                data: "strSearchData="+strGetData,
                async: false,
                success:  function(objResult){
                    if(objResult[0]){
                        var objData = objResult[0]
                        
                        intGlobalBookMarkId = objData.id
                        $("#txtBookmarkName").val(objData.name)
                        $("#txtBookmarkUrl").val(objData.url)
                        $("#cmbBookmarkCategory").val(objData.category)
                        $("#cmbBookmarkSubCategory").val(objData.subcategory)
                        $("#txtBookmarkDescri").val(objData.description)
                        
                        setUpdateMode("AddBookMark")
                    }
                }
            });
     })
     
    // note ****************************************************************************
     $("#btnSaveNote").click(function(){
         if($.trim($("#txtNoteName").val()) != ""){
             var objNote = {
                 id          : intGlobalNoteId,
                 name        : $.trim($("#txtNoteName").val()),
                 category    : $.trim($("#cmbNoteCategory").val()),
                 subcategory : $.trim($("#cmbNoteSubCategory").val()),
                 note        : CKEDITOR.instances['txaNote'].getData(),//$.trim($("#txaNote").val()),
             }
         }
         var strNote = encodeURIComponent(JSON.stringify(objNote));
         
         $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/note/savenote",
                data: "strNote="+strNote,
                async: false,
                success:  function(objResult){
                    if(objResult.Message == "SUCCESS"){
                        intGlobalNoteId = objResult.intId
                        $("#NoteSearch").click()
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
     
     $(document).on("click", ".deleteNote", function(){
        var objThis = $(this)
        var intNoteId = $(this).closest("tr").attr("note")
        
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            
            $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/note/deletenote",
                data: "intNoteId="+intNoteId,
                async: false,
                success:  function(objResult){
                    if(objResult == "SUCCESS"){
                        if(intGlobalNoteId == intNoteId){
                            $("#btnResetNote").click()
                        }
                        objThis.closest("tr").remove()
                        setSerialNo("#NoteGrid .serial")
                    }
                }
            });
            
        })
    })
    
    $("#NoteSearch").click(function(){
        var objSearchData = {
            strLoadId : "",
            name : $.trim($("#searchNoteName").val()),
            category : $("#searchNoteCategory").val(),
            subcategory : $("#searchNoteSubCategory").val(),
        }
        
        var strSearchData = JSON.stringify(objSearchData)
        
        $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/note/getnote",
                data: "strSearchData="+strSearchData,
                async: false,
                success:  function(objResult){
                    var strNotes = ""
                    $.each(objResult, function(intKey, objData){
                        strNotes += "<tr note='"+objData.id+"'>\n\
                                          <td class='serial'>"+(intKey+1)+"</td>\n\
                                          <td class='showNote pointer' style='color:#337cbb'>"+objData.name+"</td>\n\
                                          <td>"+objData.category_name+"</td>\n\
                                          <td>"+objData.subcategory_name+"</td>\n\
                                          <td><a><i class='fa fa-pencil fa-fw pointer editNote'></i></a></td>\n\
                                          <td><a><i class='fa fa-trash fa-fw pointer deleteNote'></i></a></td>\n\
                                        </tr>"
                    })
                    $("#NoteGrid").html(strNotes)
                }
            });
    })
     
     $("#NoteReset").click(function(){
         $("#searchNoteName, #searchNoteCategory, #searchNoteSubCategory").val("")
     })
     
     $("#btnResetNote").click(function(){
         intGlobalNoteId = ""
         $(".AddTabMessage").hide()
         $("#AddNote").find("input:text").val("")
         $("#AddNote").find("select").val("")
         $("#AddNote").find("textarea").val("")
         CKEDITOR.instances['txaNote'].setData("")
     })
     
     $(document).on("click", ".showNote", function(){
        var objSearchData = {
            strLoadId : $(this).closest("tr").attr("note"),
            name : "",
            category : "",
            subcategory : "",
        }
        
        var strSearchData = JSON.stringify(objSearchData)
        
        $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/note/getnote",
                data: "strSearchData="+strSearchData,
                async: false,
                success:  function(objResult){
                    if(objResult[0]){
                        var objData = objResult[0]
                        $("#noteName").html("<i style='color:#337cbb'>"+objData.name+"</i><br>")
                        $("#noteData").html(objData.note)
                        $("#EditNote").attr("note", objData.id)
                        $("#NotesList").hide()
                        $("#NoteView").show()
                    }
                }
            });
     })
     
     $("#EditNote").click(function(){
         loadNoatInEditMode($(this).attr("note"))
     })
     
     $(document).on("click", ".editNote", function(){
         loadNoatInEditMode($(this).closest("tr").attr("note"))
     })
     
     $("#GoToNoteList").click(function(){
         $("#NoteView").hide()
         $("#NotesList").show()
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
        
        var strToAppend = "<div class='form-group PhoneBookDynamicWidget'>\n\
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
        var objThis = $(this)
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            objThis.parent().parent().parent().remove()
        })
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

            objPhoneBook["id"] = intGlobalPhoneBookId
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
                           intGlobalPhoneBookId = objResult.intId
                           $("#PhoneBookSearch").click()
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
    
    $(document).on("click", ".deletePhoneBook", function(){
        var objThis = $(this)
        var intPhoneBookId = $(this).closest("tr").attr("phonebook")
        
        swal({
          title: 'Are You Sure To Delete This?',
          text: "",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            
            $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/phoneBook/deletephonebook",
                data: "intPhoneBookId="+intPhoneBookId,
                async: false,
                success:  function(objResult){
                    if(objResult == "SUCCESS"){
                        if(intGlobalPhoneBookId == intPhoneBookId){
                            $("#btnResetPhoneBook").click()
                        }
                        objThis.closest("tr").remove()
                        setSerialNo("#PhoneBookGrid .serial")
                    }
                }
            });
            
        })
    })
    
    $("#PhoneBookSearch").click(function(){
        var objSearchData = {
            strLoadId : "",
            name : $.trim($("#searchPhoneBookName").val()),
            group : $("#searchPhoneBookGroup").val(),
            subgroup : $("#searchPhoneBookSubGroup").val(),
        }
        
        var strSearchData = JSON.stringify(objSearchData)
        
        $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/phoneBook/getphonebook",
                data: "strSearchData="+strSearchData,
                async: false,
                success:  function(objResult){
                    var strPhoneBook = ""
                    $.each(objResult, function(intKey, objData){
                        strPhoneBook += "<tr phonebook='"+objData.id+"'>\n\
                                          <td class='serial'>"+(intKey+1)+"</td>\n\
                                          <td class='showPhoneBook pointer' style='color:#337cbb'>"+objData.name+"</td>\n\
                                          <td>"+objData.phone+"</td>\n\
                                          <td>"+objData.mobile+"</td>\n\
                                          <td>"+objData.email+"</td>\n\
                                          <td>"+objData.fax+"</td>\n\
                                          <td>"+objData.description+"</td>\n\
                                          <td><a><i class='fa fa-pencil fa-fw pointer editPhoneBook'></i></a></td>\n\
                                          <td><a><i class='fa fa-trash fa-fw pointer deletePhoneBook'></i></a></td>\n\
                                        </tr>"
                    })
                    $("#PhoneBookGrid").html(strPhoneBook)
                }
            });
    })
     
     $("#PhoneBookReset").click(function(){
         $("#searchPhoneBookName, #searchPhoneBookGroup, #searchPhoneBookSubGroup").val("")
     })
    
    $("#btnResetPhoneBook").click(function(){
        intGlobalPhoneBookId = ""
        $(".AddTabMessage").hide()
        $(".PhoneBookDynamicWidget").remove()
        $("#AddPhoneBook").find("input:text").val("")
        $("#AddPhoneBook").find("select").val("")
        $("#AddPhoneBook").find("textarea").val("")
    })
    
    $(document).on("click", ".showPhoneBook", function(){
        $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/phoneBook/getphonebookdata",
                data: "intId="+$(this).closest("tr").attr("phonebook"),
                async: false,
                success:  function(objResult){
                    if(objResult){
                        $("#pbName").html(objResult.name)
                        $("#pbGroup").html(objResult.group_name)
                        $("#pbSubGroup").html(objResult.subgroup_name)
                        
                        $(".pbDynamicData").remove()
                        $.each(objResult.phone, function(intKey, strValue){
                            if(intKey == 0){
                                $("#pbPhone").html(strValue)
                            }
                            else{
                                var strData = "<div class='row pbDynamicData'>\n\
                                                <div class='col-sm-2'></div>\n\
                                                <div class='col-sm-10'>"+strValue+"</div>\n\
                                              </div>"
                                $("#pbPhoneGroup").append(strData)
                            }
                        })
                        $.each(objResult.mobile, function(intKey, strValue){
                            if(intKey == 0){
                                $("#pbMobile").html(strValue)
                            }
                            else{
                                var strData = "<div class='row pbDynamicData'>\n\
                                                <div class='col-sm-2'></div>\n\
                                                <div class='col-sm-10'>"+strValue+"</div>\n\
                                              </div>"
                                $("#pbMobileGroup").append(strData)
                            }
                        })
                        $.each(objResult.email, function(intKey, strValue){
                            if(intKey == 0){
                                $("#pbEmail").html(strValue)
                            }
                            else{
                                var strData = "<div class='row pbDynamicData'>\n\
                                                <div class='col-sm-2'></div>\n\
                                                <div class='col-sm-10'>"+strValue+"</div>\n\
                                              </div>"
                                $("#pbEmailGroup").append(strData)
                            }
                        })
                        $.each(objResult.fax, function(intKey, strValue){
                            if(intKey == 0){
                                $("#pbFax").html(strValue)
                            }
                            else{
                                var strData = "<div class='row pbDynamicData'>\n\
                                                <div class='col-sm-2'></div>\n\
                                                <div class='col-sm-10'>"+strValue+"</div>\n\
                                              </div>"
                                $("#pbFaxGroup").append(strData)
                            }
                        })
                        
                        $("#pbAddress").html(objResult.address)
                        $("#pbDescription").html(objResult.description)
                        $("#EditPhoneBook").attr("phonebook", objResult.id)
                        $("#PhoneBookList").hide()
                        $("#PhoneBookView").show()
                    }
                }
            });
     })
     
     $("#EditPhoneBook").click(function(){
         loadPhoneBookInEditMode($(this).attr("phonebook"))
     })
     $(document).on("click", ".editPhoneBook", function(){
         loadPhoneBookInEditMode($(this).closest("tr").attr("phonebook"))
     })
     
     $("#GoToPhoneBookList").click(function(){
         $("#PhoneBookView").hide()
         $("#PhoneBookList").show()
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
                            getGroupAndCategory()
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
                    getGroupAndCategory()
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
                            getGroupAndCategory()
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
                    getGroupAndCategory()
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
                            getGroupAndCategory()
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
                    getGroupAndCategory()
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
                            getGroupAndCategory()
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
                    getGroupAndCategory()
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
    $('html,body').animate({scrollTop: $("#AppName").offset().top},'slow');
}

function setUpdateMode(strMenuId){
    $(".AddTabMessage").hide()
    $(".mainTabs").removeClass("active")
    $(".mainTabs").eq(3).addClass("active")
    $(".mainTabsData").removeClass("in active")
    $(".mainTabsData").eq(3).addClass("in active")
    $(".addTabOptions").hide()
    $(".addTabLeftMenu").removeClass("active")
    $(".addTabLeftMenu").each(function(){
        if($(this).attr("option") == strMenuId){
            $(this).addClass("active")
        }
    })
    $("#"+strMenuId).show()
}

function loadNoatInEditMode(intNoteId){
    var objSearchData = {
        strLoadId : intNoteId,
        name : "",
        category : "",
        subcategory : "",
    }

    var strSearchData = JSON.stringify(objSearchData)

    $.ajax({
            type: "POST",
            url: strBaseUrl+"/mybook/note/getnote",
            data: "strSearchData="+strSearchData,
            async: false,
            success:  function(objResult){
                if(objResult[0]){
                    var objData = objResult[0]
                    intGlobalNoteId = objData.id
                    $("#txtNoteName").val(objData.name)
                    $("#cmbNoteCategory").val(objData.category)
                    $("#cmbNoteSubCategory").val(objData.subcategory)
                    CKEDITOR.instances['txaNote'].setData(objData.note) //$("#txaNote").val(objData.note)

                    $("#GoToNoteList").click()
                    setUpdateMode("AddNote")
                }
            }
        });
}

function loadPhoneBookInEditMode(intPhoneBookId){
    $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/phoneBook/getphonebookdata",
                data: "intId="+intPhoneBookId,
                async: false,
                success:  function(objResult){
                    if(objResult){
                        intGlobalPhoneBookId = objResult.id
                        $("#txtPhoneBookName").val(objResult.name)
                        $("#cmbPhoneBookGroup").val(objResult.group)
                        $("#cmbPhoneBookSubGroup").val(objResult.subgroup)
                        
                        $(".PhoneBookDynamicWidget").remove()
                        $.each(objResult.phone, function(intKey, strValue){
                            if(intKey == 0){
                                $("#txtPhoneBookPhone").val(strValue)
                            }
                            else{
                                var strData = "<div class='form-group PhoneBookDynamicWidget'>\n\
                                                  <div class='col-sm-2'></div>\n\
                                                  <div class='col-sm-9'>\n\
                                                    <input type='text' class='form-control txtPhoneBookPhone' placeholder='Phone' value='"+strValue+"'>\n\
                                                  </div>\n\
                                                  <div class='col-sm-1'>\n\
                                                    <a><i class='fa fa-trash fa-2x PhoneBookDynamicDelete pointer'></i></a>\n\
                                                  </div>\n\
                                                </div>"
                                $("#PhoneBookPhoneGroup").append(strData)
                            }
                        })
                        $.each(objResult.mobile, function(intKey, strValue){
                            if(intKey == 0){
                                $("#txtPhoneBookMobile").val(strValue)
                            }
                            else{
                                var strData = "<div class='form-group PhoneBookDynamicWidget'>\n\
                                                  <div class='col-sm-2'></div>\n\
                                                  <div class='col-sm-9'>\n\
                                                    <input type='text' class='form-control txtPhoneBookMobile' placeholder='Mobile' value='"+strValue+"'>\n\
                                                  </div>\n\
                                                  <div class='col-sm-1'>\n\
                                                    <a><i class='fa fa-trash fa-2x PhoneBookDynamicDelete pointer'></i></a>\n\
                                                  </div>\n\
                                                </div>"
                                $("#PhoneBookMobileGroup").append(strData)
                            }
                        })
                        $.each(objResult.email, function(intKey, strValue){
                            if(intKey == 0){
                                $("#txtPhoneBookEmail").val(strValue)
                            }
                            else{
                                var strData = "<div class='form-group PhoneBookDynamicWidget'>\n\
                                                  <div class='col-sm-2'></div>\n\
                                                  <div class='col-sm-9'>\n\
                                                    <input type='text' class='form-control txtPhoneBookEmail' placeholder='Email' value='"+strValue+"'>\n\
                                                  </div>\n\
                                                  <div class='col-sm-1'>\n\
                                                    <a><i class='fa fa-trash fa-2x PhoneBookDynamicDelete pointer'></i></a>\n\
                                                  </div>\n\
                                                </div>"
                                $("#PhoneBookEmailGroup").append(strData)
                            }
                        })
                        $.each(objResult.fax, function(intKey, strValue){
                            if(intKey == 0){
                                $("#txtPhoneBookFax").val(strValue)
                            }
                            else{
                                var strData = "<div class='form-group PhoneBookDynamicWidget'>\n\
                                                  <div class='col-sm-2'></div>\n\
                                                  <div class='col-sm-9'>\n\
                                                    <input type='text' class='form-control txtPhoneBookFax' placeholder='Fax' value='"+strValue+"'>\n\
                                                  </div>\n\
                                                  <div class='col-sm-1'>\n\
                                                    <a><i class='fa fa-trash fa-2x PhoneBookDynamicDelete pointer'></i></a>\n\
                                                  </div>\n\
                                                </div>"
                                $("#PhoneBookFaxGroup").append(strData)
                            }
                        })
                        
                        $("#txaPhoneBookAddress").val(objResult.address)
                        $("#txaPhoneBookDescription").val(objResult.description)
                        $("#GoToPhoneBookList").click()
                        setUpdateMode("AddPhoneBook")
                    }
                }
            });
}

function getGroupAndCategory(){
    $.ajax({
                type: "POST",
                url: strBaseUrl+"/mybook/mybook/getgroupandcategory",
                async: false,
                success:  function(objResult){
                    if(objResult.arrCategories){
                        $("#addCategoryGrid").html("")
                        $.each(objResult.arrCategories, function(intKey, objValue){
                            $("#addCategoryGrid").append("<tr category='"+objValue.id+"'>\n\
                                              <td class='serial'>"+(intKey+1)+"</td>\n\
                                              <td>"+objValue.name+"</td>\n\
                                              <td><a><i class='fa fa-pencil fa-fw pointer editCategory'></i></a></td>\n\
                                              <td><a><i class='fa fa-trash fa-fw pointer deleteCategory'></i></a></td>\n\
                                            </tr>")
                        })
                            
                        $(".cmbCategory").each(function(){
                            var intSelected = $(this).val()
                            $(this).find('option').not(':first').remove();
                            var objThis = $(this)
                            $.each(objResult.arrCategories, function(intKey, objValue){
                                objThis.append("<option value='"+objValue.id+"'>"+objValue.name+"</option>")
                            })
                            objThis.val(intSelected)
                        })
                    }
                    
                    if(objResult.arrSubCategories){
                        $("#addSubCategoryGrid").html("")
                        $.each(objResult.arrCategories, function(intKey, objValue){
                            $("#addSubCategoryGrid").append("<tr category='"+objValue.id+"'>\n\
                                              <td class='serial'>"+(intKey+1)+"</td>\n\
                                              <td>"+objValue.name+"</td>\n\
                                              <td><a><i class='fa fa-pencil fa-fw pointer editSubCategory'></i></a></td>\n\
                                              <td><a><i class='fa fa-trash fa-fw pointer deleteSubCategory'></i></a></td>\n\
                                            </tr>")
                        })
                        
                        $(".cmbSubCategory").each(function(){
                            var intSelected = $(this).val()
                            $(this).find('option').not(':first').remove();
                            var objThis = $(this)
                            $.each(objResult.arrSubCategories, function(intKey, objValue){
                                objThis.append("<option value='"+objValue.id+"'>"+objValue.name+"</option>")
                            })
                            objThis.val(intSelected)
                        })
                    }
                    
                    if(objResult.arrGroups){
                        $("#addGroupGrid").html("")
                        $.each(objResult.arrCategories, function(intKey, objValue){
                            $("#addGroupGrid").append("<tr group='"+objValue.id+"'>\n\
                                              <td class='serial'>"+(intKey+1)+"</td>\n\
                                              <td>"+objValue.name+"</td>\n\
                                              <td><a><i class='fa fa-pencil fa-fw pointer editGroup'></i></a></td>\n\
                                              <td><a><i class='fa fa-trash fa-fw pointer deleteGroup'></i></a></td>\n\
                                            </tr>")
                        })
                        
                        $(".cmbGroup").each(function(){
                            var intSelected = $(this).val()
                            $(this).find('option').not(':first').remove();
                            var objThis = $(this)
                            $.each(objResult.arrGroups, function(intKey, objValue){
                                objThis.append("<option value='"+objValue.id+"'>"+objValue.name+"</option>")
                            })
                            objThis.val(intSelected)
                        })
                    }
                    
                    if(objResult.arrSubGroups){
                        $("#addSubGroupGrid").html("")
                        $.each(objResult.arrCategories, function(intKey, objValue){
                            $("#addSubGroupGrid").append("<tr group='"+objValue.id+"'>\n\
                                              <td class='serial'>"+(intKey+1)+"</td>\n\
                                              <td>"+objValue.name+"</td>\n\
                                              <td><a><i class='fa fa-pencil fa-fw pointer editSubGroup'></i></a></td>\n\
                                              <td><a><i class='fa fa-trash fa-fw pointer deleteSubGroup'></i></a></td>\n\
                                            </tr>")
                        })
                        
                        $(".cmbSubGroup").each(function(){
                            var intSelected = $(this).val()
                            $(this).find('option').not(':first').remove();
                            var objThis = $(this)
                            $.each(objResult.arrSubGroups, function(intKey, objValue){
                                objThis.append("<option value='"+objValue.id+"'>"+objValue.name+"</option>")
                            })
                            objThis.val(intSelected)
                        })
                    }
                }
            });
}