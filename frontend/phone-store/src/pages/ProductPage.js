import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import './styles/product-card.css';

function ProductPage() {
  const { id } = useParams();
  const [product, setProduct] = useState(null);

  useEffect(() => {
    fetch(`http://my-site.ru/productInfo.php?id=${id}`)
      .then(response => response.json())
      .then(data => setProduct(data));
  }, [id]);

  if (!product) {
    return <p>Загрузка...</p>;
  }

  return (
    <div className='product-page'>
      <div className='header'>
        <h1>SmartPlanet</h1>
      </div>

      <h2>{product[1]}</h2>
      <img src={product.image} alt={product[1]} />
      <p>{product[2]}</p>
      <p>Цена: {product[3]}</p>
      <button>Добавить в корзину</button>
    </div>
  );
}

export default ProductPage;