//This method removes unwanted get parameter from the data.
function __datatable_ajax_callback(data){
    for (var i = 0, len = data.columns.length; i < len; i++) {
        if (! data.columns[i].search.value) delete data.columns[i].search;
        if (data.columns[i].searchable === true) delete data.columns[i].searchable;
        if (data.columns[i].orderable === true) delete data.columns[i].orderable;
        if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
    }
    delete data.search.regex;

    return data;
}

$(document).ready(function() {



    $("#task-complexity").on('change', function (event) {

            if ($("#task-complexity").find(":selected").text() === "Repetitive") {

                $("#task-type").css('display', '');
                $("#day-task").css('display', 'none');

            }else if($("#task-complexity").find(":selected").text() === "Non-Repetitive"){

                $("#task-type").css('display', 'none');
                $("#day-task").css('display', '');
                $(".day_single_month").css('display', 'none');
                $(".month_year").css('display', 'none');
                $("#monthly_checkbox").css('display', 'none');
                $("#weekly_checkbox").css('display', 'none');
                $(".time").css('display', '');

            }

    });


    //show checkbox if tasks are selected as weekly

    $("#task_type").on('change', function (event) {

        if ($("#task_type").find(":selected").text() === "Daily") {

            $("#monthly_checkbox").css('display', 'none');
            $(".month_year").css('display', 'none');
            $(".time").css('display', '');

            
        }else if ($("#task_type").find(":selected").text() === "Weekly") {

            $("#weekly_checkbox").css('display', '');
            $(".time").css('display', '');

            $("#monthly_checkbox").css('display', 'none');
            $(".month_year").css('display', 'none');
            $(".time").css('display', '');


        }else if($("#task_type").find(":selected").text() === "Monthly"){
            $("#weekly_checkbox").css('display', 'none');
            $(".time").css('display', '');

            $("#monthly_checkbox").css('display', '');
        
        }

});

//check if the monthly check box has been selected and display according to the choice
    $('input[name="monthly_checkbox"]').on('change', function() {

        if($('input[name="monthly_checkbox"]:checked').val() === 'Once every month'){
           
            $(".day_single_month").css('display', '');
            $(".time").css('display', '');

           
            $(".month_year").css('display', 'none');


        }else if($('input[name="monthly_checkbox"]:checked').val() ==='Once a month each year'){

            $(".day_single_month").css('display', 'none');
            $(".month_year").css('display', '');
            $(".time").css('display', '');


        }

    });
//daterangepicker


selected_record = (data) => {

    record = JSON.parse(data);

      $('input[name="record_id"]').val(record['id']);

  }

    $('#monthly_once').daterangepicker({
       
        singleDatePicker: true,
    showDropdowns: true,
        hideIfNoPrevNext: true,
        dateFormat: 'mm/dd',
        changeYear: false


    });

    $('#monthly_once_and_day').daterangepicker({
       
        singleDatePicker: true,
             showDropdowns: true,
        hideIfNoPrevNext: true,
        dateFormat: 'mm/dd',
        changeYear: false
    });

    //hide month if it is monthly once
$('.daterangepicker select.monthselect ').css('display','none');



        //get list of tasks in form of datatables


        $('#task_filter').on('change', function() {

           
            var data= {'tasks_filter': $('#task_filter').val()}
             
                $.ajax({
                    method: 'GET',
                    url: 'tasks_tomorrow',
                    data: data,
                    dataType: 'html',
                    success: function(result) {
                        console.log(result)
                        $('#new_table').html(result);
                        $('#old_table').html('');
            
            
            
                    }, 
                });
            
            });


  
});

