var tabla_talleres = new Array()
var globalContador = 0
var tabla_talleres_seleccionados = new Array()
var globalIdUsuario
var tabla_mis_talleres = new Array()

$(document).ready(function()
{
    $("#enviarCorreo").click(function(_e)
    {
        send()
    })
    $("#guardar").click(function(_e)
    {
        registrar_usuario(1)
    })
    $("#guardar_usuarioFinal").click(function(_e)
    {
        registrar_usuario(2)
    })
    $("#buscar").click(function(_e)
    {
        buscar_usuario()
    })
    $("#buscar_taller").click(function(_e)
    {
        buscar_usuario_taller()
    })
    $("#body").click(function(_e)
    {
        autofocus()
    })
    $("#entradaqr").keypress(function(e)
    {
        if(e.which == 13) 
        {
            registrar_asistencia()
        }
    })
    $("#usuarioFinal").click(function(_e)
    {
        checked()
    })
})

function autofocus()
{
    $("#entradaqr").focus()
}

function registrar_usuario(_id)
{
    if(validar() == true)
    {
        var numero_cliente
        switch(_id)
        {
            case 1:
                {
                    numero_cliente = $("#cuenta").val()
                }
                break
            case 2:
                {
                    numero_cliente = 100
                }
                break
        }
        
        $("#esperar").html("<div class='loadingio-spinner-rolling-k7dywir643' style='position: absolute; top: 0; margin-left: 50%; left: -100px; margin-top: 300px; z-index: 100;'><div class='ldio-7vvtb13lcc'><div></div></div></div>")
        $('body, html').animate({ scrollTop: '0px' }, 300);
        $("#guardar").css({"display":"none"})
        $.post("funciones/registrar_usuario.php",
        {
            nombre: $("#nombre").val(),
            apellido: $("#apellido").val(),
            correo: $("#correo").val(),
            cargo: $("#cargo").val(),
            rfc: $("#rfc").val(),
            empresa: $("#empresa").val(),
            cuenta: numero_cliente,
            pais: $("#pais").val(),
            estado: $("#estado").val(),
            ciudad: $("#ciudad").val(),
            telefono: $("#telefono").val()
        },
        function(respuesta)
        {
            switch(parseInt(respuesta))
            {
                case 1:
                    {
                        generarQR()
                        $("#nombre").val("")
                        $("#correo").val("")
                        $("#cargo").val("")
                        $("#empresa").val("")
                        $("#cuenta").val("")
                        $("#pais").val("")
                        $("#estado").val("")
                        $("#ciudad").val("")
                        $("#telefono").val("")
                        $("#guardar").css({"display":"block"})
                        $("#esperar").html("")
                        alert("Registro agregado correctamente")
                        $("#info").css({"display": "none"})
                    }
                    break
                case -1:
                    {
                        $("#esperar").html("")
                        alert("El correo ya se encuentra registrado, por favor registre uno nuevo o consulte su registro en el menú principal.")
                        $("#correo").val("")
                        $("#guardar").css({"display":"block"})
                    }
                    break
                default:
                    {
                        alert("Ocurrió un error, por favor contacta al administrador\n\nError: " + respuesta)
                    }
                    break
            }
        })
    }
    else
    {
        alert("Por favor complete correctamente los campos en color rojo")
    }
}

function registrar_asistencia()
{
    $.post("funciones/registrar_asistencia.php",
    {
        lectura: $("#entradaqr").val()
    },
    function(respuesta)
    {
        var datos = JSON.parse(respuesta)
        var nombre = datos[0]["nombre"]
        var apellido = datos[0]["apellido"]
        var empresa = datos[0]["empresa"]
        var cargo = datos[0]["cargo"]
        var correo = datos[0]["correo"]
        var codigo = "<span style='font-size:40px; text-align:center; margin-top:25px; margin-bottom:63px;'>Gracias " + nombre + " por acompañarnos a SYSCOMExpo 2023 Cd. México</span>"
        $("#leyenda").html(codigo)
        $("#entradaqr").val("")
        autofocus()

        var url = "funciones/pase.php?nombre=" + nombre + "&apellido=" + apellido + "&empresa=" + empresa + "&cargo=" + cargo + "&correo=" + correo;
        window.open(url, '_blank');
    })
}

function generarQR()
{
    $.post("funciones/generarQR.php",
    {
        nombre: $("#nombre").val(),
        apellido: $("#apellido").val(),
        empresa: $("#empresa").val(),
        cargo: $("#cargo").val(),
        correo: $("#correo").val()
    },
    function(respuesta)
    {
        //console.log(respuesta)
        var datos = JSON.parse(respuesta)
        var url = datos[0]["url"]
        var codigo = "" +
        "<img style='margin-top:25px;' class='qr' src='" + url + "'>"+
        "<a href='" + url + "' download='QR-SYSCOMEXPO-2023-CDMX'>"+
            "<button class='boton3'>Descargar QR</button>"+
        "</a>"+
        "<a href='formulario.php'>"+
            "<button class='boton3'>Añadir otro registro</button>"+
        "</a>"

        $("#imagenQR").html(codigo)
    })
}

function buscar_usuario()
{
    if(validarCorreo() == true)
    {
        $.post("funciones/buscar_registro.php",
        {
            correo: $("#correo").val()
        },
        function(respuesta)
        {
            var datos = JSON.parse(respuesta)
            var respuesta = parseInt(datos[0]["respuesta"])
            switch(respuesta)
            {
                case 1:
                {
                    var url = datos[0]["url"]
                    var codigo = "" +
                    "<img style='margin-top:25px;' class='qr' src='" + url + "'>"+
                    "<a href='" + url + "' download='QR-SYSCOMEXPO-2023-CDMX'>"+
                        "<button class='boton3'>Descargar QR</button>"+
                    "</a>"+
                    "<a href='buscarRegistro.html'>"+
                        "<button class='boton3'>Buscar otro registro</button>"+
                    "</a>"
                    $("#info").css({"display": "none"})
                    $("#imagenQR").html(codigo)
                }
                break
                case -1:
                {
                    alert("No fue encontrado ningún registro relacionado al correo " + $("#correo").val() + ", por favor valide los datos")
                    if(confirm("¿Desea generar un registro nuevo?") == true)
                    {
                        window.location.href = "formulario.php";
                    }
                }
                break
            } 
        })
    }
    else
        alert("Por favor complete correctamente el campo de correo")
}

function buscar_usuario_taller()
{
    if(validarCorreo() == true)
    {
        $.post("funciones/buscar_registro_taller.php",
        {
            correo: $("#correo").val()
        },
        function(resultado)
        {
            var respuesta = parseInt(resultado)
            //console.log(resultado)
            switch(respuesta)
            {
                case -1:
                {
                    alert("No fue encontrado ningún registro relacionado al correo " + $("#correo").val() + ", por favor valide los datos")
                    if(confirm("¿Desea generar un registro nuevo?") == true)
                    {
                        window.location.href = "formulario.php";
                    }
                }
                    break
                default:
                {
                    globalIdUsuario = respuesta
                    mostrarTalleres()
                    mostrarMisTalleres()
                    var codigo = "" +
                    "<div class='info' id='info'>"+
                        "<h3>Mis talleres:</h3>"+
                            "<span id='misTalleres'></span><br>"+
                        "<h3>Todos los talleres:</h3>"+
                            "<span id='todosTalleres'></span>"+
                        "<button id='inscribirme' onclick='tallerSeleccionado()'>Inscribirme</button>"+
                        "<a href='buscarRegistroTalleres.html'>"+
                            "<button class='boton5'>Buscar otro registro</button>"+
                        "</a>"+
                    "</div>"
                    $("#info_buscar").css({"display": "none"})
                    $("#talleres").html(codigo)
                }
                    break
            }
        })
    }
    else
        alert("Por favor complete correctamente el campo de correo")
}

function send()
{
    if($("#notas").val() != "")
    {
        $("#enviarCorreo").css({"display":"none"})
        $.post("../funciones/send.php",
        {
            nombre: $("#nombre").val(),
            apellido: $("#apellido").val(),
            correo: $("#correo").val(),
            cargo: $("#cargo").val(),
            empresa: $("#empresa").val(),
            notas: $("#notas").val(),
            correoExpositor: $("#correoExpositor").val()
        },
        function(respuesta)
        {
            switch(parseInt(respuesta))
            {
                case 1:
                {
                    alert("Correo enviado exitosamente")
                    window.location.href = "https://expo.syscom.mx";
                }
                break
                case -1:
                {
                    alert("No fue posible enviar el correo")
                }
                break
            }
        })
    }
    else
    {
        alert("No deje el campo notas en blanco.")
    }
}

function checked()
{
    var checkbox = document.getElementById("usuarioFinal")
    if(checkbox.checked == true)
    {
        $("#contenedorCuenta").css({"display":"none"})
        $("#cargo").val("Invitado")
        $("#rfc").val("-")
        $("#empresa").val("Invitado")
        $("#cuenta").val(100)
    }
    else
    {
        $("#contenedorCuenta").css({"display":"block"})
        $("#cargo").val("")
        $("#rfc").val("")
        $("#empresa").val("")
        $("#cuenta").val("")
    }
}

function paisMexico()
{
    var paisSeleccionado = $("#pais").val()
    if(paisSeleccionado == "MX")
    {
        $("#contenedorPais").css({"display":"block"})
        $("#estado").val("")
        $("#ciudad").val("")
    }
    else
    {
        $("#contenedorPais").css({"display":"none"})
    }
}

function validar()
{
    var inputTexto = ["nombre","cargo","empresa","pais","telefono"]
    var inputNumero = ["cuenta"]
    var inputCorreo = ["correo"]
    var acumulado = 0

    for(x=0; x<inputTexto.length; x++)
    {
        var id = "#" + inputTexto[x]
            if($(id).val() == "" || $(id).val() == null)
            {
                acumulado++
                $(id).css({"border":"solid 1px red"})
            }
            else
            {
                $(id).css({"border":"solid 1px #767676"})
            }
    }

    if($("#pais").val() == "MX")
    {
        var inputTexto2 = ["estado","ciudad"]
        for(x=0; x<inputTexto2.length; x++)
        {
            var id = "#" + inputTexto2[x]
                if($(id).val() == "" || $(id).val() == null)
                {
                    acumulado++
                    $(id).css({"border":"solid 1px red"})
                }
                else
                {
                    $(id).css({"border":"solid 1px #767676"})
                }
        }
    }

    for(x=0; x<inputNumero.length; x++)
    {
        var id = "#" + inputNumero[x]
        if($(id).val() == "" || $(id).val() == 0)
        {
            acumulado++
            $(id).css({"border":"solid 1px red"})
        }
        else
        {
            $(id).css({"border":"solid 1px #767676"})
        }
    }

    for(x=0; x<inputCorreo.length; x++)
    {
        var id = "#" + inputCorreo[x]
        var correo = $(id).val()
        if(correo.indexOf("@") == -1 || correo.indexOf(".") == -1)
        {
            acumulado++
            $(id).css({"border":"solid 1px red"})
        }
        else
        {
            $(id).css({"border":"solid 1px #767676"})
        }
    }

    if(acumulado > 0)
    {
        return false
    }
    else
    {
        return true
    }
}

function validarCorreo()
{
    var inputCorreo = ["correo"]
    var acumulado = 0

    for(x=0; x<inputCorreo.length; x++)
    {
        var id = "#" + inputCorreo[x]
        var correo = $(id).val()
        if(correo.indexOf("@") == -1 || correo.indexOf(".") == -1)
        {
            acumulado++
            $(id).css({"border":"solid 1px red"})
        }
        else
        {
            $(id).css({"border":"solid 1px #767676"})
        }
    }

    if(acumulado > 0)
    {
        return false
    }
    else
    {
        return true
    }
}

function mostrarTalleres()
{
    $.post("funciones/mostrarTalleres.php",
    {
        id_usuario: globalIdUsuario,
    },
    function(respuesta)
    {
        switch(parseInt(respuesta))
        {
            case -1:
                {
                    $("#todosTalleres").html("<div class='info' style='text-align: center; margin-bottom: 15px;'>No hay talleres disponibles</div>")
                }
                break
            default:
                {
                    var tabla = JSON.parse(respuesta)
                    tabla_talleres = tabla
                    console.table(tabla_talleres)
                    var codigo = ""
                    for(x=0; x<tabla.length; x++)
                    {
                        var hora = tabla[x]["hora"];
                        hora = hora.substring(0, 5);

                        var fecha = new Date(tabla[x]["dia"])
                        var dia = fecha.getDate()
                        var mes = fecha.getMonth()
                        var meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
                        var ano = fecha.getFullYear()
                        fecha = (dia+1) + ' ' + meses[mes] + ' ' + ano

                        var registrados = tabla[x]["registrados"]
                        var capacidad = tabla[x]["capacidad"]
                        var cssextra = ""
                        
                        if(registrados >= capacidad)
                        {
                            cssextra = "style = 'cursor: not-allowed; transform: none; background-color: #ebebeb'"
                        }
                        codigo+=
                        "<div class='taller' "+ cssextra +" id='taller"+ x +"' onclick='seleccionar("+ x +")'>"+
                            "<div class='infoTaller'>"+
                                "<div class='izquierda'>"+ hora +"</div><div class='derecha'>"+ fecha +"</div><br>"+
                                "<div class='titulo'>"+ tabla[x]["titulo"] +"</div>"+
                                "<div class='div_instructor'><small>Impartido por:</small><br><span>"+ tabla[x]["instructor"] +"</span></div>"+
                                "<div class='izquierda'><small>Sala: </small>"+ tabla[x]["sala"] +"</div><div class='derecha'><small>Capacidad: </small>"+ tabla[x]["registrados"] +"/"+ tabla[x]["capacidad"] +"</div><br>"+
                            "</div>"+
                        "</div>"
                        
                    }
                    $("#todosTalleres").html(codigo)

                    
                }
        }
    })
}

function seleccionar(_id)
{
    //var registrados = tabla_talleres[_id]["registrados"]
    //var capacidad = tabla_talleres[_id]["capacidad"]
    var id = "#taller" + _id

    /*if(registrados >= capacidad)
    {
        //$("#taller"+_id+"").css("box-shadow", "2px 2px 2px 0px #c3c3c3")
        //$("#taller"+_id+"").css("background-color", "rgb(255, 255, 255)")
        //$("#taller"+_id+"").css("color", "#333333")
        //$("#taller"+_id+"").css("border", "1px solid #edeff0")
        $("#taller"+_id+"").css("cursor", "not-allowed")
        $("#taller"+_id+"").css("transform", "none")
    }
    else
    {*/
        switch($(id).css("background-color"))
        {
            case "rgb(255, 255, 255)":
            {
                $("#taller"+_id+"").css("box-shadow", "2px 2px 2px 0px #c3c3c3")
                $("#taller"+_id+"").css("background-color", "#c62828")
                $("#taller"+_id+"").css("color", "#ffffff")
                $("#taller"+_id+"").css("border", "1px solid #c62828")
            }
            break
            case "rgb(198, 40, 40)":
            {
                $("#taller"+_id+"").css("box-shadow", "2px 2px 2px 0px #c3c3c3")
                $("#taller"+_id+"").css("background-color", "rgb(255, 255, 255)")
                $("#taller"+_id+"").css("color", "#333333")
                $("#taller"+_id+"").css("border", "1px solid #edeff0")
            }
            break
        }
    //}
    console.log(tabla_talleres[_id]["id"])
}

function tallerSeleccionado()
{
    for(x=0; x<tabla_talleres.length; x++)
    {
        var id = ("#taller" + x)
        if($(id).css("background-color") == "rgb(198, 40, 40)")
        {
            $.post("funciones/registrar_taller.php",
            {
                id_usuario: globalIdUsuario,
                id_taller: tabla_talleres[x]["id"],
            },
            function(respuesta)
            {
                var tabla = JSON.parse(respuesta)
                tabla_talleres_seleccionados = tabla
                //console.log(tabla_talleres_seleccionados)
                
                mostrarTalleres()
                mostrarMisTalleres()
                
            })
            //console.log("posicion " + x + " está seleccionado")
        }
    }
}

function mostrarMisTalleres()
{
    $.post("funciones/mostrarMisTalleres.php",
    {
        id_usuario: globalIdUsuario,
    },
    function(respuesta)
    {
        switch(parseInt(respuesta))
        {
            case -1:
                {
                    $("#misTalleres").html("<div class='info' style='text-align: center;'>Aún no hay registros</div>")
                }
                break
            default:
                {
                    var tabla = JSON.parse(respuesta)
                    tabla_mis_talleres = tabla

                    var codigo = ""+
                    "<table class='tabla_MisTalleres'>"+
                        "<tr class='titulos'>"+
                            "<td><b>Hora<b></td>"+
                            "<td><b>Fecha<b></td>"+
                            "<td><b>Taller<b></td>"+
                            //"<td class='ocultar_movil'><b>Instructor<b></td>"+
                            "<td><b>Sala<b></td>"+
                            "<td></td>"+
                        "</tr>"
                    for(x=0; x<tabla.length; x++)
                    {
                        var hora = tabla[x]["hora"];
                        hora = hora.substring(0, 5);

                        var fecha = new Date(tabla[x]["dia"])
                        var dia = fecha.getDate()
                        var mes = fecha.getMonth()
                        var meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
                        var ano = fecha.getFullYear()
                        fecha = (dia+1) + ' ' + meses[mes] + ' ' + ano

                        codigo+=
                        "<tr>"+
                            "<td>" + hora + "</td>"+
                            "<td>" + fecha + "</td>"+
                            "<td>" + tabla[x]["titulo"] + "</td>"+
                            //"<td  class='ocultar_movil'>" + tabla[x]["instructor"] + "</td>"+
                            "<td>" + tabla[x]["sala"] + "</td>"+
                            "<td><img class='icono' src='imagenes/eliminar.png' onclick='eliminar_taller(" + x + ")'></td>"+
                        "</tr>"
                    }
                    codigo+=
                    "</table>"

                    $("#misTalleres").html(codigo)
                    //console.log(tabla)
                    //console.table(tabla)
                }
                break
        }
    })
}

function eliminar_taller(_id)
{
    var id_inscripcion = tabla_mis_talleres[_id]["id"]
    var titulo = tabla_mis_talleres[_id]["titulo"]

    if(confirm("¿Realmente desea eliminar el taller " + titulo + "?") == true)
    {
        $.post("funciones/eliminar_taller.php",
        {
            id: id_inscripcion
        },
        function(respuesta)
        {
            switch(parseInt(respuesta))
            {
                case 1:
                    {
                        mostrarTalleres()
                        mostrarMisTalleres()
                    }
                    break
                default:
                {
                    alert("Ocurrió un error, por favor contacte al administrador.\n\nError: " + respuesta)
                }
                break
            }
        })
    }
}