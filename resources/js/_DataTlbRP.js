class _DataTlbRP
{

    static getDataTbl(request, colspan)
    {
        let processing = $("#statistic-grid_processing");
        $('#statistic-grid').DataTable( {
            "processing": false,
            "serverSide": true,
            /*"initComplete": function() {
               $("#statistic-grid_processing").css("display","none");
            },*/
            "ajax":{
                url :"../models/inc/getRequest" + request + ".php",
                type: "post",
                beforeSend: ()=> {
                    if ( processing.length == 0 ) {
                        $("#statistic-grid").prepend('<tbody id="statistic-grid_processing"><tr><th colspan="'+ colspan +'"><div id="loading_ajx"><div class="icon-spinner r-spin"></div>&nbsp;&nbsp;<?php echo $loading; ?></div></th></tr></tbody>');
                    } else {
                        $("#statistic-grid_processing").css("display","table-row-group");
                    }
                },
                error: ()=> {
                    $(".statistic-grid-error").html("");
                    $("#statistic-grid").append('<tbody class="statistic-grid-error"><tr><th colspan="'+ colspan +'">No data found in the server</th></tr></tbody>');
                    processing.css("display","none");
                }
            }
        } );
    }

}
