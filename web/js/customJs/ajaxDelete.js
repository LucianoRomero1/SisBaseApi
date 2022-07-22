function ajaxDelete(id, path) {
    //Envío el path de cada DELETE para usar esta única función y no crear varias iguales
    Swal.fire({
        title: '¿Está seguro/a que desea eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: 'Aceptar'   
    }).then((result) => {
        if (result.isConfirmed) {
            
            let fd = new FormData();
            fd.append('id' , id);
            let url =  path + id;
            $.ajax
            ({
                method: 'POST',
                url: url,
                data: fd,
                processData: false,
                contentType: false,

                success: function (res)
                {
                    if(res.success){
                        Swal.fire({
                            icon: 'success',
                            title: 'Se eliminó correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){location.reload()}, 1500);
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡Algo salió mal!',
                        })
                    }
                }
            });
        }
    })
}