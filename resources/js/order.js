document.addEventListener('DOMContentLoaded', () => {

    const summary = document.getElementById('order-summary');
    const totalPrice = document.getElementById('total-price');
    const itemsInput = document.getElementById('items-input');

    // Kalau bukan halaman Create Order, hentikan.
    if (!summary || !totalPrice || !itemsInput) {
        return;
    }

    const cart = {};

    // Add Menu
    document.querySelectorAll('.add-menu').forEach(button => {

        button.addEventListener('click', function () {

            const card = this.closest('.menu-card');

            const id = card.dataset.id;
            const name = card.dataset.name;
            const price = Number(card.dataset.price);

            if (!cart[id]) {

                cart[id] = {
                    id,
                    name,
                    price,
                    qty: 1
                };

            } else {

                cart[id].qty++;

            }

            renderCart();

        });

    });

    // Qty di Order Summary
    summary.addEventListener('click', function (e) {

        if (e.target.classList.contains('plus-cart')) {

            const id = e.target.dataset.id;

            cart[id].qty++;

            renderCart();

        }

        if (e.target.classList.contains('minus-cart')) {

            const id = e.target.dataset.id;

            cart[id].qty--;

            if (cart[id].qty <= 0) {
                delete cart[id];
            }

            renderCart();

        }

    });

    function renderCart() {

        if (Object.keys(cart).length === 0) {

            summary.innerHTML = `
                <div class="text-6xl mb-5">🛒</div>
                <p class="text-xl">No item selected.</p>
                <p class="text-gray-400 mt-2">Add menu from the left.</p>
            `;

            totalPrice.innerText = 'Rp 0';
            itemsInput.value = '';

            return;
        }

        let html = '';
        let total = 0;

        Object.values(cart).forEach(item => {

            const subtotal = item.qty * item.price;

            total += subtotal;

            html += `
                <div class="border-b pb-4 mb-4">

                    <div class="flex justify-between items-start">

                        <div>

                            <p class="font-semibold text-lg">
                                ${item.name}
                            </p>

                            <div class="flex items-center gap-2 mt-3">

                                <button
                                    type="button"
                                    class="minus-cart w-8 h-8 border rounded hover:bg-gray-100"
                                    data-id="${item.id}">

                                    -

                                </button>

                                <span class="font-semibold w-6 text-center">

                                    ${item.qty}

                                </span>

                                <button
                                    type="button"
                                    class="plus-cart w-8 h-8 border rounded hover:bg-gray-100"
                                    data-id="${item.id}">

                                    +

                                </button>

                            </div>

                        </div>

                        <div class="text-right">

                            <p class="font-semibold text-lg">

                                Rp ${subtotal.toLocaleString('id-ID')}

                            </p>

                            <p class="text-sm text-gray-500">

                                ${item.qty} × Rp ${item.price.toLocaleString('id-ID')}

                            </p>

                        </div>

                    </div>

                </div>
            `;

        });

        summary.innerHTML = html;

        totalPrice.innerText = 'Rp ' + total.toLocaleString('id-ID');
        itemsInput.value = JSON.stringify(
            Object.values(cart).map(item => ({
                id: item.id,
                qty: item.qty
            }))
        );

    }

});