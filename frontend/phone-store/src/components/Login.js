import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import '../pages/styles/login.css';

function Login({ onLogin }) {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  const handleLogin = (e) => {
    e.preventDefault();
    const formData = new FormData()
    formData.append('username', username)
    formData.append('password', password)

    fetch(`http://my-site.ru/loginProcessing.php`, {
      method: 'POST', 
      body: formData
    })
    .then((e)=>e.json())
    .then((e)=>{
      if (e.success) {
        localStorage.setItem('userId', e.id);
        navigate('/');
      }
      else {
        alert('Неправильный логин или пароль');
      }
    })
  };

  return (
    <div className='main'>
      <div className='header'>
        <h1>SmartPlanet</h1>
      </div>

      <div className='form'>
        <form onSubmit={handleLogin}>
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
        <button type="submit">Войти</button>
      </form>
      </div>
    </div>
    
  );
}

export default Login;