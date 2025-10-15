const express = require('express');
const usuariosController = require('./controllers/usuariosController');
const morgan = require('morgan'); 
const app = express();
app.use(morgan('dev'));
app.use(express.json());

app.use(usuariosController);

const PORT = process.env.PORT || 3001;
app.listen(PORT, '0.0.0.0', () => {
  console.log(`Microservicio Usuarios ejecutandose en el puerto ${PORT}`);
});
