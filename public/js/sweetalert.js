$(document).ready(function(){
    $('.delete_form').click(function(event){
     
        var name = $(this).data("name");
        var form = $(this).closest("form");
        event.preventDefault();
        swal({
            title:`คุณต้องการลบข้อมูล ${name} ใช่หรือไม่ ?`,
            text:"ถ้าลบแล้วไม่ามารถกู้คืนได้",
            icon:"warning",
            buttons:true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                form.submit();
            }
        });
    });
});