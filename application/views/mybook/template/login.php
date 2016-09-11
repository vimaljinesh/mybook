<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        strBaseUrl = "<?php echo $arrBaseUrl; ?>"
        
        $(function(){
            $("#login").click(function(){
                var user = $.trim($("#email").val())
                var password = $.trim($("#password").val())
                
                if(user != "" && password != ""){
                    $.ajax({
                        type: "POST",
                        url: strBaseUrl+"/mybook/login/userlogin",
                        data: "user="+user+"&password="+password,
                        async: false,
                        success:  function(objResult){
                            if(objResult == "SUCCESS"){
                                window.location.href = "mybook"
                            }
                        }
                    });
                }
            })
        })
    </script>
  </head><body>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="media-list">
              <li class="media">
                <div class="media-body">
                  <h2 class="media-heading text-center text-primary">User Login</h2>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4 text-center">
            <form class="form-horizontal" role="form">
              <div class="form-group has-feedback">
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" autocomplete="off" placeholder="Email">
                  <span class="fa fa-user form-control-feedback"></span>
                </div>
              </div>
              <div class="form-group has-feedback">
                <div class="col-sm-12">
                  <input type="password" class="form-control" id="password" placeholder="Password">
                  <span class="fa fa-lock form-control-feedback"></span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12 text-center">
                    <button type="button" class="btn btn-primary" id="login">Login</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
    </div>
  

</body></html>