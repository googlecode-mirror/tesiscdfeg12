Hola <?php echo $lider ?>,

Recibe un cordial saludo de CDFE, el sistema Administración de Células te informa que se te ha sido asignado un nuevo Discípulo, los detalles de la asignación son:

Nombre: <?php echo $discipulo . "\n" ?>
<?php if ($discipulo->getTelefono()): ?>
    Teléfono: <?php echo $discipulo->getTelefono() . "\n" ?>
<?php endif; ?>
<?php if ($discipulo->getMovil()): ?>
    Celular: <?php echo $discipulo->getMovil() . "\n" ?>
<?php endif; ?>
Correo: <?php echo $discipulo->getEmailAddress() . "\n" ?>

Recuerda comunicarte con <?php echo $discipulo->getFirstName() ?> en los próximos tres días para que puedas llevar su seguimiento de consolidación. 

Dios bendice este nuevo reto y tu líder te apoyará en todo momento.

Atentamente,
Comunidad de FE
