$(function(){
    $(document).on('click', '#bt-gt-sgn', function(){
        let dt_nasc = $('#gt-dt-nasc').val();
        // console.log(dt_nasc);
        $.ajax({
            url: 'api.php',
            type: 'post',
            dataType: 'json',
            data: {dt_nasc: dt_nasc},
            success:function(rs){
                bootbox.dialog({
                    size:'small',
                    title:'Seu signo é',
                    message: rs[0],
                    backdrop: true,
                    closeButton: false,
                    buttons:{
                        ok:{
                            label:'Ok',
                            className: 'btn-dark'
                        }
                    }
                })
                // console.log(rs);
            },
            error: function(e){
                bootbox.alert({
                    size:'small',
                    title: 'Erro :(',
                    message: e.responseText,
                    backdrop: true,
                    closeButton: false,
                    buttons:{
                        ok:{
                            label:'Ok',
                            className: 'btn-dark'
                        },
                    }
                })
                // console.error(e);
                
            }
        })
    })

});