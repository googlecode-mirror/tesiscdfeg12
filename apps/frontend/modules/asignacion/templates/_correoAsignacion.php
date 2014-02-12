Hola <?php echo $discipulo ?>,

¡¡¡¡FELICITACIONES!!!! Reciba un cordial saludo de CDFE, el sistema de Administración de Células le informa que se le ha sido asignado un Líder de Célula, a continuación la información de su Líder:

Nombre: <?php echo $lider . "\n" ?>
<?php if ($lider->getTelefono()): ?>
    Teléfono: <?php echo $lider->getTelefono() . "\n" ?>
<?php endif; ?>
<?php if ($lider->getMovil()): ?>
    Celular: <?php echo $lider->getMovil() . "\n" ?>
<?php endif; ?>
Correo: <?php echo $lider->getEmailAddress() . "\n" ?>

Recuerde comunicarse con <?php echo $lider->getFirstName() ?> lo más pronto posible  para que pueda asistir a su célula.

Dios bendice esta nueva etapa de su vida y su líder le apoyará en todo momento.

Atentamente,
Comunidad de FE
