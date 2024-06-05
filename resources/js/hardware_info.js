import si from 'systeminformation'; // Utilizamos import en lugar de require

async function getHardwareInfo() {
    try {
        const cpu = await si.cpu();
        const memory = await si.mem();
        const disk = await si.diskLayout();
        const tag = await si.osInfo();
        const system = await si.system();

        const hardwareInfo = {
            cpu: {
                manufacturer: cpu.manufacturer,
                brand: cpu.brand.substring(4,cpu.brand.length),
                speed: cpu.speed,
                cores: cpu.cores,
            },
            memory: {
                total: (memory.total / (1024 * 1024 * 1024)).toFixed(2) + ' GB' // Convert to GB and format to 2 decimal places
            },
            disk: disk.map(d => ({
                disco: d.type + ' ' +(d.size / (1024 * 1024 * 1024)).toFixed(2) + ' GB' // Convert to GB and format to 2 decimal places
            })),
            tag:  {
                host: tag.hostname,
            },
            system:  {
                serial: system.serial,
                model: system.model,
                marca: system.manufacturer,
            }
            
        };
        console.log(JSON.stringify(hardwareInfo, null, 2));
    } catch (e) {
        console.error(e);
    }
}

getHardwareInfo();
