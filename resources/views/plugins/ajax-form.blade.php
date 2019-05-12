@push('scripts')
<script>
$(document).ready(function(ev){     
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("form[data-form-ajax='true']").on("submit", function (e) {
        console.log(this);
        e.preventDefault();
        let form = $(this);
        let fieldset = $(this).find("fieldset");
        var postData = new FormData(this);
        var form_id = $(this).attr('id');
        var dataTable = $(this).data('reload-datatables');
        var toogleModal = $(this).data('modal-target');
        var reset = $(this).data('reset');
        var call_function = $(this).data('after-success-function');
        console.log(form);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: postData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend:function(){
                fieldset.prop("disabled",true);
            },
            success: function (response) {
                if(reset !== undefined){
                    if(reset){
                        if(response.status == 'success'){
                            form.trigger('reset');
                        }
                    }
                }
                if(call_function != undefined){
                    console.log(call_function);
                    window[call_function]();
                }
                console.log(response.status);

                    Swal.fire({
                        type:response.status,
                        title:response.title,
                        html:response.msg,
                        showConfirmButton: true
                    })
                if(dataTable !== undefined){
                    $("table"+dataTable).DataTable().ajax.reload( null, false );
                }
            },error: function(textStatus, errorThrown){
                Swal.fire({
                    type: 'error',
                    title: "Ada kesalahan,Silahkan input Ulang",
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            complete:function(){
                fieldset.prop("disabled",false);
            }
        });
    });

    
    /*
    $('.modal').on('shown.bs.modal', function (event) {
        var triggerElement = $(event.relatedTarget);
        var table = triggerElement.parent().data('table-target');
        //clearMsg(table);
    })*/
});</script>
@endpush