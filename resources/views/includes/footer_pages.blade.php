<!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> {{date("Y")}} &copy; IEI Anchor Pensions

        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->

<!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('/assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
		<script src="{{asset('/assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/pages/scripts/form-validation.min.js')}}" type="text/javascript"></script>        
        
        <script src="{{asset('/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('/assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('/assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script> 
        <script src="{{asset('/assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/js_handler.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('/assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <!--summernote-->
        <script src="{{asset('/assets/summernote/summernote.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        
        <script type="text/javascript">
            
            $(document).ready(function(){
                $('.summer_details').summernote({
                    placeholder: 'Type the details...',
                    tabsize: 2,
                    height: 200,
                    toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                  ]
                });
                
                

                //fetch specific content & display in form
                $('body').on('click','.clicked_button',function(){
                    var $this =$(this);
                    var type=$this.parents('.bordered').children('.portlet-body').find('#type').val();
                    console.log('type '+type);
                    //hidden fields vars
                    var title_field="#"+type+"_title";
                    var id_field="#"+type+"_id";
                    var type_field="#type";
                    var position_field="#"+type+"_position";
                    var display_field="#"+type+"_display";
                    var details_field="#"+type+"_details";
                    console.log('details_field '+details_field);
                    
                    //form fields vars
                    var form_id="#"+type+"_form #id";
                    console.log('form_id '+form_id);
                    var form_title="#"+type+"_form #title";
                    console.log('form_title '+form_title);
                    var form_type="#"+type+"_form #type";
                    console.log('form_type '+form_type);
                    var form_position="#"+type+"_form #position";
                    console.log('form_position '+form_position);
                    var form_details="#"+type+"_form #details";
                    console.log('form_details '+form_details);
                    var form_display_yes="#"+type+"_form #display_yes";
                    console.log('form_display_yes '+form_display_yes);
                    var form_display_no="#"+type+"_form #display_no";
                    console.log('form_display_no '+form_display_no);
                    var form_display="#"+type+"_form #display";
                    console.log('form_display '+form_display);
                    //get values from hidden fields
                    var title_val=$this.parents('.bordered').children('.portlet-title').find(title_field).text();
                    var id_val=$this.parents('.bordered').children('.portlet-body').find(id_field).val();
                    var type_val=$this.parents('.bordered').children('.portlet-body').find(type_field).val();
                    var position_val=$this.parents('.bordered').children('.portlet-body').find(position_field).val();
                    var display_val= $this.parents('.bordered').children('.portlet-body').find(display_field).val();
                    var details_val =$this.parents('.bordered').children('.portlet-body').find(details_field).html();
                    
                    console.log('pos '+position_val);
                    console.log('display '+display_val);
                    console.log('title_val '+title_val);
                    console.log('details_val '+details_val);
                    console.log('type_val '+type_val);
                    //assign values got from hidden fields to form fields
                    $(form_id).val(id_val);
                    $(form_type).val(type_val);
                    $(form_title).val(title_val);
                    $(form_position).val(position_val);
                    
                    if(display_val==1){
                        console.log('display is 1 ');
                        $(form_display_yes).prop('checked', true);
                    }else{
                        $(form_display_no).prop('checked', true);
                        console.log('display is 0 ');
                    }
                    $(form_display).text(display_val);
                    //$(form_details).text(details_val).focus();
                    $(form_details).summernote('code', details_val);
                    console.log('details val '+details_val);
                });
                
                $('body').on('click','.del_button',function(){
                    var $this = $(this);
                    var type_val=$this.parents('.bordered').children('.portlet-body').find('#type').val();
                    console.log('type_val '+type_val);
                    var delete_id='#'+type_val+'_id';
                    var delete_form_id='#'+type_val+'_delete_form #id';
                    var delete_modal='#'+type_val+'_delete_modal';
                    console.log('delete_id '+delete_id);
                    console.log('delete_form_id '+delete_form_id);
                    console.log('delete_modal '+delete_modal);
                    console.log('id to delete '+id_val);
                    var id_val=$this.parents('.bordered').children('.portlet-body').find(delete_id).val();
                    console.log('id to delete '+id_val);
                    $(delete_form_id).val(id_val);
                    $(delete_modal).modal({backdrop:false,keyboard:false});
                });
                
                /*for pages that use tables*/
                $('body').on('click','.new_item',function(){
                    var form_type=$('form #type').val();
                    //console.log('row_type '+form_type);
                    var form_id="#"+form_type+"_form";
                    var form_modal="#"+form_type+"_edit_modal";
                    var form_details=form_id+" #details";
                    $(form_details).summernote('code', '');
                    $(form_id).trigger('reset');
                    $(form_modal).modal({backdrop: false, keyboard: false});
                });
                
                $('body').on('click','.delete_item',function(){//delete items
                    var row_id=$('table tbody .table_row.active input.row_id').val();
                    var row_type=$('table tbody .table_row.active input.row_type').val();
                    
                    var delete_form_id='#'+row_type+'_delete_form #id';//delete form id field
                    var delete_modal='#'+row_type+'_delete_modal';
                    console.log('row_id '+row_id);
                    console.log('delete_form_id '+delete_form_id);
                    console.log('delete_modal '+delete_modal);
                    
                    $(delete_form_id).val(row_id);
                    $(delete_modal).modal({backdrop: false, keyboard: false});
                });
                
                $('body').on('click','.edit_item',function(){
                    var row_id=$('table tbody .table_row.active input.row_id').val();
                    var row_type=$('table tbody .table_row.active input.row_type').val();
                    var row_position=$('table tbody .table_row.active input.row_position').val();
                    var row_display=$('table tbody .table_row.active input.row_display').val();
                    var row_title=$('table tbody .table_row.active .row_title').text();
                    var row_details=$('table tbody .table_row.active .row_details').html();
                    console.log('row_idss '+row_id);
                    console.log('row_type '+row_type);
                    console.log('row_position '+row_position);
                    console.log('row_display '+row_display);
                    console.log('row_title '+row_title);
                    console.log('row_details '+row_details);
                    
                    var form_id="#"+row_type+"_form";
                    var form_modal="#"+row_type+"_edit_modal";
                    
                    var form_title=form_id+" #title";
                    var id=form_id+" #id";
                    var form_type=form_id+" #type";
                    var form_position=form_id+" #position";
                    var form_display_yes=form_id+" #display_yes";
                    var form_display_no=form_id+" #display_no";
                    var form_details=form_id+" #details";
                                        
                    //set values
                    $(id).val(row_id);
                    $(form_type).val(row_type);
                    $(form_title).val(row_title);
                    $(form_position).val(row_position);
                    
                    if(row_display==1){
                        //console.log('display is 1 ');
                        $(form_display_yes).prop('checked', true);
                    }else{
                        $(form_display_no).prop('checked', true);
                        //console.log('display is 0 ');
                    }
                    
                    //$(form_details).val(row_description);
                    $(form_details).summernote('code', row_details);
                    $(form_modal).modal({backdrop: false, keyboard: false});
                });
                
                $('body').on('click','.edit_faq_item',function(){
                    var row_id=$('table tbody .table_row.active input.row_id').val();//faqid
                    var row_cat_id=$('table tbody .table_row.active input.row_cat_id').val();//faq_catid
                    var row_type=$('table tbody .table_row.active input.row_type').val();//faqtype
                    var row_title=$('table tbody .table_row.active .row_title').text();//faqcat title
                    var row_question=$('table tbody .table_row.active .row_question').text();//faq question
                    var row_details=$('table tbody .table_row.active .row_details').html();//faq answer
                    console.log('row_idss '+row_id);
                    console.log('row_type '+row_type);
                    console.log('row_title '+row_title);
                    console.log('row_question '+row_question);
                    console.log('row_details '+row_details);
                    
                    var form_id="#"+row_type+"_form";
                    var form_modal="#"+row_type+"_edit_modal";
                    
                    var form_title=form_id+" #title";
                    var form_category=form_id+" #category";
                    var id=form_id+" #id";
                    //var cat_id=form_id+" #cat_id";
                    var form_type=form_id+" #type";
                    var form_details=form_id+" #details";
                                        
                    //set values
                    $(id).val(row_id);
                    $(form_type).val(row_type);
                    $(form_title).val(row_question);
                    $(form_category).val(row_cat_id);
                    $(form_details).summernote('code', row_details);
                    $(form_modal).modal({backdrop: false, keyboard: false});
                });
                
                $('body').on('click', '.table_row', function () {
                    //select or deselect a row
                    console.log('a radio was clicked');
                    var $this = $(this);
                    $('.table_row').removeClass('active');
                    $this.addClass('active');
                    
                    var row_id=$this.find('.row_id').val();
                    var row_type=$this.find('.row_type').val();
                    console.log('row_id '+row_id);
                    console.log('row_type '+row_type);
                    if(row_type==="ref_states_teams"){
                        var row_team_code=$this.find('.row_team_code').val();
                        var row_team_name=$this.find('.row_team_name').val();
                        var row_contact_email=$this.find('.row_contact_email').val();

                        console.log('row_id '+row_id);
                        console.log('row_type '+row_type);
                        console.log('row_team_code '+row_team_code);
                        console.log('row_team_name '+row_team_name);
                        console.log('row_contact_email '+row_contact_email);

                        var formid="#"+row_type+"_form";
                        console.log('formid '+formid);
                        var field_id=formid+" #id";
                        $(field_id).val(row_id);

                        var field_team_name=formid+" #team_name";
                        $(field_team_name).val(row_team_name);

                        var field_team_code=formid+" #team_code";
                        $(field_team_code).val(row_team_code);

                        var field_contact_email=formid+" #contact_email";
                        $(field_contact_email).val(row_contact_email);

                        var field_delete="#delete_modal #delete_form #id";
                        $(field_delete).val(row_id);
                        
                    }else if(row_type==="role"){
                        $('#id').val(row_id);
                        var row_title=$this.find('.row_title').val();
                        $('#title').val(row_title);
                        console.log('row_title '+row_title);
                        
                        var row_description=$this.find('.row_description').val();
                        $('#description').val(row_description);
                        console.log('row_description '+row_description);
                        
                        var row_users=$this.find('.row_users').val();
                        $('#user').val(row_users);
                        console.log('row_users '+row_users);
                        
                        var row_delete_group=$this.find('.row_delete_group').val();
                        console.log('row_delete_group '+row_delete_group);
                        $('#delete_group').val(row_delete_group);
                        
                        var row_roles=$this.find('.row_roles').val();
                        console.log('row_roles '+row_roles);
                        $('#role').val(row_roles);
                        
                        var row_management=$this.find('.row_management').val();
                        console.log('row_management '+row_management);
                        $('#management').val(row_management);
                        
                        var row_board=$this.find('.row_board').val();
                        console.log('row_board '+row_board);
                        $('#board').val(row_board);
                        
                        var row_newsitem=$this.find('.row_newsitem').val();
                        console.log('row_newsitem '+row_newsitem);
                        $('#newsitem').val(row_newsitem);
                        
                        var row_article=$this.find('.row_article').val();
                        console.log('row_article '+row_article);
                        $('#article').val(row_article);
                        
                        var row_faq=$this.find('.row_faq').val();
                        console.log('row_faq '+row_faq);
                        $('#faq').val(row_faq);
                        
                        var row_banner=$this.find('.row_banner').val();
                        console.log('row_banner '+row_banner);
                        $('#banner').val(row_banner);
                        
                        var row_slide=$this.find('.row_slide').val();
                        console.log('row_slide '+row_slide);
                        $('#slide').val(row_slide);
                        
                        var row_state=$this.find('.row_state').val();
                        console.log('row_state '+row_state);
                        $('#state').val(row_state);
                        
                        var row_award=$this.find('.row_award').val();
                        console.log('row_award '+row_award);
                        $('#award').val(row_award);
                        
                        var row_testimonial=$this.find('.row_testimonial').val();
                        console.log('row_testimonial '+row_testimonial);
                        $('#testimonial').val(row_testimonial);
                        
                        var row_service=$this.find('.row_service').val();
                        console.log('row_service '+row_service);
                        $('#service').val(row_service);
                        
                        var row_about=$this.find('.row_about').val();
                        console.log('row_about '+row_about);
                        $('#about').val(row_about);
                        
                        var row_reports=$this.find('.row_reports').val();
                        console.log('row_reports '+row_reports);
                        $('#report').val(row_reports);
                    }
                    
                });
                
            });
        
        </script>
        
        

</body>

</html>