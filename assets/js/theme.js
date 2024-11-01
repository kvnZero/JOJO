( function( $, ) {

    let list_query = {
        'default': {
            page: 1,
            total: 0,
            form: "",
            last_timeout_id: null
        }
    }

    $('document').ready(function() {

        if($('#job-list-id_default').length){
            load_job_list('default', 1)
        }

        $('form[class="form-monitor"]').on('input change', 'input, select', function(event) {
       
            let form_el = $(this).closest('form')
            let position = form_el.attr('id').replace('job-list-', '')
            if(list_query[position].last_timeout_id){
                clearTimeout(list_query[position].last_timeout_id)
                list_query[position].last_timeout_id = null
            }
            form = $(form_el).serialize()

            if (form != list_query[position].form){
                list_query[position].last_timeout_id = setTimeout(function(){
                    load_job_list(position, 1)
                    list_query[position].last_timeout_id = null
                }, 1000)
            }
        });

        $('#lang-form a').on('click', function(event) {
            if($(this).data('value')){
                $('input[name=wp_lang]').val($(this).data('value'))
                let form_el = $(this).closest('form')
                $(form_el).submit()
            }
        });

        $('#job-list-id_default').on('click', '#job-list-pagination-default .page-item', function(e){
            if($(this).hasClass("disabled") || $(this).hasClass("active")){
                return;
            }
            page = $(this).data('page')
            load_job_list('default', page)
        });
    })

    function load_job_list(position = 'default', page = 1)
    {
        jojo_loading()
        let form_el = $('#job-list-'+position)
        list_query[position].form = $(form_el).serialize()
        list_query[position].page = page

        let query_args    = {}
        query_args.filter = $(form_el).serializeArray()
        query_args.page   = page

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: "job_list_ajax_request",
                data: query_args            
            },
            success: function (response) {
                $('#job-list-id_'+position).html(response)
                list_query[position]['total'] = $('#job-list-id_'+position+' > .job-list-total').val()
            },
        }).always(function(){
            jojo_loading_end()
        });
    }


}( jQuery) );

let jojo_loading_time = 0;
let jojo_loading_controller = false;

function jojo_loading()
{
    if(jojo_loading_controller){
        return
    }
    jojo_loading_controller = true
    jQuery('.loading').addClass('d-flex').removeClass('d-none')
    jojo_loading_time = new Date().getTime()
    setTimeout(function(){
        let current_time = jojo_loading_time
        jojo_loading_end(current_time)
    }, 3000)
}

function jojo_loading_end(time = 0)
{
    if(time && jojo_loading_time != time){
        return -1
    }
    jojo_loading_controller = false
    jQuery('.loading').removeClass('d-flex').addClass('d-none')
}
