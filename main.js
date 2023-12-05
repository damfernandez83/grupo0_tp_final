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

    const imagenEventoFile = imagenEventoInput.files[0]; // Corregido para obtener el archivo de imagen

    if (imagenEventoFile) {
        const imagenEventoURL = URL.createObjectURL(imagenEventoFile);

        const eventoDiv = document.createElement('div');
        eventoDiv.className = 'row';

        eventoDiv.innerHTML = `
            <div class="col-12 col-md-6 ps-0 pe-0">
                <img src="${imagenEventoURL}" alt="${nombreEvento}" style="width: 100%;">
            </div>
            <div class="col-12 col-md-6 pt-2 pb-2">
                <h2>${nombreEvento}</h2>
                <p>${descripcionEvento}</p>
                <p>Fecha: ${fechaEvento}</p>
            </div>
        `;

        eventosContainer.appendChild(eventoDiv);

        agregarEventoForm.reset();

        URL.revokeObjectURL(imagenEventoURL);
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
