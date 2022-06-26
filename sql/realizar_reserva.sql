CREATE OR REPLACE FUNCTION reserva

(passuser VARCHAR, pass VARCHAR, codigo_vuelo VARCHAR, OUT valor integer, OUT razon varchar, OUT pasaporte_problematico varchar)

LANGUAGE plpgsql AS $$
DECLARE

    vuelo RECORD;
    
    cantidad RECORD;
    
    passports TEXT[];
    passport TEXT;
    
    person RECORD;
    
    tickets RECORD;
    ticket RECORD;
    vuelo_ticket RECORD;
    reserva_id RECORD;
    codigo_reserva TEXT;
    reserva_id_nuevo integer;

    passport1 text;
    passport2 text;
    contador integer;
    asiento_random integer;
BEGIN
    
    IF pass = '' THEN
        valor := 0;
        razon := 'Pasaportes vacíos';
        pasaporte_problematico := "Ninguno";
        RETURN;
    ELSE
        
        passports = string_to_array(pass, ',');
        FOREACH passport IN ARRAY passports LOOP
            SELECT COUNT(*) into cantidad FROM persona WHERE pasaporte = passport;
            
            IF cantidad.count != 1 THEN
                valor := 1;
                razon := 'Uno de los pasaportes ingresado es inválido';
                pasaporte_problematico := passport;
                RETURN;
            END IF;
        END LOOP;

        FOREACH passport1 IN ARRAY passports LOOP
            contador := 0;
            FOREACH passport2 IN ARRAY passports LOOP
                IF passport1 = passport2 THEN
                    contador = contador + 1;
                END IF;
            END LOOP;

            IF contador >= 2 THEN
                valor := 2;
                razon := 'Pasaporte repetido';
                pasaporte_problematico := passport1;
                RETURN;
            END IF;

        END LOOP;
        
        SELECT * INTO vuelo FROM vuelo WHERE codigo = codigo_vuelo;
        FOREACH passport in ARRAY passports LOOP
            SELECT * INTO person FROM persona WHERE pasaporte = passport;
            FOR ticket in SELECT * FROM ticket WHERE pasajero_pasaporte = passport LOOP
                FOR vuelo_ticket in SELECT * FROM ticket, vuelo WHERE ticket.vuelo_id = vuelo.id LOOP
                    IF (vuelo.fecha_salida >= vuelo_ticket.fecha_salida AND vuelo.fecha_salida <= vuelo_ticket.fecha_llegada) OR (vuelo.fecha_llegada <= vuelo_ticket.fecha_llegada AND vuelo.fecha_llegada >= vuelo_ticket.fecha_salida) THEN
                        valor := 4;
                        razon := 'Conflicto de fechas';
                        pasaporte_problematico := passport;
                        RETURN;
                    END IF;
                END LOOP;
            END LOOP;
        END LOOP;
        
        
        SELECT MAX(id) INTO reserva_id FROM reserva;
        reserva_id_nuevo := reserva_id.max + 1;
        codigo_reserva := codigo_vuelo || '-' || reserva_id;
        INSERT INTO reserva VALUES(reserva_id_nuevo, codigo_reserva, passuser);
        
        FOREACH passport in ARRAY passports LOOP
            SELECT floor(random()*(69-1+1))+1 INTO asiento_random;
            INSERT INTO ticket VALUES(reserva_id_nuevo, passport, vuelo.id, asiento_random, 'Economica', 'f');
        END LOOP;

        valor := 420;
        razon := 'Reserva exitosa';
        pasaporte_problematico := 'Ninguno';

    END IF;
END $$