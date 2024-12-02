import React from 'react';
import { Link } from 'react-router-dom';

function ProductCard({ product }) {
  return (
    <div className="product-card">
      <img src={product.image} alt={product.name} />
      <h3>{product.name}</h3>
      <p>{product.description}</p>
      <Link to={`/product/${product.id}`}>Описание товара</Link>
      <button>Добавить в корзину</button>
    </div>
  );
}

export default ProductCard;