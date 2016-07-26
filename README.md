# derechosdelestudiante

## Cambio en variables de acceso a BD

Recientemente cambié la forma en que se accede a la base de datos. Estaban comiteados en el servidor las credenciales de la base de datos. Lo cambié para que lea los datos desde las variables de ambiente en Heroku. Así que para que funcione en local, hay que setear las variables de ambiente de acceso a la base de datos local también. Se ven con la función php `getenv`.

Al momento de traer los cambios usen `git rebase` y no merge, para no volver a llevar la info que eliminé al repo. Más información: https://help.github.com/articles/remove-sensitive-data/

¡Cualquier consulta a las órdenes!

@picandocodigo
