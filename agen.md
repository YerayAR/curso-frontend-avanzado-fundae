# AGEN

## Proposito

Este proyecto debe mantenerse como una estructura de ejercicios pertenecientes a un curso certificado de frontend y backend avanzado. Cualquier IA que edite este repositorio debe respetar la separacion entre bloques formativos, la coherencia visual y el caracter educativo del contenido.

## Estructura general del curso

- `index.html` es la landing principal del curso.
- La landing debe presentar el proyecto como un itinerario formativo claro.
- Debe existir una separacion visible entre:
  - ejercicios de frontend
  - ejercicios backend en PHP
  - ejercicios backend en Java

## Reglas para la landing principal

- Usar `index.html` como punto de entrada unico.
- Mantener una portada con:
  - introduccion al curso
  - accesos directos a cada tecnologia o modulo
  - explicacion breve del recorrido formativo
- La navegacion debe ser sencilla, semantica y comprensible.
- El estilo visual debe ser consistente, moderno y responsive.
- No convertir la portada en una pagina desordenada de pruebas inconexas.

## Reglas para frontend

- El bloque frontend debe agrupar ejercicios de:
  - HTML semantico
  - CSS responsive y posicionamiento
  - JavaScript vanilla
- Se debe priorizar claridad didactica sobre complejidad innecesaria.
- Mantener ejemplos visuales que ayuden a entender conceptos del curso.

## Reglas para backend PHP

- Los ejercicios PHP deben mantenerse en la carpeta `php/`.
- Deben representarse como practicas de servidor orientadas a validacion, formularios, procesamiento de datos o logica basica.
- Si se añade una nueva vista PHP, debe enlazarse desde la landing cuando tenga valor dentro del recorrido del curso.

## Reglas para backend Java

- Los ejercicios Java deben mantenerse en la carpeta `java/`.
- Deben presentarse como practicas backend tipo JSP, servlets o logica de servidor equivalente segun el proyecto.
- Si se añade una nueva vista Java, debe enlazarse desde la landing cuando forme parte del itinerario formativo.

## Criterios de estilo

- Escribir textos en espanol.
- Mantener tono academico, claro y orientado a formacion.
- Evitar nombres o bloques genericos sin contexto.
- Cualquier nueva seccion debe explicar que competencia del certificado representa.

## Criterios tecnicos

- Respetar las rutas relativas existentes.
- No romper los enlaces entre `index.html`, `php/` y `java/`.
- Mantener compatibilidad responsive.
- Reutilizar `styles.css` y `script.js` cuando tenga sentido antes de duplicar codigo.

## Objetivo de futuras ediciones

Toda modificacion debe reforzar esta idea:

Este repositorio no es solo una coleccion de ejercicios sueltos, sino una presentacion estructurada de un certificado de frontend y backend avanzado.
