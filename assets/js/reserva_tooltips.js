$(document).ready(function(){
    var style_css = 'qtip-dark';
    
    $('#nombre').qtip({ // Grab some elements to apply the tooltip to
        style: { classes: style_css },
        content: {
            text: 'Longitud m&aacute;xima de 40 car&aacute;cteres'
        }
    });
    $('#apellido').qtip({ // Grab some elements to apply the tooltip to
        style: { classes: style_css },
        content: {
            text: 'Longitud m&aacute;xima de 40 car&aacute;cteres'
        }
    });
    $('#email').qtip({ // Grab some elements to apply the tooltip to
        style: { classes: style_css },
        content: {
            text: 'Introduzca un email v&aacute;lido'
        }
    });
    $('#telefono').qtip({ // Grab some elements to apply the tooltip to
        style: { classes: style_css },
        content: {
            text: 'M&oacute;vil o tel&eacute;fono fjio'
        }
    });
    $('#email').qtip({ // Grab some elements to apply the tooltip to
        style: { classes: style_css },
        content: {
            text: 'Introduzca un email v&aacute;lido'
        }
    });
    $('#num_personas').qtip({ // Grab some elements to apply the tooltip to
        style: { classes: style_css },
        content: {
            text: '<center>Si excede las 16 personas. El restaurante se pondr&aacute; en contacto con usted.</center>'
        }
    });
    $('#fecha').qtip({ // Grab some elements to apply the tooltip to
        style: { classes: style_css },
        content: {
            text: '<center>Se puede reservar con un m&aacute;ximo de 2 meses de antelaci&oacute;n</center>'
        }
    });
});