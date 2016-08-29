<html>
    
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
        <?php
            require_once dirname(dirname(__DIR__))."\\mybook\\template\\mybook.js";
        ?>
    </script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
    
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
              
            <h1>Bookmark / Notes / Phone Book</h1>
            
            <hr>
            
            <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#BookmarkTab">Book Marks</a>
              </li>
              <li>
                <a data-toggle="tab" href="#NotesTab">Notes</a>
              </li>
              <li>
                <a data-toggle="tab" href="#PhoneBookTab">Phone Book</a>
              </li>
              <li>
                <a data-toggle="tab" href="#AddTab">Add</a>
              </li>
            </ul>
            
            <div class="tab-content">
                
              <!--******************************************* BookmarkTab-->  
              <div id="BookmarkTab" class="tab-pane fade in active">
                  
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
                        <select class="form-control" id="searchCategory">
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
                        <select class="form-control" id="searchSubCategory">
                            <option value=""></option>
                            <?php
                                foreach($arrSubCategories as $arrSubCategory){
                                    echo "<option value='{$arrSubCategory["id"]}'>{$arrSubCategory["name"]}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                      <!--<button type="button" class="btn btn-default">Sign in</button>-->
                      <a class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Search</a>
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
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td>@mdo</td>
                      <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                      <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                      <td>@fat</td>
                      <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                      <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                      <td>@twitter</td>
                      <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                      <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                    </tr>
                  </tbody>
                </table>
                  
              </div>
                
              <!--******************************************* NotesTab-->   
              <div id="NotesTab" class="tab-pane fade">
                  
                  <div id="NotesList">
                      
                    <form class="form-horizontal" role="form">
                      <div class="form-group" style="margin-top: 15px;">
                        <div class="col-sm-1">
                          <label for="Name" class="control-label">Name</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="searchBookmarkName" placeholder="Note Name">
                        </div>
                        <div class="col-sm-1">
                          <label for="Category" class="control-label">Category</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="searchCategory">
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
                            <select class="form-control" id="searchSubCategory">
                                <option value=""></option>
                                <?php
                                    foreach($arrSubCategories as $arrSubCategory){
                                        echo "<option value='{$arrSubCategory["id"]}'>{$arrSubCategory["name"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                          <!--<button type="button" class="btn btn-default">Sign in</button>-->
                          <a class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Search</a>
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
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <!--<td>@mdo</td>-->
                          <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                          <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                          <!--<td>@fat</td>-->
                          <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                          <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                          <!--<td>@twitter</td>-->
                          <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                          <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                      
                  </div>
                  
                  
                  <!--*** NoteView ***-->
                  <div id="NoteView" style="display: none">
                      
                      <h3>Notes</h3>

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
                          </div>

                        <hr>

                        <div class="row">
                          <div class="col-sm-12">
                            <button type="button" class="btn btn-primary">Edit</button>
                          </div>
                        </div>
                        
                  </div>
                  
              </div>
                
              <!--******************************************* PhoneBookTab-->  
              <div id="PhoneBookTab" class="tab-pane fade">
                  
                  <div id="PhoneBookList">
                      
                      <form class="form-horizontal" role="form">
                      <div class="form-group" style="margin-top: 15px;">
                        <div class="col-sm-1">
                          <label for="Name" class="control-label">Name</label>
                        </div>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="searchBookmarkName" placeholder="Name">
                        </div>
                        <div class="col-sm-1">
                          <label for="Category" class="control-label">Group</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="searchCategory">
                                <option value=""></option>
                                <?php
                                    foreach($arrCategories as $arrCategory){
                                        echo "<option value='{$arrCategory["id"]}'>{$arrCategory["name"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                          <label for="SubCategory" class="control-label">SubGroup</label>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="searchSubCategory">
                                <option value=""></option>
                                <?php
                                    foreach($arrSubCategories as $arrSubCategory){
                                        echo "<option value='{$arrSubCategory["id"]}'>{$arrSubCategory["name"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                          <!--<button type="button" class="btn btn-default">Sign in</button>-->
                          <a class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Search</a>
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
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                          <td>@mdo</td>
                          <td>@mdo</td>
                          <td>@mdo</td>
                          <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                          <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                          <td>@fat</td>
                          <td>@fat</td>
                          <td>@fat</td>
                          <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                          <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                          <td>@twitter</td>
                          <td>@twitter</td>
                          <td>@twitter</td>
                          <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                          <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                        </tr>
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
              <div id="AddTab" class="tab-pane fade">
                  
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
                          
                          <div class="alert alert-dismissable alert-success AddTabMessage">
                              <strong>Well done!</strong>You successfully read this important alert message.
                          </div>
                          
                          <!--*** Add Book Mark ***-->
                          <div class="addTabOptions" id="AddBookMark">
                              
                            <h3>Book Mark</h3>
                            <hr>

                            <form class="form-horizontal" role="form">

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="inputEmail3" class="control-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Name">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="inputEmail3" class="control-label">URL</label>
                                </div>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="URL">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="inputEmail3" class="control-label">Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputEmail3">
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
                                  <label for="inputEmail3" class="control-label">Sub Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputEmail3">
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
                                  <label for="inputEmail3" class="control-label">Description</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputEmail3" placeholder="Description"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary btnResetAddTab" mode="AddBookMark">Reset</button>
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
                                  <label for="inputEmail3" class="control-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="inputEmail3" placeholder="Name">
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="inputEmail3" class="control-label">Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputEmail3">
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
                                  <label for="inputEmail3" class="control-label">Sub Category</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputEmail3">
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
                                  <label for="inputEmail3" class="control-label">Note</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputEmail3" placeholder="Note" style="height: 500px; resize: none"></textarea>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-primary btnResetAddTab" mode="AddNote">Reset</button>
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
                                    <select class="form-control" id="cmbPhoneBookGroup"></select>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="col-sm-2">
                                  <label for="cmbPhoneBookSubGroup" class="control-label">Sub Group</label>
                                </div>
                                <div class="col-sm-10">
                                    <select class="form-control" id="cmbPhoneBookSubGroup"></select>
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
                                    <button type="button" class="btn btn-primary btnResetAddTab" mode="AddPhoneBook">Reset</button>
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
                                  <th style="width: 40px;">Sl No</th>
                                  <th>Category</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                    foreach($arrCategories as $intKey => $arrCategory){
                                        echo "<tr category='{$arrCategory["id"]}'>
                                                  <td>".++$intKey."</td>
                                                  <td>{$arrCategory["name"]}</td>
                                                  <td><a><i class='fa fa-pencil fa-fw pointer'></i></a></td>
                                                  <td><a><i class='fa fa-trash fa-fw pointer'></i></a></td>
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
                                  <th style="width: 40px;">Sl No</th>
                                  <th>Sub Category</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                    foreach($arrSubCategories as $intKey => $arrSubCategory){
                                        echo "<tr category='{$arrSubCategory["id"]}'>
                                                  <td>".++$intKey."</td>
                                                  <td>{$arrSubCategory["name"]}</td>
                                                  <td><a><i class='fa fa-pencil fa-fw pointer'></i></a></td>
                                                  <td><a><i class='fa fa-trash fa-fw pointer'></i></a></td>
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
                                  <th style="width: 40px;">Sl No</th>
                                  <th>Group</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>Mark</td>
                                  <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                                  <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Jacob</td>
                                  <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                                  <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Larry</td>
                                  <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                                  <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                                </tr>
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
                                  <th style="width: 40px;">Sl No</th>
                                  <th>Sub Group</th>
                                  <th style="width: 33px;">Edit</th>
                                  <th style="width: 50px;">Delete</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>Mark</td>
                                  <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                                  <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Jacob</td>
                                  <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                                  <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Larry</td>
                                  <td><a><i class="fa fa-pencil fa-fw pointer"></i></a></td>
                                  <td><a><i class="fa fa-trash fa-fw pointer"></i></a></td>
                                </tr>
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