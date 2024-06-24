<p align="center">
  <a href="" rel="noopener">
 <img width=auto height=200px src="https://ci3.googleusercontent.com/mail-img-att/AGAZnRqzGiOqGbIeUPkrq0XOjMTUA8tnLGEExLnli3_YJT6Rm2ZYICRX2let64EOE4yC9zvJjwft2R_57EdiDxld-lu03y01Zya80l38GggIitPH4RygV7NlAVXQ1y1nwX9al0RIOqFaDl0RMyXXqKHX6x-nTZmje_CYpkW4Iplb5N39aj2JdmnybTdjJVQqWK0VtJmKPZobJveHQ6-rxLCMqIkNqNwAHNFO1JoKN3H6KnOEVRmpUnv74acCJmq3p1QGwiyFYLybNyHHTe910i-e-Wd2j6wiDFOyk35RG4bMabNu2Ax0s0m2o0T49YgFX7EBj_T3REocnFplF4gamwOki-PEqVWRNEJKze_DcwkN5e8m_qUr4qWZtUnZRv4Jz6YRN1PzHrDvr1V0zsCV_0QIzRNCVyBu3K0uh_iNzcDmb8MxPDlv0XgxBY-5sN5eLzGezP062klqWCM8johALaHEMYP7WX74WOG9EU4a1iLAWU70KoHkrGLf-o7JPnNJFRykNE6y0CBcwF5D05UparGWbgFjDPnbtIDUeWnDTuKcQodegWGiK0tBih08WzyJfCvSRK0AExX3zbZWGqOEqlkh1jcOWCC3qeWDHDnjiIc17gEqIPeBimsi2mu-wIIRyNkobQbIrifMEBAW2DVtI4n_EyZLWthzVqwmgz4-gqPVzaD7OXFxokb4MlUXgfJ6jLNX3XlWflkwsX19jetMFgVEq8zi8Ws41yOkM88wyJxZZ3pf0kqk-RE9A9mgT_giIgZDPDH5fi-Hlt0DIiE6yYWN6EexsbwhpfevRPdzulXRlNsPxjCMxO5DwbSCoF89cTfOEQ0kxxX19PkSVivpVi9zOINKEqz1S6F4VEKmd6nP_ZD69BwJmLBpTMhiSCwFDIDnRiF5WRnYiqtBwiq624mamgk3Fo2BS8UyAyuv_l05nW6SKWidOCJqDwDd_42T0CVCgIHpeLZcnLx1MyqaSHivsOiiVBdXGOAuicSG94J73yk1d649LqCMOMV4J3bPMTNNpIEZ-nJdDDfa242kP2kVNf3i2w=s0-l75-ft" alt="Project logo"></a>
</p>

<h3 align="center">Proyecto de Gestión de Facturas</h3>

<div align="center">

[![Platform](https://img.shields.io/badge/platform-web-blue.svg)]()
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)
[![PHP](https://img.shields.io/badge/php-^7.4-blue.svg)]()
[![MySQL](https://img.shields.io/badge/mysql-^5.7-blue.svg)]()
[![jQuery](https://img.shields.io/badge/jquery-^3.5.1-blue.svg)]()
[![DataTables](https://img.shields.io/badge/datatables-^1.10.21-blue.svg)]()

</div>

---

<p align="center"> 📄 Aplicación web para la gestión de facturas, desarrollada utilizando PHP, MySQL, JavaScript, jQuery y DataTables.
    <br> 
</p>

## 📝 Table of Contents

- [About](#about)
- [Solution](#solution)
- [Advantages](#advantages)
- [Disadvantages](#disadvantages)
- [Motivations for the Tools Chosen](#motivations)
- [Usage](#usage)
- [Getting Started](#getting_started)
- [Code Examples](#code_examples)

## 🧐 About <a name = "about"></a>

Este proyecto es una aplicación web para la gestión de facturas, desarrollada en el Backend utilizando PHP, MySQL, JavaScript, jQuery y DataTables, en la parte del Frontend usa AdminLTE como template para el dashboard. La aplicación permite agregar, editar y listar facturas, así como gestionar productos y personas asociados a cada factura.

## 💡 Solution <a name = "solution"></a>

### Funcionalidades Implementadas

1. **Agregar Facturas**: Permite agregar nuevas facturas con detalles de productos.
2. **Listar Facturas**: Muestra una lista de facturas en una tabla interactiva utilizando DataTables.
3. **Agregar Productos**: Permite agregar nuevos productos.
4. **Listar Productos**: Muestra una lista de productos en una tabla interactiva utilizando DataTables.
5. **Modificar Productos**: Permite modificar los valores de los productos.
6. **Cantidad Facturada**: Permite visualizar en una tabla interactiva con los productos según su cantidad facturada en orden descendente.
7. **Utilidad Generada**: Permite visualizar en una tabla interactiva con los productos según su utilidad generados por facturación.
8. **Margen de Ganancia**: Permite visualizar en una tabla interactiva con los productos y el margen de ganancia de cada uno según su facturación.
9. **Agregar Persona**: Permite agregar nuevos clientes.
10. **Listar Personas**: Muestra una lista de personas en una tabla interactiva utilizando DataTables.
11. **Modificar Personas**: Permite modificar datos de los clientes.
12. **Total Facturado**: Permite visualizar en una tabla interactiva cada persona con el total facturado, de cada una, si no tiene facturas, debe obtener la persona y facturado = 0.
13. **Producto Mas Caro**: Permite visualizar en una tabla interactiva con la Persona que haya comprado el producto más caro.

## ✅ Advantages <a name = "advantages"></a>

- **Interactividad**: La integración con DataTables proporciona una interfaz de usuario interactiva y fácil de usar.
- **Modularidad**: El código está organizado en funciones modulares, lo que facilita el mantenimiento y la escalabilidad.
- **Uso de AJAX**: Las operaciones de CRUD se realizan de manera asíncrona, mejorando la experiencia del usuario al evitar recargas completas de la página.

## ❌ Disadvantages <a name = "disadvantages"></a>

- **Complejidad Inicial**: La configuración inicial puede ser compleja para desarrolladores novatos debido a la integración de múltiples tecnologías.
- **Dependencia de Librerías**: La aplicación depende de varias librerías externas (jQuery, DataTables), lo que puede aumentar el tamaño del proyecto y la complejidad de la gestión de dependencias.

## 💭 Motivations for the Tools Chosen <a name = "motivations"></a>

- **PHP y MySQL**: Elegidos por su robustez y amplia adopción en el desarrollo web backend.
- **JavaScript y jQuery**: Utilizados para manipulación del DOM y manejo de eventos de manera eficiente.
- **DataTables**: Seleccionado por su capacidad para manejar grandes conjuntos de datos de manera interactiva y con funcionalidades avanzadas como búsqueda y paginación.
- **AdminLTE**:AdminLTE ha sido seleccionado debido a su interfaz moderna y responsiva, su amplia gama de componentes y plugins integrados, y su facilidad de personalización.

## 🎈 Usage <a name = "usage"></a>

Para utilizar la aplicación, sigue los pasos de instalación y luego accede a la interfaz web para gestionar tus facturas.

## 🏁 Getting Started <a name = "getting_started"></a>

Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas.

### Requisitos Previos

- Servidor web con soporte para PHP (por ejemplo, Wampserver)
- Base de datos MySQL
- Navegador web moderno

### Instalación

1. **Clonar el Repositorio**

   ```bash
   git clone https://github.com/Alej0-Pin3da/Magnetron.git
   cd Magnetron
   ```
2. **Configurar la base de datos**
- Crea una base de datos en MySQL llamada `facturacionDB`
- Importa el archivo database.sql ubicado en la carpeta sql del proyecto.
- Configurar en el archivo `config/global.php` con los datos de conexion a la base de datos

## 🛠️ Code Examples <a name = "code_examples"></a>
### Inicialización de DataTable
```JS
/**
 * Inicializa DataTable con las configuraciones necesarias
 *
 * @return {void}
 */
function listar() {
    // Inicializar DataTable
    tabla = $("#tblListado").DataTable({
    // Indica que los datos se van a procesar en segundo plano
    aProcessing: true,
    // La recuperación de datos se realiza en el lado del servidor.
    aServerSide: true,
    // Agregar botones para exportar datos y que botones se van a mostrar
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],

    // Configuración AJAX para recuperación de datos
    ajax: {
      url: "../ajax/factura.php?op=listar",
      type: "get",
      dataType: "json",
      error: function (e) {
        console.log(e.responseText);
      },
    },
    // Limpiar la tabla existente si existe
    bDestroy: true,
    // Número de registros a mostrar por página
    iDisplayLength: 5,
    // Ordena los datos en orden ascendente por la primera columna.
    order: [[0, "asc"]],
    // Configuración de idioma para mosrtar en español
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
}
```