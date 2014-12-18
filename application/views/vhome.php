<?php

/* 
 * Copyright © 2012 - 2013 D2Real Solutions.
 * All Rights Reserved.
 * 
 * These materials are unpublished, proprietary, confidential source code of
 * D2Real Solutions (pvt) Limited and constitute a TRADE SECRET of D2Real Solutions (pvt) Limited.
 * 
 * Creater : Srimal Priyanga < s.priyanga22@gmail.com >
 * Created on : Sep 1, 2014, 8:33:32 PM
 */
?>
<?php if (isset($this->session->userdata['load_model']) && $this->session->userdata['load_model'] == TRUE) { ?>
<body onload="$('#user_not_registered').modal('show');" style="margin-bottom: 60px; background: url('assets/img/bg2.jpg') no-repeat #f8f7fa;"> <!--Don't Close body tag within this page--> 
<?php $this->session->set_userdata('load_model', FALSE); }  else { ?>
<body style="margin-bottom: 60px; background: url('assets/img/bg2.jpg') no-repeat #f8f7fa;"> <!--Don't Close body tag within this page--> 
<?php }?>

    <script>
        document.body.style.backgroundPosition = "0% -95%";
    </script>
    <div class="container">
        <div class="row"> <!--Header menu start-->
            <div class="col-xs-11">
                <ul class="list-inline pull-right">
                    <li><a href="#">Sinhala</a></li>
                    <li><a href="#">Tamil</a></li>
                    <li><a href="#" class="text-success">English</a></li>
                    <li><a href="#">Help <img src="assets/img/help.png" title="Click to get Help !" style="width: 30px"/></a></li>
                </ul>
            </div>
        </div>
        <div class="row"> <!--Search box start-->
            <div class="col-md-8 col-md-offset-2 col-xs-12 search-box">
                <h1 class="text-center"><span style="color: #0099cc">Exam</span> <span style="color: #00ccff">Results</span> <small>in Sri Lanka</small></h1>
                <form role="form" class="form" method="POST" action="<?php echo base_url().'result';?>">
                    <div class="input-group input-group-lg">
                        <input type="text" name="studentId" class="form-control" placeholder="Enter your index number" required />
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="home-footer"> <!--Footer bar start-->
        <div class="col-lg-7 col-md-7 col-xs-7">
            <p>Exam Marks Management System Copyright &COPY; 2014</p>
        </div>
        <div class="col-lg-5 col-md-5 col-xs-5">
            <ul class="list-inline pull-right">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
    </div>
    
<!-- User Not Registered Modal Start-->
<div class="modal fade" id="user_not_registered" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="color: #ff0066">Index number not valid...</h4>
            </div>
            <div class="modal-body">
                <p>Sorry you are not a registered user.</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="" id="mdeleteform">
                <!--<input type="hidden" value="" id="modal_assignment_id" name="modal_assignment_id"/>-->
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                <!--<button type="submit" class="btn btn-danger">Yes</button>-->
                </form>
            </div>
        </div>
    </div>
</div> 
<!-- User Not Registered Modal End-->

    <!-- JavaScript -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    
    </body>
</html>
        
