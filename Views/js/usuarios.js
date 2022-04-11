$(".nuevaFoto").change(function() {
  var imagen = this.files[0];  
	console.log ("imagen",imagen);
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
        {
            console.log("Error tipo de archivo"); 
            $("#foto").val("");
            Swal.fire({
                icon: "error",
                title: "La imagen debe ser png o jpg",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"    
            });
        }
    else if(imagen["size"] > 2097152){
        $("#foto").val("");
        Swal.fire({
                icon: "error",
                title: "No debe ser mayor de 2MB",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"    
            });
    }
    else{
        var datosImg = new FileReader;
        datosImg.readAsDataURL(imagen);
        $(datosImg).on("load", function(e){
            var ruta = e.target.result;
            $(".preview").attr("src",ruta);
        })
    }
})
