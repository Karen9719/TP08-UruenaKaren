# Trabajo Práctico Final – Laboratorio II

Este proyecto corresponde al **Trabajo Práctico Final de la materia Laboratorio II**, donde se integran y aplican de manera práctica los principales contenidos vistos a lo largo de la cursada, haciendo foco en el **manejo de bases de datos con PHP y SQL**.

El objetivo principal fue desarrollar un sistema funcional que permita **gestionar información persistente**, aplicando buenas prácticas de diseño de bases de datos, consultas SQL seguras y control de acceso mediante sesiones.

---

## Contenidos Aplicados

En este trabajo se integran los siguientes conceptos:

### Bases de Datos
- Creación y administración de bases de datos con **MySQL**
- Diseño de tablas respetando criterios de:
  - Un dato por campo
  - Tipos de datos adecuados
  - Claves primarias
  - Campos autoincrementales
- Importación y exportación de bases de datos mediante **phpMyAdmin**

---

### Consultas SQL
Se implementaron los cuatro tipos fundamentales de consultas:

- **SELECT**
  - Consultas simples
  - Consultas con `WHERE`
  - Uso de `LIKE` para búsquedas parciales
- **INSERT**
  - Inserción de datos desde formularios
  - Manejo de valores `NULL`
  - Inserción de fechas en formato correcto
- **UPDATE**
  - Modificación de registros existentes
  - Actualización controlada por identificador
- **DELETE**
  - Eliminación segura de registros
  - Confirmación previa antes de borrar datos

Todas las consultas se realizaron mediante **sentencias preparadas**, evitando inyecciones SQL.

---

### Seguridad
- Encriptación de claves utilizando **SHA1**
- Uso de consultas preparadas con `mysqli_prepare`
- Validación de datos recibidos desde formularios

---

### Sesiones
- Implementación de **inicio y cierre de sesión**
- Control de acceso a páginas privadas
- Uso del arreglo `$_SESSION` para mantener datos del usuario activo
- Prevención de accesos directos a páginas restringidas

---

### Cookies
- Creación y uso de cookies para almacenar preferencias del usuario
- Definición de tiempo de expiración
- Eliminación de cookies

---

### 🛒 Funcionalidades adicionales
- Menú dinámico por categorías utilizando variables `GET`
- Buscador que muestra resultados en la misma página
- Implementación de un **carrito de compras** utilizando sesiones
- Manejo de cantidades y productos seleccionados

---

## Tecnologías Utilizadas

- **PHP**
- **MySQL**
- **SQL**
- **phpMyAdmin**
- **XAMPP**
- **HTML**

---

## Objetivo del trabajo practico

El proyecto tiene como finalidad **consolidar los conocimientos adquiridos en la materia**, demostrando la capacidad de:
- Diseñar una base de datos coherente
- Interactuar con ella desde PHP
- Gestionar información de forma segura
- Simular el funcionamiento real de un sistema web dinámico

---

## Contexto Académico

Trabajo realizado para la materia **Laboratorio II – Laboratorio de Software II**  
Año: **2025**

---

## Autora

**Karen Urueña**  
Tecnicatura en Programación / Estudiante de Ingeniería Informática
