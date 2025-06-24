const express = require('express');
const multer = require('multer');
const cors = require('cors');
const path = require('path');
const fs = require('fs');

const app = express();
const PORT = process.env.PORT || 10000;

app.use(cors());
app.use(express.json());
app.use('/uploads', express.static(path.join(__dirname, 'uploads')));
app.use(express.static(__dirname)); // Para servir blog.html y blog.css

const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, 'uploads/');
  },
  filename: function (req, file, cb) {
    cb(null, Date.now() + '-' + file.originalname);
  }
});
const upload = multer({ storage: storage });

const DATA_FILE = path.join(__dirname, 'opiniones.json');

function leerOpiniones() {
  if (!fs.existsSync(DATA_FILE)) return [];
  return JSON.parse(fs.readFileSync(DATA_FILE, 'utf8'));
}

function guardarOpiniones(opiniones) {
  fs.writeFileSync(DATA_FILE, JSON.stringify(opiniones, null, 2));
}

app.get('/api/opiniones', (req, res) => {
  res.json(leerOpiniones());
});

app.post('/api/opiniones', upload.single('imagen'), (req, res) => {
  const { nombre, opinion } = req.body;
  let imagenUrl = null;
  if (req.file) {
    imagenUrl = `/uploads/${req.file.filename}`;
  }
  const opiniones = leerOpiniones();
  opiniones.push({ nombre, opinion, imagen: imagenUrl });
  guardarOpiniones(opiniones);
  res.json({ ok: true });
});

app.listen(PORT, () => {
  console.log(`Servidor escuchando en http://localhost:${PORT}`);
});