En programa utiliza el componente yaml de Symfony2 para parsear el archivo de configuración "/config/parameters.yml", que recibe dos valores de los providers configurados.
Tambien utiliza la libreria para envio de mail PHPMailer. 

Son obligatorios 2 parametros de configuracion: sleep(para espera entre envios <- esto no se pedia pero me parecio interesante agregar) y providers (array de providers).
Si alguno de estos valores no esta lanza una excepción: PHP Fatal error:  Uncaught Exception: "Providers not defined!" or "Sleep not defined!"


El programa tiene un pequeño patrón de diseño tipo factory con el que solo definiendo el nuevo provider en  "/config/parameters.yml" ya puede ser utilizado 

Ej:
providers:
    google:
        host: smtp.google.com
        user: user@google.com
        password: XXXXXX

La función init() del Factory es quien se encarga de configurar el proveedor y sendTo() de hacer el envio
