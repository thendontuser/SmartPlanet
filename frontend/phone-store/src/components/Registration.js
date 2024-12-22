import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import '../pages/styles/registration.css';

function Registration({ onLogin }) {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [phone, setPhone] = useState('');
  const navigate = useNavigate();

  const handleRegistration = (e) => {
    e.preventDefault();
    const formData = new FormData()
    formData.append('username', username)
    formData.append('password', password)
    formData.append('phone', phone)

    fetch(`http://my-site.ru/regProcessing.php`, {
      method: 'POST', 
      body: formData
    })
    .then((e)=>e.json())
    .then((e)=> {
      if (e.success) {
        navigate('/');
      }
      else {
        alert('Такой логин занят');
      }
    })
  };

  return (
    <div className='main'>
      <div className='header'>
        <h1>SmartPlanet</h1>
      </div>

      <div className='form'>
        <form onSubmit={handleRegistration}>
        <label>
          Логин:
          <input
            type="text"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
          />
        </label>
        <label>
          Пароль:
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
        </label>
        <label>
          Номер телефона:
          <input
            type="text"
            value={phone}
            onChange={(e) => setPhone(e.target.value)}
          />
        </label>
        <button type="submit">Зарегистрироваться</button>
      </form>
      </div>
    </div>
    
  );
}

export default Registration;