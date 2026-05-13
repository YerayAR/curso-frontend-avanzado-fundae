<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page import="java.util.ArrayList" %>
<%@ page import="java.util.List" %>
<%
  request.setCharacterEncoding("UTF-8");

  String accion = request.getParameter("accion");
  String resultadoImc = null;
  String categoria = null;
  String error = null;

  List<String> elementos = (List<String>) session.getAttribute("elementos");
  if (elementos == null) {
    elementos = new ArrayList<String>();
    elementos.add("HTML semantico");
    elementos.add("CSS responsive");
    session.setAttribute("elementos", elementos);
  }

  if ("calcular".equals(accion)) {
    try {
      double peso = Double.parseDouble(request.getParameter("peso"));
      double alturaCm = Double.parseDouble(request.getParameter("altura"));

      if (peso <= 0 || alturaCm <= 0) {
        error = "Peso y altura deben ser mayores que 0.";
      } else {
        double alturaM = alturaCm / 100.0;
        double imc = peso / (alturaM * alturaM);
        resultadoImc = String.format("%.2f", imc);

        if (imc < 18.5) {
          categoria = "Bajo peso";
        } else if (imc < 25) {
          categoria = "Normal";
        } else if (imc < 30) {
          categoria = "Sobrepeso";
        } else {
          categoria = "Obesidad";
        }
      }
    } catch (Exception ex) {
      error = "Introduce valores numericos validos para peso y altura.";
    }
  }

  if ("agregar".equals(accion)) {
    String nuevo = request.getParameter("nuevoElemento");
    if (nuevo != null) {
      nuevo = nuevo.trim();
      if (!nuevo.isEmpty()) {
        elementos.add(nuevo);
      }
    }
  }
%>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista Java - IMC y Lista</title>
  <style>
    :root {
      --bg: #f4f1ea;
      --surface: #ffffff;
      --ink: #1e2934;
      --muted: #5b6773;
      --accent: #0f766e;
      --line: #ddd6ca;
      --ok: #166534;
      --bad: #b91c1c;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Segoe UI", Tahoma, sans-serif;
      color: var(--ink);
      background: var(--bg);
    }
    .wrap {
      width: min(1000px, 94%);
      margin: 1.5rem auto 2rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    .card {
      background: var(--surface);
      border: 1px solid var(--line);
      border-radius: 12px;
      padding: 1rem;
    }
    .full { grid-column: 1 / -1; }
    h1, h2 { margin: 0 0 0.55rem; }
    p { margin: 0.4rem 0 0.8rem; color: var(--muted); }
    .field { margin-bottom: 0.65rem; }
    label { display: block; font-weight: 600; margin-bottom: 0.3rem; }
    input {
      width: 100%;
      border: 1px solid #cfd8e3;
      border-radius: 8px;
      padding: 0.5rem 0.6rem;
      font: inherit;
    }
    .btn {
      border: 1px solid #0a5751;
      border-radius: 999px;
      background: var(--accent);
      color: #fff;
      padding: 0.45rem 0.85rem;
      cursor: pointer;
      font: inherit;
      text-decoration: none;
      display: inline-block;
    }
    .btn.alt {
      background: #f2f6f9;
      color: #23455b;
      border-color: #9fb3c5;
      margin-left: 0.45rem;
    }
    .result {
      margin-top: 0.7rem;
      border: 1px solid #b7dfcf;
      background: #ecfaf4;
      border-radius: 8px;
      padding: 0.6rem;
      color: var(--ok);
      font-weight: 600;
    }
    .error {
      margin-top: 0.7rem;
      border: 1px solid #f1c2c2;
      background: #fff1f1;
      border-radius: 8px;
      padding: 0.6rem;
      color: var(--bad);
      font-weight: 600;
    }
    ul { margin: 0.5rem 0 0; padding-left: 1rem; }
    li { margin: 0.25rem 0; }
    @media (max-width: 860px) {
      .wrap { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <main class="wrap">
    <section class="card full">
      <h1>Aplicacion Java Web (JSP)</h1>
      <p>
        Esta vista usa Java en servidor para calcular IMC y para gestionar una lista simple en sesion.
      </p>
      <a class="btn alt" href="../index.html">Volver a la principal</a>
    </section>

    <section class="card">
      <h2>Calculadora IMC</h2>
      <p>Resultado redondeado a dos decimales.</p>
      <form method="post" action="imc.jsp">
        <input type="hidden" name="accion" value="calcular">
        <div class="field">
          <label for="peso">Peso (kg)</label>
          <input id="peso" name="peso" type="text" required placeholder="Ej: 72.5">
        </div>
        <div class="field">
          <label for="altura">Altura (cm)</label>
          <input id="altura" name="altura" type="text" required placeholder="Ej: 178">
        </div>
        <button class="btn" type="submit">Calcular IMC</button>
      </form>

      <% if (resultadoImc != null) { %>
        <div class="result">IMC: <%= resultadoImc %> - Categoria: <%= categoria %></div>
      <% } %>
      <% if (error != null) { %>
        <div class="error"><%= error %></div>
      <% } %>
    </section>

    <section class="card">
      <h2>Lista interactiva</h2>
      <p>Agregar elementos a una lista mantenida en sesion.</p>
      <form method="post" action="imc.jsp">
        <input type="hidden" name="accion" value="agregar">
        <div class="field">
          <label for="nuevoElemento">Nuevo elemento</label>
          <input id="nuevoElemento" name="nuevoElemento" type="text" required placeholder="Ej: Java Servlets">
        </div>
        <button class="btn" type="submit">Agregar</button>
      </form>

      <ul>
        <% for (String item : elementos) { %>
          <li><%= item %></li>
        <% } %>
      </ul>
    </section>
  </main>
</body>
</html>
