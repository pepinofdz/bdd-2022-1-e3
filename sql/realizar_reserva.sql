CREATE OR REPLACE FUNCTION reserva
/* 
Se definen las variables a utilizar: 
- passuser es el pasaporte de quien está haciendo la reserva

- pass es un string que contiene los pasaportes. Si son más de 1 pasaporte el formateo es le siguiente:
  1) Se manda desde la página el string "pasaporte1,pasaporte2" (puede haber pasaporte3 tmbn, pero el comportamiento no cambia)
  2) La variable declarada 'passports' se usa para contener los pasaportes PASADOS de string a array
  3) Se utiliza ese array para ir chequeando que sean pasaportes válidos
  El tratamiento de los pasaportes en el código se detalla más adelante
  Igual, por si es necesario, acá esta la docu de los arrays: https://www.postgresql.org/docs/9.1/functions-array.html

- codigo_vuelo es self-explanatory

- OUT valor integer y OUT razon varchar van a ser outputs de nuestra función. Si pedimos esos 2 elementos, el return de la función
  queda como array (o sea, en la página, lo puedes acceder con $data[0][0] por ejemplo). Esas dos variables (columnas en el return)
  nos van a permitir hacer un if en la página para mostrar distinta info. Por ejemplo, si $data[0][0] == 0, entonces tenemos que
  mostrar un mensaje que sea "Pavito, teni que poner un pasaporte al menos". En la variable razon deje esa misma wea pero más corta

- OUT pasaporte_problematico se usa para poder acceder a que pasaporte está causando conflicto. Recomiendo que lo usen para la parte de verificar
  lo de las fechas de los vuelos. Así, en la página pueden acceder al pasaporte wekereke y mostrarlo*/
(passuser VARCHAR, pass VARCHAR, codigo_vuelo VARCHAR, OUT valor integer, OUT razon varchar, OUT pasaporte_problematico varchar)

LANGUAGE plpgsql AS $$
DECLARE
    /* vuelo RECORD se utiliza para almacenar la info del vuelo que queremos reservar. En nuestro caso nos importa para poder
       saber las fechas y poder generar la reserva */
    vuelo RECORD;
    /* Cantidad se usa solo para chequear que la query de buscar a la persona te da algo igual o diferente a 1 */
    cantidad RECORD;
    /* Importante: Si se quiere iterar en un array, se debe declarar de que chucha va a ser el array y que chucha son los
       elementos del array. Como queremos usar un array de pasaportes (strings) le ponemos TEXT[] a la variable passports. 
       Como vamos a iterar sobre esos pasaportes, tenemos que declarar que cada uno de esos pasaportes es TEXT*/
    passports TEXT[];
    passport TEXT;
    /* Person se utiliza para almacenar a cada persona de acuerdo a su pasaporte */
    person RECORD;
    /* Aquí la variable tickets son todos los vuelos que tiene una persona (ojo que esto es diferente a sus reservas)
       ticket es para poder iterar por cada ticket de tickets*/
    tickets RECORD;
    ticket RECORD;
BEGIN
    /* Creo que queda bien claro lo que hace lo de aquí abajo*/
    IF pass = '' THEN
        valor := 0;
        razon := 'Pasaportes vacíos';
        pasaporte_problematico := "Ninguno";
        RETURN;
    ELSE
        /* Se pasa el string de pasaportes a un array para iterar */
        passports = string_to_array(pass, ',');
        FOREACH passport IN ARRAY passports LOOP
            SELECT COUNT(*) into cantidad FROM persona WHERE pasaporte = passport;
            /* Si es que la consulta te arroja un count diferente de 1 (mismo que decir que arroja 0) 
               entonces la función retorna antes, dado que un pasaporte es invalido*/
            IF cantidad.count != 1 THEN
                valor := 1;
                razon := 'Uno de los pasaportes ingresado es inválido';
                pasaporte_problematico := passport;
                RETURN;
            END IF;
        END LOOP;
        /* Aquí comienza la validación de cada persona con sus vuelos
           Nota: Si por alguna razón falla el código de aquí abajo (el select * into vuelo), traten cambiar el nombre de la variable vuelo a otra cosa */
        SELECT * INTO vuelo FROM vuelo WHERE codigo = codigo_vuelo;
        FOREACH passport in ARRAY passports LOOP
            SELECT * INTO person FROM persona WHERE pasaporte in (pass);
            /* 
            POR HACER: Ya cabros, aquí le tienen que dar de pana jajaja. 
            Hay obtener todos los 'tickets' que tiene una persona. Le digo ticket pero en verdad no sé si eso es 100% correcto.
            Básicamente es tomar todos los vuelos que tiene una persona (ya sea que esa persona haya reservado o alguien más le haya reservado)
            Luego, hay que iterar por cada uno de esos vuelos y chequear que las fechas no tengan conflicto con el vuelo que se quiere reservar.
            El vuelo que se quiere reservar esta guardado en la variable "vuelo". Para acceder a sus atributos basta con poner vuelo.atributo.
            Si quieren guardar ese atributo en una variable o algo, acuérdense de declarar esa variable en el DECLARE.
            
            ¿Que pasa si hay un conflicto en las fechas? Asignen un valor a la variable 'valor' (jajaredundancia), un valor a 'razon' y en
            pasaporte_problematico almacenan el pasaporte penca qliao que cago la reserva del usuario y así lo muestran en la página.
            
            ¿Si no hay conflicto?
            Entonces nuevamente iteren por la lista de pasaportes en el array passports, y para cada una le hacen los INSERT necesarios en las tablas.
            Creo que para codigo de la reserva van a tener que concatenar strings, pero nica esa wea es difícil.
            Luego, hagan lo que quieran con las variables valor, razon y pasaporte_problematico.

            Notas finales: Recomiendo que para mostrar la info en la página utilicen la variable 'valor'. Por ejemplo, si es que no hay problemas
            con la reserva, entonces dicen 'valor := 5' aquí en el código y en el php simplemente el if qliao.
            
            Acuérdense de revisar el Trello! No lo estamos usando tanto, pero hay alguna que otra tarjeta que es importante
            */
        END LOOP;
        
    END IF;
END $$