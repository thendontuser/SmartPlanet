import React, { useState } from 'react';
import '../pages/styles/order-modal.css';

const OrderModal = ({ closeModal, productId }) => {
    const [deliveryAddress, setDeliveryAddress] = useState('');

    const handleConfirmOrder = () => {
        if (deliveryAddress) {
            const formData = new FormData()
            formData.append('userId', localStorage.getItem('userId'))
            formData.append('productId', productId)
            formData.append('address', deliveryAddress)

            fetch(`http://my-site.ru/addingOrder.php`, {
            method: 'POST', 
            body: formData
            })
            .then((e)=>e.json())

            alert('Заказ оформлен на адрес: ' + deliveryAddress);
            closeModal();
            setDeliveryAddress('');
        } else {
            alert('Пожалуйста, введите адрес доставки.');
        }
    };

    return (
        <div className="modal">
            <div className="modal-content">
                <span className="close" onClick={closeModal}>&times;</span>
                <h2>Введите адрес доставки</h2>
                <input
                    type="text"
                    value={deliveryAddress}
                    onChange={(e) => setDeliveryAddress(e.target.value)}
                    placeholder="Ваш адрес"
                    required
                />
                <button onClick={handleConfirmOrder}>Оформить заказ</button>
            </div>
        </div>
    );
};

export default OrderModal;