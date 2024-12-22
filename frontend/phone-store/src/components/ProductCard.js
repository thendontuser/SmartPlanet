import React from 'react';
import { Link } from 'react-router-dom';
import '../pages/styles/product-card.css';

function ProductCard({ product }) {
  const handleAddToCart = () => {
    const formData = new FormData()
    formData.append('userId', localStorage.getItem('userId'))
    formData.append('productId', product[0])

    fetch(`http://my-site.ru/addingToCart.php`, {
      method: 'POST', 
      body: formData
    })
    .then((e)=>e.json())

    alert('Товар ' + product[1] + ' добавлен в корзину');
  }

  return (
    <div className="product-card">
      <img 
        src={product[6]} alt={product[1]}
      />
      <h3>{product[1]}</h3>
      <p>{product[2]}</p>
      <Link to={`/product/${product[0]}`}>Описание товара</Link>
      <div className="button-container">
        <button onClick={handleAddToCart}>Добавить в корзину</button>
      </div>
    </div>
  );
}

export default ProductCard;