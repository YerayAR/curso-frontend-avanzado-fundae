# Curso Certificado de Frontend y Backend Avanzado - FUNDAE

Este repositorio presenta una coleccion de ejercicios organizados como parte de un itinerario formativo de frontend y backend avanzado. La idea principal del proyecto es ofrecer una entrada unica desde una landing page y, desde ahi, acceder de forma clara a las practicas de cliente y servidor.

## Objetivo del proyecto

- Mostrar una estructura academica y ordenada del curso.
- Separar de forma clara los bloques de frontend, PHP y Java.
- Servir como base para seguir ampliando ejercicios sin perder coherencia.

## Estructura del repositorio

- `index.html`
  Landing principal del curso. Actua como punto de entrada y organiza la navegacion hacia las distintas vistas.

- `styles.css`
  Hoja de estilos principal para la landing y los ejercicios frontend integrados en la portada.

- `script.js`
  Logica JavaScript para las galerias, el lightbox y los ejemplos dinamicos del bloque frontend.

- `php/formulario.php`
  Vista backend en PHP con formulario y validaciones de servidor.

- `java/imc.jsp`
  Vista backend en Java JSP con calculadora IMC y lista en sesion.

- `agen.md`
  Guia para futuras IA o colaboradores, con reglas para mantener la estructura del curso certificado.

## Recorrido funcional

### 1. Landing principal

La portada `index.html` centraliza el proyecto y explica el recorrido formativo:

- acceso a la parte frontend
- acceso a la practica backend en PHP
- acceso a la practica backend en Java
- resumen del itinerario del certificado

### 2. Bloque frontend

Dentro de la landing se incluye una zona dedicada a ejercicios de frontend con:

- HTML semantico
- CSS responsive
- posicionamiento CSS
- galerias visuales con efectos
- ejemplos de JavaScript vanilla

### 3. Bloque backend PHP

La ruta `php/formulario.php` contiene:

- formulario completo
- validacion de nombre, email, telefono, edad y monto
- validacion del metodo de pago
- mensajes de error por campo
- confirmacion de envio correcta

### 4. Bloque backend Java

La ruta `java/imc.jsp` contiene:

- calculadora IMC
- validacion de datos numericos
- categorizacion del resultado
- lista interactiva mantenida en sesion

## Como usar el proyecto

### Opcion 1. Abrir la landing frontend

Abre `index.html` en un navegador para recorrer la portada y las practicas visuales.

### Opcion 2. Ejecutar la vista PHP

Para probar `php/formulario.php`, usa un entorno con soporte PHP, por ejemplo:

- XAMPP
- Laragon
- servidor embebido de PHP

Ejemplo con servidor embebido:

```bash
php -S localhost:8000
```

Despues abre:

```text
http://localhost:8000/php/formulario.php
```

### Opcion 3. Ejecutar la vista Java JSP

Para probar `java/imc.jsp`, despliega el proyecto en un servidor compatible con JSP, por ejemplo:

- Apache Tomcat
- Eclipse con servidor Java configurado
- IntelliJ IDEA con soporte Jakarta EE o Java EE

## Criterios del proyecto

- Todo el contenido debe mantener un tono academico y didactico.
- La pagina principal debe seguir funcionando como landing estructurada.
- Cualquier nueva practica debe encajar en la logica del certificado.
- Las rutas entre `index.html`, `php/` y `java/` no deben romperse.

## Recomendaciones para futuras ampliaciones

- Anadir nuevas vistas backend en carpetas organizadas por tecnologia.
- Incluir nuevos modulos frontend como formularios, consumo de APIs o accesibilidad.
- Reflejar cada nueva practica en la landing principal si forma parte del recorrido del curso.
- Mantener actualizado `agen.md` si cambian los criterios de estructura.

## Autor y contexto

Repositorio de practicas orientado a un certificado de frontend y backend avanzado de FUNDAE, preparado para presentar de forma ordenada ejercicios de cliente y servidor dentro de un mismo proyecto.
