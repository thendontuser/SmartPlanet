import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';

function ProductPage() {
  const { id } = useParams();
  const [product, setProduct] = useState(null);

  useEffect(() => {
    fetch(`/api/products/${id}`)
      .then(response => response.json())
      .then(data => setProduct(data));
  }, [id]);

  if (!product) return <p>Загрузка...</p>;

  return (
    <div>
      <h2>{product.name}</h2>
      <img src={product.image} alt={product.name} />
      <p>{product.description}</p>
      <p>Цена: {product.price}</p>
      <button>Добавить в корзину</button>
    </div>
  );
}

export default ProductPage;