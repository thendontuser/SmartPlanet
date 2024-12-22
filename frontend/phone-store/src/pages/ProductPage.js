import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import './styles/product-page.css';

function ProductPage() {
  const { id } = useParams();
  const [product, setProduct] = useState(null);

  const handleAddToCart = () => {
    const formData = new FormData()
    formData.append('userId', localStorage.getItem('userId'))
    formData.append('productId', product[0])

    fetch(`http://my-site.ru/addingToCart.php`, {
      method: 'POST', 
      body: formData
    })
    .then((e)=>e.json())

    alert('Товар добавлен в корзину');
  }

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

      <h2>{product[0][1]}</h2>
      <img src={product[0][6]} alt={product[1]} />
      <p>{product[0][2]}</p>
      <p>В наличии {product[0][4]} штук(и)</p>
      <p>Цена: {product[0][3]} руб.</p>
      <button onClick={handleAddToCart}>Добавить в корзину</button>
    </div>
  );
}

export default ProductPage;