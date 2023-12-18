document.addEventListener('DOMContentLoaded', function() {

const price = 2000
const discountSelect = document.getElementById('discount-choice');
const finalPriceText = document.getElementById('final-price');
const quantityInput = document.getElementById('quantity-tickets');
const confirmBtn = document.getElementById('confirm-button');
const emailInput = document.getElementById('form-email');
const resetBtn = document.getElementById('reset-button');
const agregarEventoForm = document.getElementById('agregarEventoForm');
const eventosContainer = document.getElementById('eventos');
const imagenEventoInput = document.getElementById('imagenEvento');


function getStoredEvents() {
    const storedEvents = localStorage.getItem('events');
    return storedEvents ? JSON.parse(storedEvents) : [];
}


function updateStoredEvents(events) {
    localStorage.setItem('events', JSON.stringify(events));
}

function getEventsFromServer() {
    fetch('getEvents.php')
        .then(response => response.json())
        .then(events => {
            const eventosContainer = document.getElementById('eventosContainer');
            eventosContainer.innerHTML = '';
            events.forEach(eventData => {
                addEventToDOM(eventData);
            });
        })
        .catch(error => console.error('Error al obtener eventos:', error));
}

getEventsFromServer();

function addEventToDOM(eventData) {
    const eventosContainer = document.getElementById('eventosContainer');

    const eventoDiv = document.createElement('div');
    eventoDiv.className = 'row';
    eventoDiv.id = `evento_${eventData.id}`;

    eventoDiv.innerHTML = `
       <div class="row" id="evento_${eventData.id}">
           <div class="col-12 col-md-6 ps-0 pe-0">
               <img src="./img/${eventData.imagen}" alt="${eventData.nombre}" style="width: 100%;">
           </div>
           <div class="col-12 col-md-6 pt-2 pb-2">
               <h2>${eventData.nombre}</h2>
               <p>${eventData.descripcion}</p>
               <p>Fecha: ${eventData.fecha}</p>
           </div>
       </div>
    `;
    eventosContainer.appendChild(eventoDiv);
}

function loadStoredEvents() {
    const storedEvents = getStoredEvents();
    storedEvents.forEach((eventData) => {
        addEventToDOM(eventData);
    });
}

discountSelect.addEventListener('input', finalPriceCalculation);
quantityInput.addEventListener('input', finalPriceCalculation);
confirmBtn.addEventListener('click', () => {
    finalPriceText.textContent = `Gracias por confirmar! Te enviamos un email a ${emailInput.value}`;
});
resetBtn.addEventListener('click', resetForm);

agregarEventoForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const nombreEvento = document.getElementById('nombreEvento').value;
    const fechaEvento = document.getElementById('fechaEvento').value;
    const descripcionEvento = document.getElementById('descripcionEvento').value;
    console.log('Campos del formulario:', nombreEvento, fechaEvento, descripcionEvento);

    const imagenEventoFile = imagenEventoInput.files[0];

    if (imagenEventoFile) {
        const formData = new FormData();

        // Agrego datos al FormData
        formData.append('nombreEvento', nombreEvento);
        formData.append('fechaEvento', fechaEvento);
        formData.append('descripcionEvento', descripcionEvento);
        formData.append('imagenEvento', imagenEventoFile);

        const xhr = new XMLHttpRequest();

        // Configuro la solicitud
        xhr.open('POST', 'database.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                const respuesta = JSON.parse(xhr.responseText);
                console.log('Respuesta del servidor:', respuesta);
                const eventoId = Date.now().toString();
                console.log('ID del evento:', eventoId);
        
                const storedEvents = getStoredEvents();
        
                const nuevoEvento = {
                    id: eventoId,
                    nombreEvento: nombreEvento,
                    fechaEvento: fechaEvento,
                    descripcionEvento: descripcionEvento,
                    imagen: respuesta.imagen
                };
                storedEvents.push(nuevoEvento);
                console.log('Eventos almacenados:', storedEvents);
                updateStoredEvents(storedEvents);
                addEventToDOM(nuevoEvento);
        
                agregarEventoForm.reset();
            } else {
                alert('Hubo un error al agregar el evento.');
            }
        };

        xhr.send(formData);
    } else {
        alert('Por favor, selecciona una imagen.');
    }
});

imagenEventoInput.addEventListener('change', function () {
    const imagenPreview = document.getElementById('imagenEventoPreview');
    const imagenEventoFile = imagenEventoInput.files[0];

    if (imagenEventoFile) {
        const imagenEventoURL = URL.createObjectURL(imagenEventoFile);
        imagenPreview.src = imagenEventoURL;
    }
});

function finalPriceCalculation() {
    let discount = discountSelect.value;
    let quantityTickets = quantityInput.value;
    let priceWithDiscount = price - (price * discount);
    let finalPrice = priceWithDiscount * quantityTickets;

    console.log(discount);
    console.log(quantityTickets);
    console.log(priceWithDiscount);
    console.log(finalPrice);

    return finalPriceText.textContent = `Total: $${finalPrice.toFixed(2)}`;
}

function resetForm() {
    discountSelect.value = 'Elegir';
    finalPriceText.textContent = 'Total: $';
    quantityInput.value = undefined;
}

eventosContainer.addEventListener('click', async (event) => {
    const target = event.target;

    if (target.classList.contains('editar-evento-btn')) {
        const eventId = target.getAttribute('data-event-id');
        const editedNombreEvento = prompt('Ingrese el nuevo nombre del evento:');
        if (editedNombreEvento !== null) {
            await editarEvento(eventId, editedNombreEvento);
        }
    }

    if (target.classList.contains('eliminar-evento-btn')) {
        confirmarEliminar(event);  
    }
});

async function confirmarEliminar(event) {
    try {
        const eventoDiv = event.target.closest('.row');

        if (eventoDiv) {
            const eventId = eventoDiv.getAttribute('id').split('_')[1];

            const eliminarBtn = eventoDiv.querySelector('.eliminar-evento-btn');

            if (eliminarBtn) {
                eliminarBtn.setAttribute('data-event-id', eventId);

                const modal = new bootstrap.Modal(document.getElementById('confirmarEliminarModal'));
                modal.show();
            } else {
                console.error(`No se pudo encontrar el botón eliminar dentro del evento con ID "evento_${eventId}".`);
            }
        } else {
            console.error('No se pudo encontrar el contenedor del evento.');
        }
    } catch (error) {
        console.error('Error en confirmarEliminar:', error);
    }
}




async function eliminarEvento() {
    try {
        var eventId = document.getElementById('eliminarBtn').getAttribute('data-event-id');

        const response = await fetch(`http://localhost:3307/proyectofinal/eventos.php?id=${eventId}`, {
            method: 'DELETE',
        });

        if (response.ok) {
            var confirmaModal = new bootstrap.Modal(document.getElementById('confirmarEliminarModal'));
            confirmaModal.hide();
            mostrarEliminacionExitosa();
            const eventoDiv = document.getElementById(`evento_${eventId}`);
            if (eventoDiv) {
                eventoDiv.remove();
            }
        } else {
            console.error('Error al eliminar el evento:', response.statusText);
        }
    } catch (error) {
        console.error('Error al eliminar el evento:', error);
    }
}





async function editarEvento(eventId, editedNombreEvento) {
    try {
        const response = await fetch(`http://localhost:3307/proyectofinal/eventos.php?id=${eventId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `nombreEvento=${editedNombreEvento}`, 
        });

        if (response.ok) {
            console.log('Evento editado correctamente');
            alert('Evento editado correctamente.');
            loadStoredEvents();
        } else {
            console.error('Error al editar el evento:', response.statusText);
            alert('Hubo un error al editar el evento.');
        }
    } catch (error) {
        console.error('Error de red:', error);
        alert('Hubo un error de red al editar el evento.');
    }
}

function mostrarEliminacionExitosa() {
    var eliminacionExitosaModal = new bootstrap.Modal(document.getElementById('eliminacionExitosaModal'));
    eliminacionExitosaModal.show();
}


document.addEventListener('DOMContentLoaded', () => {
    loadStoredEvents();

    eventosContainer.addEventListener('click', async (event) => {
        const target = event.target;

        if (target.classList.contains('editar-evento-btn')) {
            const eventId = target.getAttribute('data-event-id');
            const editedNombreEvento = prompt('Ingrese el nuevo nombre del evento:');
            if (editedNombreEvento !== null) {
                await editarEvento(eventId, editedNombreEvento);
            }
        }

        if (target.classList.contains('eliminar-evento-btn')) {
            await confirmarEliminar(eventId);
        }
    });
});


document.addEventListener('DOMContentLoaded', loadStoredEvents);

});