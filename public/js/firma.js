// Segmento para Firma
    let banderadibujo = 0;
    let canvas = document.getElementById("canvas");
    let ctx = canvas.getContext("2d");
    let cw = canvas.width = 250,
        cx = cw / 2;
    let ch = canvas.height = 250,
        cy = ch / 2;
    
    let dibujar = false;
    let factorDeAlisamiento = 1;
    let Trazados = [];
    let puntos = [];
    ctx.lineJoin = "round";


    limpiar.addEventListener('click', function (evt) {
        var firma = document.getElementById('firma');
        var firmaok = document.getElementById('firmaok');
        firma.value="";
        firmaok.checked = false;
        $("#firma").attr("value", null);
        $("#imgCapture").attr("src", null);

        console.log('limpiar -'+banderadibujo);

        dibujar = false;
        ctx.clearRect(0, 0, cw, ch);
        Trazados.length = 0;
        puntos.length = 0;
    }, false);
    
    function iniciarTrazado(evt) {
        dibujar = true;
        //ctx.clearRect(0, 0, cw, ch);
        puntos.length = 0;
        ctx.beginPath();
        banderadibujo = 1;
    }
    
    function trazar(evt) {
        if (dibujar) {
            let m = oMousePos(canvas, evt);
            puntos.push(m);
            ctx.lineTo(m.x, m.y);
            ctx.stroke();
            banderadibujo = 1;
        }
    }
    
    canvas.addEventListener('mousedown', iniciarTrazado , false);
    canvas.addEventListener('touchstart',event => iniciarTrazado(event.touches[0]) , false);
    
    canvas.addEventListener('mouseup', redibujarTrazados, false);
    canvas.addEventListener('touchend', event =>redibujarTrazados(event.touches[0]), false);
    
    canvas.addEventListener("mouseout", redibujarTrazados, false);
    
    canvas.addEventListener("mousemove", trazar, false);
    canvas.addEventListener("touchmove", event => trazar(event.touches[0]), false);
    
    function reducirArray(n, elArray) {
        let nuevoArray = [];
        nuevoArray[0] = elArray[0];
        for (let i = 0; i < elArray.length; i++) {
            if (i % n == 0) {
                nuevoArray[nuevoArray.length] = elArray[i];
            }
        }
        nuevoArray[nuevoArray.length - 1] = elArray[elArray.length - 1];
        Trazados.push(nuevoArray);
    }
    
    function calcularPuntoDeControl(ry, a, b) {
        let pc = {}
        pc.x = (ry[a].x + ry[b].x) / 2;
        pc.y = (ry[a].y + ry[b].y) / 2;
        return pc;
    }
    
    function alisarTrazado(ry) {
        if (ry.length > 1) {
            let ultimoPunto = ry.length - 1;
            ctx.beginPath();
            ctx.moveTo(ry[0].x, ry[0].y);
            for (let i = 1; i < ry.length - 2; i++) {
                let pc = calcularPuntoDeControl(ry, i, i + 1);
                ctx.quadraticCurveTo(ry[i].x, ry[i].y, pc.x, pc.y);
            }
            ctx.quadraticCurveTo(ry[ultimoPunto - 1].x, ry[ultimoPunto - 1].y, ry[ultimoPunto].x, ry[ultimoPunto].y);
            ctx.stroke();
        }
    }
    
    function redibujarTrazados() {
        banderadibujo = 1;
        dibujar = false;
        ctx.clearRect(0, 0, cw, ch);
        reducirArray(factorDeAlisamiento, puntos);
        for (let i = 0; i < Trazados.length; i++)
            alisarTrazado(Trazados[i]);
    }
    
    function oMousePos(canvas, evt) {
        let ClientRect = canvas.getBoundingClientRect();
        return { //objeto
            x: Math.round(evt.clientX - ClientRect.left),
            y: Math.round(evt.clientY - ClientRect.top)
        }
    }
    
    function btnSave(){
        var inputText = document.getElementById('firma');
        //var base64 = $('#canvas')[0].toDataURL();
        var base64 = $('#canvas')[0].toDataURL();
        
        //inputText.value = base64;
        
        if(banderadibujo == 1){
            console.log(base64);
            console.log(banderadibujo);
            $("#firma").attr("value", base64);
            $("#firma").value = base64;
            $("#imgCapture").attr("src", base64);
            banderadibujo = 0;
        }

        //$("#imgCapture").show();
    };
    
    /* Limpiar pizarra */
    function limpiarTrazado() {

        dibujar = false;
        ctx.clearRect(0, 0, cw, ch);
        Trazados.length = 0;
        puntos.length = 0;
        
      }

    
/*
    const $canvas = document.querySelector("#canvas");
    const contexto = $canvas.getContext("2d");
    const COLOR = "blue";
    const GROSOR = 1;

    let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;
    const obtenerXReal = (clientX) => clientX - $canvas.getBoundingClientRect().left;
    const obtenerYReal = (clientY) => clientY - $canvas.getBoundingClientRect().top;
    let haComenzadoDibujo = false; // Bandera que indica si el usuario está presionando el botón del mouse sin soltarlo
    $canvas.addEventListener("mousedown", evento => {
        // En este evento solo se ha iniciado el clic, así que dibujamos un punto
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.fillStyle = COLOR;
        contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
        contexto.closePath();
        // Y establecemos la bandera
        haComenzadoDibujo = true;
    });
    
    $canvas.addEventListener("mousemove", (evento) => {
        if (!haComenzadoDibujo) {
            return;
        }
        // El mouse se está moviendo y el usuario está presionando el botón, así que dibujamos todo
    
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.moveTo(xAnterior, yAnterior);
        contexto.lineTo(xActual, yActual);
        contexto.strokeStyle = COLOR;
        contexto.lineWidth = GROSOR;
        contexto.stroke();
        contexto.closePath();
    });
    ["mouseup", "mouseout"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, () => {
            haComenzadoDibujo = false;
        });
    });




//-------------------------------------------------------------------------------------------------

function actualizarCanvas(){
    contexto.clearRect(0,0, $canvas.width, $canvas.height);
};

*/