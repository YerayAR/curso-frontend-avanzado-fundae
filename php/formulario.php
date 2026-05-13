<?php
declare(strict_types=1);

$errors = [];
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

$data = [
    'nombre' => '',
    'email' => '',
    'telefono' => '',
    'edad' => '',
    'monto' => '',
    'metodo_pago' => '',
    'comentarios' => ''
];

if ($submitted) {
    foreach ($data as $key => $value) {
        $data[$key] = trim((string)($_POST[$key] ?? ''));
    }

    if ($data['nombre'] === '' || mb_strlen($data['nombre']) < 3) {
        $errors['nombre'] = 'El nombre es obligatorio y debe tener al menos 3 caracteres.';
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El email no tiene un formato valido.';
    }

    if (!preg_match('/^\+?[0-9\s\-]{9,15}$/', $data['telefono'])) {
        $errors['telefono'] = 'El telefono debe tener entre 9 y 15 digitos (puede incluir +, espacios o guiones).';
    }

    if (!preg_match('/^[0-9]{1,3}$/', $data['edad']) || (int)$data['edad'] < 18 || (int)$data['edad'] > 99) {
        $errors['edad'] = 'La edad debe ser numerica y estar entre 18 y 99.';
    }

    if (!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $data['monto']) || (float)$data['monto'] <= 0) {
        $errors['monto'] = 'El monto debe ser numerico y mayor que 0 (maximo 2 decimales).';
    }

    $metodosValidos = ['tarjeta', 'transferencia', 'bizum', 'paypal'];
    if (!in_array($data['metodo_pago'], $metodosValidos, true)) {
        $errors['metodo_pago'] = 'Selecciona un metodo de pago valido.';
    }

    if ($data['comentarios'] !== '' && mb_strlen($data['comentarios']) > 300) {
        $errors['comentarios'] = 'Los comentarios no pueden superar los 300 caracteres.';
    }
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario PHP - FUNDAE</title>
  <style>
    :root {
      --bg: #f2f1ec;
      --surface: #fff;
      --ink: #1d2731;
      --muted: #526274;
      --accent: #b4531b;
      --line: #ddd8cf;
      --ok: #186a3b;
      --bad: #9a1f1f;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Segoe UI", Tahoma, sans-serif;
      background: var(--bg);
      color: var(--ink);
      line-height: 1.5;
    }
    .wrap {
      width: min(920px, 94%);
      margin: 1.5rem auto 2rem;
    }
    .card {
      background: var(--surface);
      border: 1px solid var(--line);
      border-radius: 12px;
      padding: 1rem;
      margin-bottom: 1rem;
    }
    h1 { margin: 0 0 0.5rem; }
    p { color: var(--muted); }
    .grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 0.9rem;
    }
    .field { display: grid; gap: 0.3rem; }
    .field.full { grid-column: 1 / -1; }
    label { font-weight: 600; }
    input, select, textarea {
      width: 100%;
      border: 1px solid #cfd6df;
      border-radius: 8px;
      padding: 0.55rem 0.65rem;
      font: inherit;
    }
    textarea { min-height: 110px; resize: vertical; }
    .error {
      margin: 0;
      color: var(--bad);
      font-size: 0.9rem;
    }
    .ok {
      border: 1px solid #b8dfc3;
      background: #edf8f0;
      color: var(--ok);
      border-radius: 10px;
      padding: 0.7rem;
      margin-bottom: 0.8rem;
    }
    .actions {
      display: flex;
      gap: 0.7rem;
      flex-wrap: wrap;
      margin-top: 0.4rem;
    }
    .btn {
      border: 1px solid #9d3f0e;
      background: var(--accent);
      color: #fff;
      border-radius: 999px;
      padding: 0.45rem 0.95rem;
      text-decoration: none;
      cursor: pointer;
      font: inherit;
    }
    .btn.alt {
      border-color: #9fb1c5;
      background: #f3f7fb;
      color: #21435f;
    }
    .summary {
      margin: 0;
      padding-left: 1rem;
    }
    @media (max-width: 760px) {
      .grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <main class="wrap">
    <section class="card">
      <h1>Formulario validado con PHP</h1>
      <p>
        Incluye validaciones de nombre, email, telefono, campos numericos y metodos de pago.
        Tambien detecta formatos erroneos y muestra los errores por campo.
      </p>
      <a href="index.html" class="btn alt">Volver a la pagina principal</a>
    </section>

    <section class="card">
      <?php if ($submitted && empty($errors)): ?>
        <div class="ok">Formulario enviado correctamente. Datos recibidos:</div>
        <ul class="summary">
          <li><strong>Nombre:</strong> <?= e($data['nombre']) ?></li>
          <li><strong>Email:</strong> <?= e($data['email']) ?></li>
          <li><strong>Telefono:</strong> <?= e($data['telefono']) ?></li>
          <li><strong>Edad:</strong> <?= e($data['edad']) ?></li>
          <li><strong>Monto:</strong> <?= e($data['monto']) ?></li>
          <li><strong>Metodo de pago:</strong> <?= e($data['metodo_pago']) ?></li>
          <li><strong>Comentarios:</strong> <?= e($data['comentarios']) ?></li>
        </ul>
      <?php endif; ?>

      <form method="post" action="formulario.php" novalidate>
        <div class="grid">
          <div class="field">
            <label for="nombre">Nombre completo</label>
            <input id="nombre" name="nombre" type="text" required minlength="3" value="<?= e($data['nombre']) ?>">
            <?php if (isset($errors['nombre'])): ?><p class="error"><?= e($errors['nombre']) ?></p><?php endif; ?>
          </div>

          <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required value="<?= e($data['email']) ?>" placeholder="nombre@dominio.com">
            <?php if (isset($errors['email'])): ?><p class="error"><?= e($errors['email']) ?></p><?php endif; ?>
          </div>

          <div class="field">
            <label for="telefono">Telefono</label>
            <input id="telefono" name="telefono" type="tel" required value="<?= e($data['telefono']) ?>" placeholder="+34 600 123 456">
            <?php if (isset($errors['telefono'])): ?><p class="error"><?= e($errors['telefono']) ?></p><?php endif; ?>
          </div>

          <div class="field">
            <label for="edad">Edad</label>
            <input id="edad" name="edad" type="number" required min="18" max="99" value="<?= e($data['edad']) ?>">
            <?php if (isset($errors['edad'])): ?><p class="error"><?= e($errors['edad']) ?></p><?php endif; ?>
          </div>

          <div class="field">
            <label for="monto">Monto (EUR)</label>
            <input id="monto" name="monto" type="text" required value="<?= e($data['monto']) ?>" placeholder="99.90">
            <?php if (isset($errors['monto'])): ?><p class="error"><?= e($errors['monto']) ?></p><?php endif; ?>
          </div>

          <div class="field">
            <label for="metodo_pago">Metodo de pago</label>
            <select id="metodo_pago" name="metodo_pago" required>
              <option value="">Selecciona una opcion</option>
              <option value="tarjeta" <?= $data['metodo_pago'] === 'tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
              <option value="transferencia" <?= $data['metodo_pago'] === 'transferencia' ? 'selected' : '' ?>>Transferencia</option>
              <option value="bizum" <?= $data['metodo_pago'] === 'bizum' ? 'selected' : '' ?>>Bizum</option>
              <option value="paypal" <?= $data['metodo_pago'] === 'paypal' ? 'selected' : '' ?>>PayPal</option>
            </select>
            <?php if (isset($errors['metodo_pago'])): ?><p class="error"><?= e($errors['metodo_pago']) ?></p><?php endif; ?>
          </div>

          <div class="field full">
            <label for="comentarios">Comentarios (opcional)</label>
            <textarea id="comentarios" name="comentarios" maxlength="300" placeholder="Maximo 300 caracteres"><?= e($data['comentarios']) ?></textarea>
            <?php if (isset($errors['comentarios'])): ?><p class="error"><?= e($errors['comentarios']) ?></p><?php endif; ?>
          </div>
        </div>

        <div class="actions">
          <button class="btn" type="submit">Enviar formulario</button>
          <a class="btn alt" href="formulario.php">Limpiar</a>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
