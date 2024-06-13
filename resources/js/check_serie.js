import si from 'systeminformation';
import axios from 'axios';

async function checkSerial() {
    try {
        const system = await si.system();

        const serialInfo = {
            serial: system.serial,
        };

        console.log(JSON.stringify(serialInfo, null, 2));

        // Enviar el número de serie al backend
        const response = await axios.post('http://tu-dominio.com/check-serial', serialInfo, {
            headers: {
                'Content-Type': 'application/json',
                // Agrega el token CSRF si es necesario
                'X-CSRF-TOKEN': 'tu-token-csrf',
            }
        });

        console.log(response.data);
    } catch (e) {
        console.error(e);
    }
}

checkSerial();
