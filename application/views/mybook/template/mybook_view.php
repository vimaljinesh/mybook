<html>
    
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/4.2.6/sweetalert2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
    <script>
        strBaseUrl = "<?php echo $arrBaseUrl; ?>"
        <?php
            require_once dirname(dirname(__DIR__))."/mybook/template/mybook.js";
        ?>
    </script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/sweetalert2/4.2.6/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <title>MyBook - Vimal</title>
    
    <style>
        
        .pointer{
            cursor: pointer;
        }
        
    </style>
    
  </head>
  
  <body>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
              
              <h1 id="AppName">Bookmark / Notes / Phone Book</h1>
            
            <hr>
            
            <ul class="nav nav-tabs">
              <li class="mainTabs active">
                <a data-toggle="tab" href="#BookmarkTab">Book Marks</a>
              </li>
              <li class="mainTabs">
                <a data-toggle="tab" href="#NotesTab">Notes</a>
              </li>
              <li class="mainTabs">
                <a data-toggle="tab" href="#PhoneBookTab">Phone Book</a>
              </li>
              <li class="mainTabs">
                <a data-toggle="tab" href="#AddTab">Add</a>
              </li>
            </ul>
            
            <div class="tab-content">
                
              <!--******************************************* BookmarkTab-->  
              <div id="BookmarkTab" class="mainTabsData tab-pane fade in active">
                  
                <form class="form-horizontal" role="form">
                  <div class="form-group" style="margin-top: 15px;">
                    <div class="col-sm-1">
                      <label for="Name" class="control-label">Name</label>
                    </div>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="searchBookmarkName" placeholder="Bookmark Name">
                    </div>
                    <div class="col-sm-1">
                      <label for="Category" class="control-label">Category</label>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" id="searchBookmarkCategory">
                            <option value=""></option>
                            <?php
                                foreach($arrCategories as $arrCategory){
                                    echo "<option value='{$arrCategory["id"]}'>{$arrCategory["name"]}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-1">
                      <label for="SubCategory" class="control-label">SubCategory</label>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" id="searchBookmarkSubCategory">
                            <option value=""></option>
                            <?php
                                foreach($arrSubCategories as $arrSubCategory){
                                    echo "<option value='{$arrSubCategory["id"]}'>{$arrSubCategory["name"]}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                      <!--<button type="button" class="btn btn-default">Sign in</button>-->
                      <a class="btn btn-primary" id="BookMarkSearch"><i class="fa fa-search fa-fw"></i> Search</a>
                      <a class="btn btn-primary" id="BookMarkReset"><i class="fa fa-undo fa-fw"></i> Reset</a>
                    </div>
                  </div>
                </form>
                  
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Sl No</th>
                      <th>Bookmark Name</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Description</th>
                      <th style="width: 33px;">Edit</th>
                      <th style="width: 50px;">Delete</th>
                    </tr>
                  </thead>
                  <tbody id="BookmarkGrid">
                      <?php
                        foreach($arrBookMark as $intKey => $arrData){
                            echo "<tr bookmark='{$arrData["id"]}'>
                                      <td class='serial'>".($intKey+1)."</td>
                                      <td url='{$arrData["url"]}' class='goToUrl pointer' style='color:#337cbb'>{$arrData["name"]}</td>
                                      <td>{$arrData["category_name"]}</td>
                                      <td>{$arrData["subcategory_name"]}</td>
                                      <td>{$arrData["description"]}</td>
                                      <td><a><i class='fa fa-pencil fa-fw pointer editBookmark'></i></a></td>
                                      <td><a><i class='fa fa-trash fa-fw pointer deleteBookmark'></i></a></td>
                                    </tr>";
                        }
                      ?>
                  </tbody>
                </table>
                  
              </div>
                
              <!--******************************************* NotesTab-->   
              <div id="NotesTab" class="mainTabsData tab-pane fade">
                  
                  <div id="NotesList">
                      
                    <form class="form-horizontal" role="form">
                      <div class="form-group" style="margin-top: 15px;">
                        <div class="col-sm-1">
                          <label for="Name" class="control-label">Name</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="searchNoteName" placeholder="Note Name">
                        </div>
                        <div class="col-sm-1">
                          <label for="Category" class="control-label">Category</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="searchNoteCategory">
                                <option value=""></option>
                                <?php
                                    foreach($arrCategories as $arrCategory){
                                        echo "<option value='{$arrCategory["id"]}'>{$arrCategory["name"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                          <label for="SubCategory" class="control-label">SubCategory</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="searchNoteSubCategory">
                                <option value=""></option>
                                <?php
                                    foreach($arrSubCategories as $arrSubCategory){
                                        echo "<option value='{$arrSubCategory["id"]}'>{$arrSubCategory["name"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                          <!--<button type="button" class="btn btn-default">Sign in</button>-->
                          <a class="btn btn-primary" id="NoteSearch"><i class="fa fa-search fa-fw"></i> Search</a>
                          <a class="btn btn-primary" id="NoteReset"><i class="fa fa-undo fa-fw"></i> Reset</a>
                        </div>
                      </div>
                    </form>

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>Note Name</th>
                          <th>Category</th>
                          <th>Sub Category</th>
                          <!--<th>Description</th>-->
                          <th style="width: 33px;">Edit</th>
                          <th style="width: 50px;">Delete</th>
                        </tr>
                      </thead>
                      <tbody id="NoteGrid">
                          <?php
                            foreach($arrNote as $intKey => $arrData){
                                echo "<tr note='{$arrData["id"]}'>
                                          <td class='serial'>".($intKey+1)."</td>
                                          <td class='showNote pointer' style='color:#337cbb'>{$arrData["name"]}</td>
                                          <td>{$arrData["category_name"]}</td>
                                          <td>{$arrData["subcategory_name"]}</td>
                                          <td><a><i class='fa fa-pencil fa-fw pointer editNote'></i></a></td>
                                          <td><a><i class='fa fa-trash fa-fw pointer deleteNote'></i></a></td>
                                        </tr>";
                            }
                          ?>
                      </tbody>
                    </table>
                      
                  </div>
                  
                  
                  <!--*** NoteView ***-->
                  <div id="NoteView" style="display: none">
                      
                      <h3>Notes</h3>

                        <hr>
                        
                          <div class="row">
                            <div class="col-sm-12">
                                <h3 id="noteName"></h3>
                            </div>
                          </div>
                        
                          <div class="row">
                              <div class="col-sm-12" id="noteData"></div>
                          </div>

<!--                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Name</label>
                            </div>
                            <div class="col-sm-10">
                              my name
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Category</label>
                            </div>
                            <div class="col-sm-10">
                                my category
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Sub Category</label>
                            </div>
                            <div class="col-sm-10">
                                my sub category
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Note</label>
                            </div>
                            <div class="col-sm-10">
                                my address
                            </div>
                          </div>-->

                        <hr>

                        <div class="row">
                          <div class="col-sm-12">
                              <button type="button" class="btn btn-primary" id="GoToNoteList">Back</button>
                              <button type="button" class="btn btn-primary" id="EditNote">Edit</button>
                          </div>
                        </div>
                        
                  </div>
                  
              </div>
                
              <!--******************************************* PhoneBookTab-->  
              <div id="PhoneBookTab" class="mainTabsData tab-pane fade">
                  
                  <div id="PhoneBookList">
                      
                      <form class="form-horizontal" role="form">
                      <div class="form-group" style="margin-top: 15px;">
                        <div class="col-sm-1">
                          <label for="Name" class="control-label">Name</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="searchPhoneBookName" placeholder="Name">
                        </div>
                        <div class="col-sm-1">
                          <label for="Category" class="control-label">Group</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="searchPhoneBookGroup">
                                <option value=""></option>
                                <?php
                                    foreach($arrGroups as $arrGroup){
                                        echo "<option value='{$arrGroup["id"]}'>{$arrGroup["name"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                          <label for="SubCategory" class="control-label">SubGroup</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="searchPhoneBookSubGroup">
                                <option value=""></option>
                                <?php
                                    foreach($arrSubGroups as $arrSubGroup){
                                        echo "<option value='{$arrSubGroup["id"]}'>{$arrSubGroup["name"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                          <!--<button type="button" class="btn btn-default">Sign in</button>-->
                          <a class="btn btn-primary" id="PhoneBookSearch"><i class="fa fa-search fa-fw"></i> Search</a>
                          <a class="btn btn-primary" id="PhoneBookReset"><i class="fa fa-undo fa-fw"></i> Reset</a>
                        </div>
                      </div>
                    </form>

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Fax</th>
                          <th>Description</th>
                          <th style="width: 33px;">Edit</th>
                          <th style="width: 50px;">Delete</th>
                        </tr>
                      </thead>
                      <tbody id="PhoneBookGrid">
                          <?php
                            foreach($arrPhoneBook as $intKey => $arrData){
                                echo "<tr phonebook='{$arrData["id"]}'>
                                          <td class='serial'>".($intKey+1)."</td>
                                          <td class='showPhoneBook pointer' style='color:#337cbb'>{$arrData["name"]}</td>
                                          <td>{$arrData["phone"]}</td>
                                          <td>{$arrData["mobile"]}</td>
                                          <td>{$arrData["email"]}</td>
                                          <td>{$arrData["fax"]}</td>
                                          <td>{$arrData["description"]}</td>
                                          <td><a><i class='fa fa-pencil fa-fw pointer editPhoneBook'></i></a></td>
                                          <td><a><i class='fa fa-trash fa-fw pointer deletePhoneBook'></i></a></td>
                                        </tr>";
                            }
                          ?>
                      </tbody>
                    </table>
                      
                  </div>
                  
                  <!--*** NoteView ***-->
                  <div id="NoteView" style="display: none">
                      
                      <h3>Phone Book</h3>
                  
                        <hr>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Name</label>
                            </div>
                            <div class="col-sm-10">
                              my name
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Group</label>
                            </div>
                            <div class="col-sm-10">
                                my group
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Sub Group</label>
                            </div>
                            <div class="col-sm-10">
                                my sub group
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Phone</label>
                            </div>
                            <div class="col-sm-10">
                              phone 1
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                              phone 2
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Mobile</label>
                            </div>
                            <div class="col-sm-10">
                              mobile 1
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                              mobile 2
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Email</label>
                            </div>
                            <div class="col-sm-10">
                              email 1
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                              email 2
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Fax</label>
                            </div>
                            <div class="col-sm-10">
                              fax 1
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                              fax 2
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Address</label>
                            </div>
                            <div class="col-sm-10">
                                my address
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-sm-2">
                              <label for="inputEmail3" class="control-label">Description</label>
                            </div>
                            <div class="col-sm-10">
                                my description
                            </div>
                          </div>

                        <hr>

                        <div class="row">
                          <div class="col-sm-12">
                            <button type="button" class="btn btn-primary">Edit</button>
                          </div>
                        </div>
                      
                  </div>
                        
              </div>
              
              <!--******************************************* AddTab-->
              <div id="AddTab" class="mainTabsData tab-pane fade">
                  
                  <div class="section">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12"></div>
                      <div class="col-md-2">
                        <ul class="list-group pointer">
                          <li class="list-group-item active addTabLeftMenu" option="AddBookMark">Book Mark</li>
                          <li class="list-group-item addTabLeftMenu" option="AddNote">Note</li>
                          <li class="list-group-item addTabLeftMenu" option="AddPhoneBook">Phone Book</li>
                          <li class="list-group-item addTabLeftMenu" option="AddCategory">Category</li>
                          <li class="list-group-item addTabLeftMenu" option="AddSubCategory">Sub Category</li>
                          <li class="list-group-item addTabLeftMenu" option="AddGroup">Group</li>
                          <li class="list-group-item addTabLeftMenu" option="AddSubGroup">Sub Group</li>
                        </ul>
                      </div>
                      <div class="col-md-10">
                          
                          <div class="alert alert-dismissable alert-success AddTabMessage" style="display: none"></div>
                          
                          <!--*** Add Book Mark ***-->
                          <div class="addTabOptions" id="AddBookMark">
                              
                            <h3>Book Mark</h3>
                            <hr>

                            <form class="form-horizontal" role="form">

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txtBookmarkName" class="control-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="txtBookmarkName" placeholder="Name">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txtBookmarkUrl" class="control-label">URL</label>
                                </div>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="txtBookmarkUrl" placeholder="URL">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="cmbBookmarkCategory" class="control-label">Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbBookmarkCategory">
                                        <option value=""></option>
                                        <?php
                                            foreach($arrCategories as $arrCategory){
                                                echo "<option value='{$arrCategory["id"]}'>{$arrCategory["name"]}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="cmbBookmarkSubCategory" class="control-label">Sub Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbBookmarkSubCategory">
                                        <option value=""></option>
                                        <?php
                                            foreach($arrSubCategories as $arrSubCategory){
                                                echo "<option value='{$arrSubCategory["id"]}'>{$arrSubCategory["name"]}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txtBookmarkDescri" class="control-label">Description</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="txtBookmarkDescri" placeholder="Description"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary" id="btnResetBookMark" mode="AddBookMark">Reset</button>
                                    <button type="button" class="btn btn-primary" id="btnSaveBookMark">Save</button>
                                </div>
                              </div>
                            </form>
                              
                          </div>  
                          
                        
                        
                          <!--*** Add Note ***-->
                          <div class="addTabOptions" id="AddNote" style="display: none">
                              
                            <h3>Note</h3>
                            <hr>

                            <form class="form-horizontal" role="form">

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txtNoteName" class="control-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="txtNoteName" placeholder="Name">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="cmbNoteCategory" class="control-label">Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbNoteCategory">
                                        <option value=""></option>
                                        <?php
                                            foreach($arrCategories as $arrCategory){
                                                echo "<option value='{$arrCategory["id"]}'>{$arrCategory["name"]}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="cmbNoteSubCategory" class="control-label">Sub Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbNoteSubCategory">
                                        <option value=""></option>
                                        <?php
                                            foreach($arrSubCategories as $arrSubCategory){
                                                echo "<option value='{$arrSubCategory["id"]}'>{$arrSubCategory["name"]}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txaNote" class="control-label">Note</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="txaNote" id="txaNote" placeholder="Note" style="height: 500px; resize: none"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary" id="btnResetNote" mode="AddNote">Reset</button>
                                    <button type="button" class="btn btn-primary" id="btnSaveNote">Save</button>
                                </div>
                              </div>
                            </form>
                              
                          </div>
                        
                        
                        
                        
                          <!--*** Add Phone Book ***-->
                          <div class="addTabOptions" id="AddPhoneBook" style="display: none">
                              
                            <h3>Phone Book</h3>
                            <hr>

                            <form class="form-horizontal" role="form">

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txtPhoneBookName" class="control-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="txtPhoneBookName" placeholder="Name">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="cmbPhoneBookGroup" class="control-label">Group</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbPhoneBookGroup">
                                        <option value=""></option>
                                        <?php
                                            foreach($arrGroups as $arrGroup){
                                                echo "<option value='{$arrGroup["id"]}'>{$arrGroup["name"]}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="cmbPhoneBookSubGroup" class="control-label">Sub Group</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbPhoneBookSubGroup">
                                        <option value=""></option>
                                        <?php
                                            foreach($arrSubGroups as $arrSubGroup){
                                                echo "<option value='{$arrSubGroup["id"]}'>{$arrSubGroup["name"]}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                              </div>
                                
                                <div>
                                    <div class="form-group">
                                      <div class="col-sm-2">
                                        <label for="txtPhoneBookPhone" class="control-label">Phone</label>
                                      </div>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control txtPhoneBookPhone" placeholder="Phone">
                                      </div>
                                      <div class="col-sm-1">
                                        <a><i class="fa fa-plus-square fa-2x PhoneBookDynamicAdd pointer" mode="Phone"></i></a>
                                      </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="form-group">
                                       <div class="col-sm-2">
                                         <label for="txtPhoneBookMobile" class="control-label">Mobile</label>
                                       </div>
                                       <div class="col-sm-9">
                                         <input type="text" class="form-control txtPhoneBookMobile" placeholder="Mobile">
                                       </div>
                                       <div class="col-sm-1">
                                         <a><i class="fa fa-plus-square fa-2x PhoneBookDynamicAdd pointer" mode="Mobile"></i></a>
                                       </div>
                                     </div>
                                </div>
                                
                                
                                <div>
                                   <div class="form-group">
                                    <div class="col-sm-2">
                                       <label for="txtPhoneBookEmail" class="control-label">Email</label>
                                     </div>
                                     <div class="col-sm-9">
                                       <input type="text" class="form-control txtPhoneBookEmail" placeholder="Email">
                                     </div>
                                     <div class="col-sm-1">
                                       <a><i class="fa fa-plus-square fa-2x PhoneBookDynamicAdd pointer" mode="Email"></i></a>
                                     </div>
                                   </div>
                                </div>
                                
                                
                                <div>
                                    <div class="form-group">
                                      <div class="col-sm-2">
                                        <label for="txtPhoneBookFax" class="control-label">Fax</label>
                                      </div>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control txtPhoneBookFax" placeholder="Fax">
                                      </div>
                                      <div class="col-sm-1">
                                        <a><i class="fa fa-plus-square fa-2x PhoneBookDynamicAdd pointer"  mode="Fax"></i></a>
                                      </div>
                                    </div>
                                </div>
                              

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txaPhoneBookAddress" class="control-label">Address</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="txaPhoneBookAddress" placeholder="Address" style="resize: none"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="txaPhoneBookDescription" class="control-label">Description</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="txaPhoneBookDescription" placeholder="Description" style="resize: none"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary" id="btnResetPhoneBook" mode="AddPhoneBook">Reset</button>
                                    <button type="button" class="btn btn-primary" id="btnSavePhoneBook">Save</button>
                                </div>
                              </div>
                            </form>
                              
                          </div>
                        
                        
                        
                          <!--*** Add Category ***-->
                          <div class="addTabOptions" id="AddCategory" style="display: none">
                              
                            <h3>Category</h3>
                            <hr>

                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th style="width: 50px;">Sl No</th>
                                  <th>Category</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody id="addCategoryGrid">
                                <?php
                                    foreach($arrCategories as $intKey => $arrCategory){
                                        echo "<tr category='{$arrCategory["id"]}'>
                                                  <td class='serial'>".++$intKey."</td>
                                                  <td>{$arrCategory["name"]}</td>
                                                  <td><a><i class='fa fa-pencil fa-fw pointer editCategory'></i></a></td>
                                                  <td><a><i class='fa fa-trash fa-fw pointer deleteCategory'></i></a></td>
                                                </tr>";
                                    }
                                ?>
                              </tbody>
                            </table>

                            <form class="form-horizontal" role="form">
                              <div class="form-group">
                                <div class="col-sm-12 text-right">
                                  <button type="button" class="btn btn-primary" id="btnAddCategory">Add</button>
                                  <button type="button" class="btn btn-primary" id="btnSaveCategory">Save</button>
                                </div>
                              </div>
                            </form>
                              
                          </div>
                        
                        
                        
                          <!--*** Add Sub Category ***-->
                          <div class="addTabOptions" id="AddSubCategory" style="display: none">
                              
                            <h3>Sub Category</h3>
                            <hr>

                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th style="width: 50px;">Sl No</th>
                                  <th>Sub Category</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody id="addSubCategoryGrid">
                                <?php
                                    foreach($arrSubCategories as $intKey => $arrSubCategory){
                                        echo "<tr category='{$arrSubCategory["id"]}'>
                                                  <td class='serial'>".++$intKey."</td>
                                                  <td>{$arrSubCategory["name"]}</td>
                                                  <td><a><i class='fa fa-pencil fa-fw pointer editSubCategory'></i></a></td>
                                                  <td><a><i class='fa fa-trash fa-fw pointer deleteSubCategory'></i></a></td>
                                                </tr>";
                                    }
                                ?>
                              </tbody>
                            </table>

                            <form class="form-horizontal" role="form">
                              <div class="form-group">
                                <div class="col-sm-12 text-right">
                                  <button type="button" class="btn btn-primary" id="btnAddSubCategory">Add</button>
                                  <button type="button" class="btn btn-primary" id="btnSaveSubCategory">Save</button>
                                </div>
                              </div>
                            </form>
                              
                          </div>
                        
                        
                        
                          <!--*** Add Group ***-->
                          <div class="addTabOptions" id="AddGroup" style="display: none">
                              
                            <h3>Group</h3>
                            <hr>

                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th style="width: 50px;">Sl No</th>
                                  <th>Group</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody id="addGroupGrid">
                                <?php
                                    foreach($arrGroups as $intKey => $arrGroup){ 
                                        echo "<tr group='{$arrGroup["id"]}'>
                                                  <td class='serial'>".($intKey+1)."</td>
                                                  <td>{$arrGroup["name"]}</td>
                                                  <td><a><i class='fa fa-pencil fa-fw pointer editGroup'></i></a></td>
                                                  <td><a><i class='fa fa-trash fa-fw pointer deleteGroup'></i></a></td>
                                                </tr>";
                                    }
                                ?>
                              </tbody>
                            </table>

                            <form class="form-horizontal" role="form">
                              <div class="form-group">
                                <div class="col-sm-12 text-right">
                                  <button type="button" class="btn btn-primary" id="btnAddGroup">Add</button>
                                  <button type="button" class="btn btn-primary" id="btnSaveGroup">Save</button>
                                </div>
                              </div>
                            </form>
                              
                          </div>
                        
                        
                        
                          <!--*** Add Sub Group ***-->
                          <div class="addTabOptions" id="AddSubGroup" style="display: none">
                              
                            <h3>Sub Group</h3>
                            <hr>

                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th style="width: 50px;">Sl No</th>
                                  <th>Sub Group</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody id="addSubGroupGrid">
                                <?php
                                    foreach($arrSubGroups as $intKey => $arrSubGroup){
                                        echo "<tr group='{$arrSubGroup["id"]}'>
                                                  <td class='serial'>".($intKey+1)."</td>
                                                  <td>{$arrSubGroup["name"]}</td>
                                                  <td><a><i class='fa fa-pencil fa-fw pointer editGroup'></i></a></td>
                                                  <td><a><i class='fa fa-trash fa-fw pointer deleteGroup'></i></a></td>
                                                </tr>";
                                    }
                                ?>
                              </tbody>
                            </table>

                            <form class="form-horizontal" role="form">
                              <div class="form-group">
                                <div class="col-sm-12 text-right">
                                  <button type="button" class="btn btn-primary" id="btnAddSubGroup">Add</button>
                                  <button type="button" class="btn btn-primary" id="btnSaveSubGroup">Save</button>
                                </div>
                              </div>
                            </form>
                              
                          </div>
                        
                        
                        
                      </div>
                    </div>
                  </div>
                </div>
                  
              </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>