import React, { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import '../pages/styles/products-incart.css';
import OrderModal from './OrderModal';

function ProductCardInCart({product}) {
  const [isModalOpen, setIsModalOpen] = useState(false);

  const handleOrderClick = () => {
      setIsModalOpen(true);
  };

  const closeModal = () => {
      setIsModalOpen(false);
  };

  return (
    <div className="product-card-in-cart">
      <img 
        src={product[6]} alt={product[1]}
      />
      <h3>{product[1]}</h3>
      <p>{product[2]}</p>
      <Link to={`/product/${product[0]}`}>Описание товара</Link>
      <div className="button-container">
        <button onClick={handleOrderClick}>Заказать</button>
      </div>
      {isModalOpen && <OrderModal closeModal={closeModal} productId={product[0]} />}
    </div>
  );
}

export default ProductCardInCart;