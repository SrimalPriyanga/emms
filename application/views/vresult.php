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
<?php if ($this->session->userdata['load_model'] == TRUE) { ?>
    <body onload="$('#result_not_found').modal('show');"> <!--Don't Close body tag within this page--> 
        <?php $this->session->set_userdata('load_model', FALSE);
    } else { ?>
    <body> <!--Don't Close body tag within this page--> 
<?php } ?>
    <div class="container">
        <div class="row  well"> <!--Header menu start-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--<div class="row">-->
                <div class="pull-left">
                    <h1 class="text-primary"><a href="<?php echo base_url(); ?>" class="font-roboto"><span style="color: #0099cc">Exam</span> <span style="color: #00ccff">Results</span></a> <small>in Sri Lanka</small></h1>
                </div>
                <ul class="list-inline pull-right">
                    <li><a href="#">Sinhala</a></li>
                    <li><a href="#">Tamil</a></li>
                    <li><a href="#" class="text-success">English</a></li>
                    <li><a href="#">Help <img src="<?php echo base_url(); ?>assets/img/help.png" title="Click to get Help !" style="width: 30px"/></a></li>
                </ul>
                <!--</div>-->
            </div>
        </div>
        <div class="row"> <!--page Content start-->
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 user-wrap">
                <div class="row" style="margin-bottom: 0px">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <div class="table-responsive">
                                <table class="table" style="border: 0;">
                                    <tr>
                                        <td style="border: 0;"><img class="img-responsive user" src="<?php echo base_url(); ?>assets/img/user.png" /></td>
                                        <td style="border: 0; padding-top: 17px">
                                            <p>NSI : <b><?php echo $this->session->userdata['user_nsi']; ?></b> <br />
                                                <?php if (isset($content)) { ?>
                                                    Class : <span class="font-roboto">Grade <?php echo $content[0]->grade_num . '-' . $content[0]->grade_letter; ?> <small>Term: <?php echo $content[0]->term; ?></small></span>
                                                    <br />
                                                    Name : <span class="font-roboto"><?php echo $this->session->userdata['user_name']; ?> </span>
                                                    <br />
                                                    School : <span class="font-roboto"><?php echo $this->session->userdata['user_school']; ?> </span>
                                                <?php } ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="pull-right">
                            <h4 class="text-info"><b>Find your previous result</b></h4>
                            <form id="" class="form-inline" action="<?php echo base_url(); ?>result/previous_results" method="POST">
                                <label>Grade :</label>
                                <select name="selected_grade" class="form-control">
                                    <?php
                                    for ($i = 1; $i < 14; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>

                                <label>Term :</label>
                                <select name="selected_term" class="form-control">
                                    <?php
                                    for ($i = 1; $i < 4; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-default">Find</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="text-info">Result of Grade: <b><?php echo $content[0]->grade_num; ?></b> , Term: <b><?php echo $content[0]->term; ?></b></h4>
                        <div class="table-responsive" style="background: #ECECEC;">
                            <table class="table table-hover">
                                <tr class="info">
                                    <th>Subject ID</th>
                                    <th>Subject</th>
                                    <th>Marks</th>
                                    <th>Grade</th>
                                </tr>

                                    <?php $total_marks = 0;
                                    $subject_count = 0;
                                    if (isset($content)) : foreach ($content as $row):
                                            ?>
                                        <tr>
                                            <td><?php $subject_count++;
                                            echo '<small>' . $subject_count . '.' . '</small> ' . $row->subject_id; ?></td>
                                            <td><?php echo $row->subject_name; ?></td>
                                            <td><?php echo round($row->marks, 2); $total_marks+= $row->marks ?></td>
                                            <?php $obj_result = new Result ?>
                                            <td><?php echo $obj_result->check_Grade(round($row->marks, 2)); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <tr class="success">
                                    <th>Rank: 1</th>
                                    <th><span class="pull-right">Total:</span></th>
                                    <th><span class="pull-left"><?php echo round($total_marks, 2); ?></span> <span class="pull-right">Avg:</span></th>
                                    <th><?php echo round($total_marks / $subject_count, 2) ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs" style="background: #ffffff; margin-left: 20px;">
                <!--Div that will hold the pie chart-->
                <div id="chart_div" style="width: 350px; height: 250px;"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12" style=" padding: 0; margin-bottom: 15px">
                <div id="chart_div2" style="width: 100%; height: 415px; opacity: 0.8;"></div>
            </div>
        </div>
    </div>

    <!-- Result not found under selected Grade & Term Modal Start-->
    <div class="modal fade" id="result_not_found" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #ff0066">You have not any results under selected Grade & Term</h4>
                </div>
                <div class="modal-body">
                    <p>Sorry there is no Records(results) under the Grade & Term that you are selected. Please try with another.</p>
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
    <!-- Result not found under selected Grade & Term Modal End-->