const express = require('express');
const ordenesController = require('./controllers/ordenesController');
const morgan = require('morgan'); 
const app = express();
app.use(morgan('dev'));
app.use(express.json());

app.use(ordenesController);

const PORT = process.env.PORT || 3003;
app.listen(PORT, '0.0.0.0', () => {
  console.log(`Microservicio Ordenes ejecutandose en el puerto ${PORT}`);
});
