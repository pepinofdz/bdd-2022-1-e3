CREATE OR REPLACE FUNCTION reserva

(passuser VARCHAR, pass VARCHAR, codigo_vuelo VARCHAR, cant_pasajeros INTEGER)

RETURNS void AS $$
DECLARE
    vuelo RECORD;
    personas RECORD;
    cantidad RECORD;

BEGIN
    
    IF pass = '' THEN
        RAISE EXCEPTION 'Debes colocar al menos un pasaporte de alguien';
    ELSE
        SELECT * INTO personas FROM persona WHERE pasaporte IN (pass);

        SELECT COUNT(pasaporte) INTO cantidad FROM personas;

    END IF;

END
$$ LANGUAGE plpgsql