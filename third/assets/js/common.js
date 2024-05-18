$(document).ready(function(e) {
	$('[data-toggle="popover"]').popover({ html : true });
	$('[data-toggle="tooltip"]').tooltip();
	$('.collapse').collapse();

	/*	GOGO: country selectable : register
	--------------------------------------------------*/
	//County Selectable
	getCounty();
    $("#counties").bind('change',getTown);

    //County Selectable 2
    getCounty_2();
    $("#place_of_issue_county").bind('change',getTown_2);

    //County Selectable 3
    getCounty_3();
    $("#population_county").bind('change',getTown_3);

    /*	GOGO: country selectable : update
	--------------------------------------------------*/
	//County Selectable
	getCountyUpdate();
    $("#counties").bind('change',getTownUpdate);

    //County Selectable 2
    getCountyUpdate_2();
    $("#place_of_issue_county").bind('change',getTownUpdate_2);

    //County Selectable 3
    getCountyUpdate_3();
    $("#population_county").bind('change',getTownUpdate_3);

    /*	GOGO: number limit input
	--------------------------------------------------*/
	$("#tcno").keyup(function() {
		$("#tcno").val(this.value.match(/[0-9]*/));
	});
	$("#skin_no").keyup(function() {
		$("#skin_no").val(this.value.match(/[0-9]*/));
	});
	$("#family_order_no").keyup(function() {
		$("#family_order_no").val(this.value.match(/[0-9]*/));
	});
	$("#house_no").keyup(function() {
		$("#house_no").val(this.value.match(/[0-9]*/));
	});
	$("#mobile").keyup(function() {
		$("#mobile").val(this.value.match(/[0-9]*/));
	});
	$("#parent_mobile_1").keyup(function() {
		$("#parent_mobile_1").val(this.value.match(/[0-9]*/));
	});
	$("#parent_mobile_2").keyup(function() {
		$("#parent_mobile_2").val(this.value.match(/[0-9]*/));
	});

	/*	GOGO: check tc number
	--------------------------------------------------
	Register page */
	$("#tcno").change(function() {
		$.post('login/checkTC',{tcno: $(this).val()},function(output){
			$("#wrongTC").html(output);
		});	
	});
	/* Login page */
	$(".tcno").keyup(function() {
		//Clear default validate
		$('p.validtext').html('');

		$.post('login/checkTC',{tcno: $(this).val()},function(output){
			$("#wrongTC").html(output);

			var bool = $('#bool').html();

			if (bool == 0) {
				$('#form-login #formvalid').attr('disabled', true);
			}else {
				$('#form-login #formvalid').attr('disabled', false);
			};
		});
		$.post('login/checkRegisteredUser',{tcno: $(this).val()},function(output){
			$("#registered").html(output);

			var bool_2 = $('#bool_2').html();

			if (bool_2 == 0) {
				$('#form-login #formvalid').html('Kayıt ol');
			}else {
				$('#form-login #formvalid').html('Giriş yap');
			};
		});
	});

	/*  CHANGE: Button text
  	--------------------------------------------------*/
	$("button[data-loading-text]")
		.click(function() 
		{
			var $btn = $(this);
			$btn.button('loading');
			// simulating a timeout
			setTimeout(function () {
				$btn.button('reset');
			}, 1000);
		});

	/*	GOGO: show upload pic
	--------------------------------------------------*/
	var showpic = $(".showpic");
	$(".showpic").change(function(event){
		var input = $(event.currentTarget);
		var file = input[0].files[0];
		var reader = new FileReader();

		reader.onload = function(e){
			image_base64 = e.target.result;
			showpic.html("<img width='135px' height='175px' src='"+image_base64+"' style=\"border: 1px solid #ccc; padding: 2px;\" />");
		};
		reader.readAsDataURL(file);
	});

	/*	GOGO: filter student
	--------------------------------------------------*/
    $("#filterType")
	    .change(function () {
	    	var filterText = $('.filterText');

	    	if ($(this).val() == 'group')
	    	{
	    		//Show hide textbox
				$('#filterGroup').removeClass('hidden');
				$('#filterTeacher').addClass('hidden');
				$('#filterBirthyear').addClass('hidden');
				$('#filterLisance').addClass('hidden');
				$('#filterSorthbirt').addClass('hidden');

				//Clear input values
				$(".filterText input").val('');

				//Clear post data container
				$('#filterLoad').removeClass('hidden').html('<i class="fa fa-info-circle"></i> Listelenecek veri bulunamadı.');
	    	}
	    	else if ($(this).val() == 'birthyear')
	    	{
	    		//Show hide textbox
				$('#filterBirthyear').removeClass('hidden');
				$('#filterGroup').addClass('hidden');
				$('#filterTeacher').addClass('hidden');
				$('#filterLisance').addClass('hidden');
				$('#filterSorthbirt').addClass('hidden');

				//Clear input values
				$(".filterText input").val('');

				//Clear post data container
				$('#filterLoad').removeClass('hidden').html('<i class="fa fa-info-circle"></i> Listelenecek veri bulunamadı.');
	    	}
	    	else if ($(this).val() == 'teacher')
	    	{
	    		//Show hide textbox
				$('#filterTeacher').removeClass('hidden');
				$('#filterGroup').addClass('hidden');
				$('#filterBirthyear').addClass('hidden');
				$('#filterLisance').addClass('hidden');
				$('#filterSorthbirt').addClass('hidden');

				//Clear input values
				$(".filterText input").val('');

				//Clear post data container
				$('#filterLoad').removeClass('hidden').html('<i class="fa fa-info-circle"></i> Listelenecek veri bulunamadı.');
	    	}
	    	else if ($(this).val() == 'lisance')
	    	{
	    		//Show hide textbox
				$('#filterLisance').removeClass('hidden');
				$('#filterGroup').addClass('hidden');
				$('#filterBirthyear').addClass('hidden');
				$('#filterTeacher').addClass('hidden');
				$('#filterSorthbirt').addClass('hidden');

				//Clear input values
				$(".filterText input").val('');

				//Clear post data container
				$('#filterLoad').removeClass('hidden').html('<i class="fa fa-info-circle"></i> Listelenecek veri bulunamadı.');
	    	}
	    	else if ($(this).val() == 'sortbirth')
	    	{
	    		//Show hide textbox
				$('#filterSorthbirt').removeClass('hidden');
				$('#filterGroup').addClass('hidden');
				$('#filterBirthyear').addClass('hidden');
				$('#filterTeacher').addClass('hidden');
				$('#filterLisance').addClass('hidden');

				//Clear input values
				$(".filterText input").val('');

				//Clear post data container
				$('#filterLoad').removeClass('hidden').html('<i class="fa fa-info-circle"></i> Listelenecek veri bulunamadı.');
	    	}
	    	else {
	    		filterText.addClass('hidden');
	    	}
	    });

	//Filter student post data
	$(".filterText input")
		.keyup(function() {
			if ($(this).val()) {
				if ($('#filterType').val() == 'group')
		    	{
		    		$.post('filter_group', $(this).serialize(), function(output){
						$('#filterLoad').html(output);
					});
		    	}
		    	else if ($('#filterType').val() == 'birthyear')
		    	{
		    		$.post('filter_birthyear', $(this).serialize(), function(output){
						$('#filterLoad').html(output);
					});
		    	}
		    	else if ($('#filterType').val() == 'teacher')
		    	{
		    		$.post('filter_teacher', $(this).serialize(), function(output){
						$('#filterLoad').html(output);
					});
		    	}
			};
		});

	//Change lisance selectbox
	$("#filterLisance")
	    .change(function () {
	    	$.post('filter_lisance', $('#filterForm').serialize(), function(output){
				$('#filterLoad').html(output);
			});
	    });

	//Simple filter group
	$("#simpleFilterGroup")
		.keyup(function() {
			var filter = $(this).val();

			$( "#gallery li" ).addClass('hidden');
			$( "#gallery li" ).each(function() {
				var sencFilter = $(this).data('filter');

				if (filter == sencFilter) {
					$(this).removeClass('hidden').data('filter');
				}else if (filter == ''){
					$(this).removeClass('hidden');
				};
			});
		});

	//Filter sorth birthdate
	var firstAge;
	$("#filterSorthbirt_1")
	    .change(function () {
	    	firstAge = $("#filterSorthbirt_1").val();

	    	$('#filterTitle').html('<span style="color:#A7A280"><i class="fa fa-info-circle"></i> SONUÇ:</span> <u>'+$("#filterSorthbirt_1").val()+'</u>');
	    	$('#filterLoad').html('<i class="fa fa-info-circle"></i> Lütfen ikinci değeri seçin.');
				
			$("#filterSorthbirt_2").prop('disabled', false);
	    });
	$("#filterSorthbirt_2")
	    .change(function () {
	    	$.post('filter_sortbirth_1', $(this).serialize(), function(output){
				$('#filterLoad').html(output);
				$('#filterTitle').append(' VE <u>'+$("#filterSorthbirt_2").val()+'</u> ARASINDAKİ SPORCULAR.');

				$('.first-value').attr('selected', 'selected');
				$("#filterSorthbirt_2").prop('disabled', true);
			});
	    });

	/*	GOGO: form validation
	--------------------------------------------------*/
	function validate_error(t, m, v)
	{
		//Success to error
		var returned = t.addClass('has-error');

		if (v!='single') {
			//Multiple valid message
			var returned = t.children('p').removeClass('hidden').addClass('show');
			var returned = t.children('p').html(m);
		}else{
			//Single valid message
			var returned = $('#valid-single').removeClass('hidden').addClass('show').html(m);
		};

		return returned;
	}

	function validate_success(t, m, v)
	{
		//error to success
		var returned = t.removeClass('has-error');
		var returned = t.children('p').removeClass('show').addClass('hidden');

		return returned;
	}

	$('#formvalid')
		.click(function () 
		{
			var form = $(this).data('form');
			var valid_type = $('form#form-'+form).data('valid-type');
			var email_pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			
			var isValid = true;
			$('form#form-'+form+' div')
				.each(function (e) 
				{
					//Data parameters
					var validate = $(this).data('validate');
					var validtext = $(this).data('validtext');
					var second_validtext = $(this).data('second-validtext');

					//Input val
					var input = $(this).children('input,textarea').val();

					//Input type
					var type = $(this).children('input').attr('type');

					if ( (validate == 'required') && (input == '') ) {
						validate_error($(this), validtext, valid_type);
						isValid = false;
					}else if ( (validate == 'required') && (type == 'email') && (!email_pattern.test(input)) ) {
						validate_error($(this), second_validtext, valid_type);
						isValid = false;
					}else{
						validate_success($(this), null, valid_type);
					}
				});

			//Check validate
			if (isValid == false) {
				$('form#form-'+form).parent().parent().removeClass('panel-primary').addClass('panel-danger');
				return false;
			}else{
				$('form#form-'+form).parent().parent().removeClass('panel-danger').addClass('panel-primary');
				$('#valid-single').removeClass('show').addClass('hidden');

				return true;
			};
			
		});

	/* ------------------------------------------
	Custom Location
	------------------------------------------ */
	$('[data-location]')
		.click(function () {
			var href = $(this).data('location');

			return window.location.href = href;
		});

	//_blank target
	$('[data-location-blank]')
		.click(function () {
			var href = $(this).data('location-blank');

			return window.open(href,'_newtab');
		});

	/* ------------------------------------------
	Custom Location
	------------------------------------------ */
	function selectTrainingDate()
	{
		var month = $(this).val();

		$('.trainingInformationList').html( '<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>' );

		$.post('select_training_date',{month: month},function(output){
			$(".trainingInformationList").html(output);
		});
	}
	$('#selectTrainingDate').on('change', selectTrainingDate);

	/* ------------------------------------------
	Hover Menu
	------------------------------------------ */
	function hover_menu_me()
	{
		var index = $(this).index();
		$('#hover-menu-'+index).css({ 'display': 'block' });
	}
	function hover_menu_ml()
	{
		var index = $(this).index();
		$('#hover-menu-'+index).css({ 'display': 'none' });
	}
	$('.hover-box').on('mouseenter', hover_menu_me);
	$('.hover-box').on('mouseleave', hover_menu_ml);

	/*  GOGO: Check and checkall
    --------------------------------------------------*/
    $("table#contentlist #checkall").click(function () {
        if ($("table#contentlist #checkall").is(':checked')) {
            $("table#contentlist input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("table#contentlist input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    /*  GOGO: Check and checkall parents
    --------------------------------------------------*/
    $("table#contentlist_parent #checkall").click(function () {
        if ($("table#contentlist_parent #checkall").is(':checked')) {
            $("table#contentlist_parent input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("table#contentlist_parent input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

	/*  GOGO: Live search table
    --------------------------------------------------*/
    var activeSystemClass = $('.list-group-item.active');

    //something is entered in search form
    $('#system-search').keyup( function() {
       var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
        
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Aranıyor: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">Hiç kayıt bulunamadı.</td></tr>');
        }
    });

}); // END JQUERY

/*	GOGO: country selectable : register
	--------------------------------------------------*/
/* County Selectable */
function getCounty(){
	$.post('register/selectCounty',{countyID: 0},function(output){
		$("#counties").append(output);
	});	
};
function getTown(){
	if($("#counties").val() != 0){
		$.post('register/selectCounty',{countyID: $("#counties").val()},function(output){
			$("#town option").remove();
			$("#town").append(output);
		});
	}
	else{
		$("#town option").remove();
		$("#town").append('<option value="0">Önce İl Seçiniz</option>');
	}
};

/* County Selectable 2 */
function getCounty_2(){
	$.post('register/selectCounty',{countyID: 0},function(output){
		$("#place_of_issue_county").append(output);
	});	
};
function getTown_2(){
	if($("#place_of_issue_county").val() != 0){
		$.post('register/selectCounty',{countyID: $("#place_of_issue_county").val()},function(output){
			$("#place_of_issue_town option").remove();
			$("#place_of_issue_town").append(output);
		});
	}
	else{
		$("#place_of_issue_town option").remove();
		$("#place_of_issue_town").append('<option value="0">Önce İl Seçiniz</option>');
	}
};

/* County Selectable 3 */
function getCounty_3(){
	$.post('register/selectCounty',{countyID: 0},function(output){
		$("#population_county").append(output);
	});	
};
function getTown_3(){
	if($("#population_county").val() != 0){
		$.post('register/selectCounty',{countyID: $("#population_county").val()},function(output){
			$("#population_town option").remove();
			$("#population_town").append(output);
		});
	}
	else{
		$("#population_town option").remove();
		$("#population_town").append('<option value="0">Önce İl Seçiniz</option>');
	}
};

/*	GOGO: country selectable : update
	--------------------------------------------------*/
var anc = location.href.split('?');
var anc = anc[1].split('=');
/* County Selectable */
function getCountyUpdate(){
	$.post('selectCountyBirth',{countyID: 0},function(output){
		$("#counties").append(output);
	});	
};
function getTownUpdate(){
	if($("#counties").val() != 0){
		$.post('selectCountyBirth',{countyID: $("#counties").val()},function(output){
			$("#town option").remove();
			$("#town").append(output);
		});
	}
	else{
		$("#town option").remove();
		$("#town").append('<option value="0">Önce İl Seçiniz</option>');
	}
};

/* County Selectable 2 */
function getCountyUpdate_2(){
	$.post('selectCountyIssue',{countyID: 0},function(output){
		$("#place_of_issue_county").append(output);
	});	
};
function getTownUpdate_2(){
	if($("#place_of_issue_county").val() != 0){
		$.post('selectCountyIssue',{countyID: $("#place_of_issue_county").val()},function(output){
			$("#place_of_issue_town option").remove();
			$("#place_of_issue_town").append(output);
		});
	}
	else{
		$("#place_of_issue_town option").remove();
		$("#place_of_issue_town").append('<option value="0">Önce İl Seçiniz</option>');
	}
};

/* County Selectable 3 */
function getCountyUpdate_3(){
	$.post('selectCountyPopulation',{countyID: 0},function(output){
		$("#population_county").append(output);
	});	
};
function getTownUpdate_3(){
	if($("#population_county").val() != 0){
		$.post('selectCountyPopulation',{countyID: $("#population_county").val()},function(output){
			$("#population_town option").remove();
			$("#population_town").append(output);
		});
	}
	else{
		$("#population_town option").remove();
		$("#population_town").append('<option value="0">Önce İl Seçiniz</option>');
	}
};