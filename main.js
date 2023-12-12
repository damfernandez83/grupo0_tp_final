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

    const imagenEventoFile = imagenEventoInput.files[0];

    if (imagenEventoFile) {
        const formData = new FormData();

        // Agregar datos al FormData
        formData.append('nombreEvento', nombreEvento);
        formData.append('fechaEvento', fechaEvento);
        formData.append('descripcionEvento', descripcionEvento);
        formData.append('imagenEvento', imagenEventoFile);

        const xhr = new XMLHttpRequest();

        // Configurar la solicitud
        xhr.open('POST', 'database.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {

                const respuesta = JSON.parse(xhr.responseText);

                const eventoDiv = document.createElement('div');
                eventoDiv.className = 'row';

                eventoDiv.innerHTML = `
                <div class="col-12 col-md-6 ps-0 pe-0">
                    <img src="./img/${respuesta.imagen}" alt="${nombreEvento}" style="width: 100%;">
                </div>
                <div class="col-12 col-md-6 pt-2 pb-2">
                    <h2>${nombreEvento}</h2>
                    <p>${descripcionEvento}</p>
                    <p>Fecha: ${fechaEvento}</p>
                    <button type="button" class="btn btn-warning editar-evento-btn">Editar</button>
                    <button type="button" class="btn btn-danger eliminar-evento-btn">Eliminar</button>
                </div>
            `;

                eventosContainer.appendChild(eventoDiv);

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
