const express = require('express');
const productosController = require('./controllers/productosController');
const morgan = require('morgan'); 
const app = express();
app.use(morgan('dev'));
app.use(express.json());

app.use(productosController);

const PORT = process.env.PORT || 3002;
app.listen(PORT, '0.0.0.0', () => {
  console.log(`Microservicio Productos ejecutandose en el puerto ${PORT}`);
});

