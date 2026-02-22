
function cargarTablaDashboardOrdenes(data){

  var dtInvoiceTable = $('.datatableDasboardOrdenes'),
    invoicePreview = 'index.php?view=orden&id=',
    invoiceAdd = 'app-invoice-add.html',
    invoiceEdit = 'app-invoice-edit.html';

  // datatable
  if (dtInvoiceTable.length) {
     dtInvoiceTable.DataTable().destroy();
       var dtInvoice = dtInvoiceTable.DataTable({      
      data: data, // JSON file to add data
      autoWidth: false,
      columns: [
        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'codigo' },//2
        { data: 'fechaIngreso' },//3  
        { data: 'placa' },//4
        { data: 'cedula' },//5  
        { data: 'nombreCompleto' },//6
        { data: 'ubicacion' },//7 
        { data: 'personal' }, //8        
        { data: 'estatus' },//9  
        { data: '' },//10 
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          responsivePriority: 2,
          targets: 0
        },
        {
          // Invoice ID
          targets: 2,
          width: '46px',
          render: function (data, type, full, meta) {
            var invoiceId = full['codigo'];
             var id = full['id'];
            // Creates full output for row
            var $rowOutput = '<a class="fw-bold" href="' + invoicePreview +id +  '"> #' + invoiceId + '</a>';
            return $rowOutput;
          }
        },
          {
          // Label
          targets: 2,
          title: 'Código'
        },
          {
          // Label
          targets: 3,
          title: 'Fecha de ingreso'
        },
        
          {
          // Label
          targets: 4,
          visible: false
        },
          {
          // Label
          targets: 5,
          visible: false
        },
        {
          // Label
          targets: 9,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              1: { title: 'EN CURSO', class: 'badge-light-success' },
              2: { title: 'COMPLETADA', class: ' badge-light-danger' },
              0: { title: 'ELIMINADA', class: ' badge-light-info' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },
      
           {
          // Label
           targets: 7,
            title: 'Ubicación',
          render: function (data, type, full, meta) {
            var $status_number = full['ubicacion'];                 
           if($status_number=='0'){
            return (
              '<span class="badge rounded-pill badge-light-danger  ">No asignada</span>'
            );
           }else{
            return (
                '<a href="javascript:;" class="' + full['id'] + ' dropdown-item">' +
              '<span class="badge rounded-pill badge-light-success  ">'+$status_number+'</span></a>'
          
            );
           }
           
          }
        },

           {
           targets: 8,
            title: 'Personal a cargo ',
          render: function (data, type, full, meta) {
            var $status_number = full['personal'];                 
           if($status_number=='0'){
            return (
              '<span class="badge rounded-pill badge-light-danger  ">No asignado</span>'
            );
           }else{
            return (
               '<a href="javascript:;" class="' + full['id'] + ' dropdown-item">' +
              '<span class="badge rounded-pill badge-light-info  ">'+$status_number+'</span></a>'
            );
           }
           
          }
        },
        /*{
          // Invoice status
          targets: 9,
          width: '42px',
          render: function (data, type, full, meta) {
            var $invoiceStatus = full['estatus'],
              $dueDate = full['due_date'],
              $balance = full['balance'],
              roleObj = {
                Sent: { class: 'bg-light-secondary', icon: 'send' },
                Paid: { class: 'bg-light-success', icon: 'check-circle' },
                Draft: { class: 'bg-light-primary', icon: 'save' },
                Downloaded: { class: 'bg-light-info', icon: 'arrow-down-circle' },
                'Past Due': { class: 'bg-light-danger', icon: 'info' },
                'Partial Payment': { class: 'bg-light-warning', icon: 'pie-chart' }
              };
            return (
              "<span data-bs-toggle='tooltip' data-bs-html='true' title='<span>" +
              $invoiceStatus +
              '<br> <span class="fw-bold">Balance:</span> ' +
              $balance +
              '<br> <span class="fw-bold">Due Date:</span> ' +
              $dueDate +
              "</span>'>" +
              '<div class="avatar avatar-status ' +
              roleObj[$invoiceStatus].class +
              '">' +
              '<span class="avatar-content">' +
              feather.icons[roleObj[$invoiceStatus].icon].toSvg({ class: 'avatar-icon' }) +
              '</span>' +
              '</div>' +
              '</span>'
            );
          }
        },*/
       {
          // Client name and Service
          targets: 6,
          title: 'Propietario',
          responsivePriority: 4,
          width: '270px',
          render: function (data, type, full, meta) {
            var $name = full['nombreCompleto'],    
              $cedula = full['cedula'],        
              stateNum = Math.floor(Math.random() * 6),
              states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
              $state = states[stateNum],
              $name = full['nombreCompleto'],
              $initials = $name.match(/\b\w/g) || [];
            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
       
              var $output = '<div class="avatar-content">' + $initials + '</div>';
            
            // Creates full output for row
            var colorClass = ' bg-light-' + $state + ' ';

            var $rowOutput =
              '<div class="d-flex justify-content-left align-items-center">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar' +
              colorClass +
              'me-50">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<h6 class="user-name text-truncate mb-0">' +
              $name +
              '</h6>' +   
               '<small class="text-truncate text-muted">' +
              $cedula +
              '</small>' +          
              '</div>' +
              '</div>';
            return $rowOutput;
          }
        },
       /* {
          // Total Invoice Amount
          targets: 4,
          width: '73px',
          render: function (data, type, full, meta) {
            var $total = full['total'];
            return '<span class="d-none">' + $total + '</span>$' + $total;
          }
        },*/
       /* {
          // Due Date
          targets: 5,
          width: '130px',
          render: function (data, type, full, meta) {
            var $dueDate = new Date(full['due_date']);
            // Creates full output for row
            var $rowOutput =
              '<span class="d-none">' +
              moment($dueDate).format('YYYYMMDD') +
              '</span>' +
              moment($dueDate).format('DD MMM YYYY');
            $dueDate;
            return $rowOutput;
          }
        },*/
       /* {
          // Client Balance/Status
          targets: 6,
          width: '98px',
          render: function (data, type, full, meta) {
            var $balance = full['balance'];
            if ($balance === 0) {
              var $badge_class = 'badge-light-success';
              return '<span class="badge rounded-pill ' + $badge_class + '" text-capitalized> Paid </span>';
            } else {
              return '<span class="d-none">' + $balance + '</span>' + $balance;
            }
          }
        },*/
        /*{
          targets: 7,
          visible: false
        },*/
        {
          // Actions
          targets: -1,
          title: 'Actions',
          width: '80px',
          orderable: false,
          render: function (data, type, full, meta) {
              var invoiceId = full['codigo'];
             var id = full['id'];
            return (
              '<div class="d-flex align-items-center col-actions">' +
              '<a class="me-1" href="' + invoicePreview +id + '" data-bs-toggle="tooltip" data-bs-placement="top" title="Enviar a cliente">' +
              feather.icons['send'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +
              '<a class="me-25"  href="' + invoicePreview +id + '" data-bs-toggle="tooltip" data-bs-placement="top" title=Ver orden">' +
              feather.icons['eye'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +           
              '</div>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +
        '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
        '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Buscar',
        searchPlaceholder: 'Codigo de orden',
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: 'Agregar',
          className: 'btn btn-primary btn-add-record ms-2',
          action: function (e, dt, button, config) {
            window.location = "index.php?view=ingreso&id=0";
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de la ordens' + data['codigo'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.columnIndex !== 2 // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIdx +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');
            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      initComplete: function () {
        $(document).find('[data-bs-toggle="tooltip"]').tooltip();
        // Adding role filter once table initialized
        this.api()
          .columns(7)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserRole" class="form-select ms-50 text-capitalize"><option value=""> Seleccione estatus </option></select>'
            )
              .appendTo('.invoice_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
              });
          });
      },
      drawCallback: function () {
        $(document).find('[data-bs-toggle="tooltip"]').tooltip();
      }
    });
  }



}
function cargarTablaClientes(data) {
  var datatablesClientes = $('.datatablesClientes');

  if (datatablesClientes.length) {
    datatablesClientes.DataTable().destroy();
    var dt_basic = datatablesClientes.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'cedula' },//2
        { data: 'nombreCompleto' },//3  
        { data: 'genero' },//4
        { data: 'telefono' },//5
        { data: 'correo' },//6
        { data: '' }     // 7

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Cédula'
        },
        {
          targets: 3,
          title: 'Apellidos y Nombres'
        },

        {
          // Label
          targets: 4,
          title: 'Genero',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['genero'];
            var $estatus = {
              1: { title: 'Femenino', class: 'badge-light-danger' },
              2: { title: 'Masculino', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },

        {
          targets: 5,
          title: 'Telefonos'
        },
        {
          targets: 6,
          title: 'Correo'
        },     

        {
          responsivePriority: 1,
          targets: 3
        },
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a href="index.php?view=cliente&id=' + full['id'] + '"   class="pe-1 dropdown-toggle hide-arrow text-primary" >' +
              feather.icons['eye'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '</div>'
            );
          }
        },


        {

        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2,3,5,6] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2,3,5,6] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
               exportOptions: { columns: [2,3,5,6] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '.modalAddCliente'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles del cliente';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



  }

}


function cargarTablaUsers() {
  var dt_basic_table_users = $('.datatables-basic-users');

  assetPath = '../app-assets/';
  if (dt_basic_table_users.length) {
    //cargarDataBancos();
    let dataBancos = $('.dataUsers').val();
    //console.log(dataBancos);
    let arrayBancos = "";
    arrayBancos = JSON.parse(dataBancos);
    var dt_basic = dt_basic_table_users.DataTable({
      data: arrayBancos,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },    //1
        { data: 'id' },//2
        { data: 'nombre' },//3
        { data: 'nombreUsuario' },//4
        { data: 'userLevel' }, // 5
        { data: 'ultimoLogin' },//6
        { data: 'created' },//7
        { data: 'image' },  //8
        { data: 'password' }, //9 
        { data: 'idReferido' },  //10  
        { data: 'confirmacion' },  //11  
        { data: 'estatus' },     //12 
        { data: '' }     //13 

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 2,
          visible: false
        },
        {
          targets: 1,
          visible: false
        },
        {
          targets: 4,
          visible: false
        },

        {
          targets: 7,
          visible: false
        },
        {
          targets: 8,
          visible: false
        },
        {
          targets: 9,
          visible: false
        },
        {
          targets: 10,
          visible: false
        },
        {
          targets: 11,
          visible: false
        },




        {
          responsivePriority: 1,
          targets: 3
        },
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a  href="javascript:datosUsuario(\'' + full['id'] + '\');" class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +

              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Borrar</a>' +
              '</div>' +
              '</div>'
            );
          }
        },
        {
          // Label
          targets: 5,
          render: function (data, type, full, meta) {
            var $status_number = full['userLevel'];
            var $status = {
              1: { title: 'Administrador', class: 'badge-light-success' },
              2: { title: 'Tecnico', class: ' badge-light-danger' },
              3: { title: 'Secretaria', class: 'badge-light-info' }


            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        {
          // Label
          targets: 10,
          render: function (data, type, full, meta) {
            var $status_number = full['idReferido'];
            var $status = {
              1: { title: 'SIGETRA', class: 'badge-light-success' }


            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },
        {
          // Label
          targets: 12,
          render: function (data, type, full, meta) {
            var $status_number = full['estatus'];
            var $status = {
              1: { title: 'Activo', class: 'badge-light-success' },
              0: { title: 'Inactivo', class: ' badge-light-danger' }

            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        },

        {

        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [4, 5, 6, 12] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [4, 5, 6, 12] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [4, 5, 6, 12] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modals-slide-in'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles del Usuario';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



    $('.data-submit').on('click', function () {
      var $nombre = $('.add-new-record .nombre').val().toUpperCase(),
        $nombreUsuario = $('.add-new-record .nombreUsuario').val().toUpperCase(),
        $confirmContrasena = $('.add-new-record .confirmContrasena').val(),
        $userLevel = $('.add-new-record .userLevel').val(),
        $idReferido = $('.add-new-record .sucursal').val(),
        $sucursal = $('.sucursal option:selected').html(),
        $contrasena = $('.add-new-record .contrasena').val()
      // //console.log(sucursal);
      /*
              let cuenta = ($('.add-new-record .banco').val()).length;
              let $banco=0;
              if(cuenta >=6){
                $banco = $bancoData.substring(0, 2);
              }else{
                $banco = $bancoData.substring(0, 1);
              }
              let $codigo = $bancoData.substring(1, 5)
              */
      // //console.log($codigo);
      if (($nombreUsuario != '') && ($nombre != '') && ($confirmContrasena != '') && ($contrasena != '')) {

        if ($contrasena == $confirmContrasena) {
          //console.log('Guardare');
          var tipo = 1;
          var accion = 1;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=user',
            type: 'POST',
            data: { nombre: $nombre, nombreUsuario: $nombreUsuario, idReferido: $idReferido, confirmContrasena: $confirmContrasena, userLevel: $userLevel, tipo: tipo, accion: accion, datos: datos },
            success: function (response) {
              var i = 0;
              var tope = response.length;
              if (tope == 1) {
                for (var i = 0; i < tope; i++) {

                  dt_basic.row
                    .add({

                      responsive_id: 0,
                      id: response[i].id,
                      id: response[i].id,
                      nombre: response[i].nombre,
                      nombreUsuario: response[i].nombreUsuario,
                      userLevel: response[i].userLevel,
                      ultimoLogin: response[i].ultimoLogin,

                      created: response[i].created,
                      image: response[i].image,
                      password: response[i].password,
                      idReferido: response[i].idReferido,
                      confirmacion: 1,
                      estatus: 1

                    })
                    .draw();




                  $('.add-new-record .nombre').val('');
                  $('.add-new-record .nombreUsuario').val('');
                  $('.add-new-record .contrasena').val('');
                  $('.add-new-record .confirmContrasena').val('');

                  //count++;
                  $('.modal').modal('hide');
                }
              }
              if (tope == 2) {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'El nombre de usuario que esta intentando registrar, ya esta asociado a otro registro!'

                })
                // //console.log(response)

              }

            }
          });
        } else {

          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Las contraseñas deben ser iguales'

          })
        }



      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

        })
      }
    });


    // Delete Record
    $('.datatables-basic-users tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que eliminará definitivamente al usuario.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          borrarUser(id);
          dt_basic.row($(this).parents('tr')).remove().draw();

        }
      })



    });
    $('div.head-label').html('<h6 class="mb-0">Usuarios registrados</h6>');
  }

}

function cargarTablaCargos(data) {
  var datatablesCargos = $('.datatablesCargos');
  if (datatablesCargos.length) {
    datatablesCargos.DataTable().destroy();
    var dt_basic = datatablesCargos.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },    //1 
        { data: 'cargo' },//2
        { data: 'estatus' },//3
        { data: '' }     //4

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Cargo'
        },
        {
          // Label
          targets: 3,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              0: { title: 'Desactivado', class: 'badge-light-danger' },
              1: { title: 'Activo', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },


        {
          responsivePriority: 1,
          targets: 3
        },

        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          width: '30px',
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:editarCargo(\'' + full['id'] + '\');"  class="dropdown-item edit-record">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Editar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Borrar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item activar-record">' +
              feather.icons['power'].toSvg({ class: 'font-small-4 me-50' }) +
              'Activar</a>' +
              '</div>' +
              '</div>'
            );
          }
        }


      ],
      order: [[1, 'asc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },

            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            }

          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modalAddCargo'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');

          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles CARGO';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



    // Delete Record
    $('.datatablesCargos tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=cargos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Cargo desactivado con éxito.'
                }),
                  cargarDataCargos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesCargos tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activarà para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=cargos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Cargo Activado con éxito.'
                }),
                  cargarDataCargos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });

    // $('div.head-label').html('<h6 class="mb-0">Entidades bancarias registradas</h6>');
  }

}
function cargarTablaTipos(data) {
  var datatablesTipos = $('.datatablesTipos');
  if (datatablesTipos.length) {
    datatablesTipos.DataTable().destroy();
    var dt_basic = datatablesTipos.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },    //1 
        { data: 'tipo' },//2
        { data: 'condicion' },//3
        { data: 'estatus' },//4
        { data: '' }     //5

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Tipo'
        },

        {
          // Label
          targets: 3,
          title: 'INVENTARIO | EQUIPO',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['condicion'];
            var $estatus = {
              1: { title: 'INVENTARIO', class: 'badge-light-danger' },
              2: { title: 'EQUIPO', class: ' badge-light-success' }

            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },
        {
          // Label
          targets: 4,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              0: { title: 'Desactivado', class: 'badge-light-danger' },
              1: { title: 'Activo', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },


        {
          responsivePriority: 1,
          targets: 3
        },

        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          width: '30px',
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:editarTipo(\'' + full['id'] + '\');"  class="dropdown-item edit-record">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Editar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Inhabilitar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item activar-record">' +
              feather.icons['power'].toSvg({ class: 'font-small-4 me-50' }) +
              'Activar</a>' +
              '</div>' +
              '</div>'
            );
          }
        }


      ],
      order: [[1, 'asc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },

            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            }

          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modalAddTipo'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');

          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles Tipo';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



    // Delete Record
    $('.datatablesTipos tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=tipos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Tipo desactivado con éxito.'
                }),
                  cargarDataTipos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesTipos tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activarà para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=tipos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Tipo Activado con éxito.'
                }),
                  cargarDataTipos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });

    // $('div.head-label').html('<h6 class="mb-0">Entidades bancarias registradas</h6>');
  }

}
function cargarTablaMarcas(data) {
  var datatablesMarcas = $('.datatablesMarcas');
  if (datatablesMarcas.length) {
    datatablesMarcas.DataTable().destroy();
    var dt_basic = datatablesMarcas.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },    //1 
        { data: 'tipo' },//2
        { data: 'marca' },//3
        { data: 'condicion' },//4
        { data: 'estatus' },//5
        { data: '' }     //6

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'TIPO'
        },
        {
          targets: 3,
          title: 'Marca'
        },
        {
          // Label
          targets: 4,
          title: 'INVENTARIO | EQUIPO',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['condicion'];
            var $estatus = {
              1: { title: 'INVENTARIO', class: 'badge-light-danger' },
              2: { title: 'EQUIPO', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },
        {
          // Label
          targets: 5,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              0: { title: 'Desactivado', class: 'badge-light-danger' },
              1: { title: 'Activo', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },


        {
          responsivePriority: 1,
          targets: 3
        },

        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          width: '30px',
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:editarMarca(\'' + full['id'] + '\');"  class="dropdown-item edit-record">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Editar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Borrar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item activar-record">' +
              feather.icons['power'].toSvg({ class: 'font-small-4 me-50' }) +
              'Activar</a>' +
              '</div>' +
              '</div>'
            );
          }
        }


      ],
      order: [[1, 'asc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },

            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            }

          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modalAddMarca'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');

          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles MARCA';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });


    // Delete Record
    $('.datatablesMarcas tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=marcas',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == '1') {
                Swal.fire({
                  icon: 'success',
                  text: 'Marca desactivada con éxito.'
                }),
                  cargarDataMarcas('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesMarcas tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activarà para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=marcas',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Marca Activada con éxito.'
                }),
                  cargarDataMarcas('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });

    // $('div.head-label').html('<h6 class="mb-0">Entidades bancarias registradas</h6>');
  }

}

function cargarTablaModelos(data) {
  var datatablesModelos = $('.datatablesModelos');
  if (datatablesModelos.length) {
    datatablesModelos.DataTable().destroy();
    var dt_basic = datatablesModelos.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },    //1 
        { data: 'marca' },//2
        { data: 'modelo' },//3

        { data: 'estatus' },//4
        { data: '' }     //5

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'MArca'
        },
        {
          targets: 3,
          title: 'Modelo'
        },

        {
          // Label
          targets: 4,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              0: { title: 'Desactivado', class: 'badge-light-danger' },
              1: { title: 'Activo', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },


        {
          responsivePriority: 1,
          targets: 3
        },

        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          width: '30px',
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:editarModelo(\'' + full['id'] + '\');"  class="dropdown-item edit-record">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Editar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Borrar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item activar-record">' +
              feather.icons['power'].toSvg({ class: 'font-small-4 me-50' }) +
              'Activar</a>' +
              '</div>' +
              '</div>'
            );
          }
        }


      ],
      order: [[1, 'asc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4] }
            },

            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4] }
            }

          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modalAddModelo'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');

          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles MODELO';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });


    // Delete Record
    $('.datatablesModelos tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=modelos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == '1') {
                Swal.fire({
                  icon: 'success',
                  text: 'Modelo Activado con éxito.'
                }),
                  cargarDataModelos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesModelos tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activarà para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=modelos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Modelo Activado con éxito.'
                }),
                  cargarDataModelos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });

    // $('div.head-label').html('<h6 class="mb-0">Entidades bancarias registradas</h6>');
  }

}
function cargarTablaUbicaciones(data) {
  var datatablesUbicaciones = $('.datatablesUbicaciones');
  if (datatablesUbicaciones.length) {
    datatablesUbicaciones.DataTable().destroy();
    var dt_basic = datatablesUbicaciones.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },    //1 
        { data: 'ubicacion' },//2
        { data: 'estatus' },//3
        { data: '' }     //4

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },
        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Ubicación'
        },
        {
          // Label
          targets: 3,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              0: { title: 'Desactivado', class: 'badge-light-danger' },
              1: { title: 'Activo', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },


        {
          responsivePriority: 1,
          targets: 3
        },

        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          width: '30px',
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:editarUbicacion(\'' + full['id'] + '\');"  class="dropdown-item edit-record">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Editar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Borrar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item activar-record">' +
              feather.icons['power'].toSvg({ class: 'font-small-4 me-50' }) +
              'Activar</a>' +
              '</div>' +
              '</div>'
            );
          }
        }


      ],
      order: [[1, 'asc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },

            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3] }
            }

          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#modalAddUbicacion'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');

          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles Ubicaciones';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



    // Delete Record
    $('.datatablesUbicaciones tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=ubicaciones',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Ubicación desactivada con éxito.'
                }),
                  cargarDataUbicaciones('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesUbicaciones tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activará para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=ubicaciones',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Ubicación Activado con éxito.'
                }),
                  cargarDataUbicaciones('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });

    // $('div.head-label').html('<h6 class="mb-0">Entidades bancarias registradas</h6>');
  }

}
function cargarTablaPersonal(data) {
  var datatablesPersonal = $('.datatablesPersonal');

  if (datatablesPersonal.length) {
    datatablesPersonal.DataTable().destroy();
    var dt_basic = datatablesPersonal.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'cedula' },//2
        { data: 'nombreCompleto' },//3  
        { data: 'genero' },//4
        { data: 'telefono' },//5
        { data: 'correo' },//6  
        { data: 'cargo' },//7 
        { data: '' }     // 8

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Cédula'
        },
        {
          targets: 3,
          title: 'Apellidos y Nombres'
        },

        {
          // Label
          targets: 4,
          title: 'Genero',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['genero'];
            var $estatus = {
              1: { title: 'Femenino', class: 'badge-light-danger' },
              2: { title: 'Masculino', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },

        {
          targets: 5,
          title: 'Telefonos'
        },
        {
          targets: 6,
          title: 'Correo'
        },
        {
          targets: 7,
          title: 'Cargo'
        },

        {
          responsivePriority: 1,
          targets: 3
        },
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a href="index.php?view=persona&id=' + full['id'] + '"   class="pe-1 dropdown-toggle hide-arrow text-primary" >' +
              feather.icons['eye'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '</div>'
            );
          }
        },


        {

        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2,3,5,6,7] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
               exportOptions: { columns: [2,3,5,6,7] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
               exportOptions: { columns: [2,3,5,6,7] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '.modalAddPersonal'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles del Personal';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



  }

}
function cargarTablaArticulos(data) {
  var datatablesArticulos = $('.datatablesArticulos');

  if (datatablesArticulos.length) {
    datatablesArticulos.DataTable().destroy();
    var dt_basic = datatablesArticulos.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'nombre' },//2
        { data: 'cantidad' },//3        
        { data: 'condicion' },//4
        { data: 'modelo' },//5
        { data: 'marca' },//6
        { data: 'tipo' },//7
        { data: 'estatus' },//8
        { data: '' }     // 9

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'nombre'
        },

        {
          targets: 4,
          title: 'condicion',
          visible: false
        },


        {
          targets: 5,
          title: 'modelo',
          visible: false

        },
        {
          targets: 6,
          title: 'marca',
          visible: false
        },
        {
          targets: 7,
          title: 'tipo'
        },
        {
          // Label
          targets: 8,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              0: { title: 'Desactivado', class: 'badge-light-danger' },
              1: { title: 'Activo', class: ' badge-light-success' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },

        {
          title: 'Cantidad',
          targets: 3,
          render: function (data, type, full, meta) {
            var $status_number = full['cantidad'];
            if ($status_number == '0') {
              return (
                '<span class="badge rounded-pill badge-light-danger ">SIN EXISTENCIA</span>'
              );
            } else {
              return (
                '<span class="badge rounded-pill badge-light-info ">' + $status_number + '</span>'
              );
            }

          }
        },
        {
          responsivePriority: 1,
          targets: 3
        },
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="javascript:editarArticulo(\'' + full['id'] + '\');"  class="dropdown-item edit-record">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Editar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item delete-record">' +
              feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
              'Borrar</a>' +
              '<a href="javascript:;" class="' + full['id'] + ' dropdown-item activar-record">' +
              feather.icons['power'].toSvg({ class: 'font-small-4 me-50' }) +
              'Activar</a>' +
              '</div>' +
              '</div>'
            );
          }
        },


        {

        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 6, 7] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 6, 7] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 6, 7] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '.modalAddArticulo'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles del Artículo';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });


    // Delete Record
    $('.datatablesArticulos tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == '1') {
                Swal.fire({
                  icon: 'success',
                  text: 'Actículo Desactivado con éxito.'
                }),
                  cargarDataArticulos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesArticulos tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activarà para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Actículo Activado con éxito.'
                }),
                  cargarDataArticulos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });
  }

}
function cargarTablaArticulosEntradas(data) {
  var datatablesArticulosEntradas = $('.datatablesArticulosEntradas');

  if (datatablesArticulosEntradas.length) {
    datatablesArticulosEntradas.DataTable().destroy();
    var dt_basic = datatablesArticulosEntradas.DataTable({
      data: data,
      columns: [




        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'codigoEntrada' },//2
        { data: 'fechaEmision' },//3        
        { data: 'fechaRecepcion' },//4
        { data: 'estatus' },//5      

        { data: '' }     // 6

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'codigo entrada'
        },

        {
          targets: 3,
          title: 'fecha de emisión'
        },


        {
          targets: 4,
          title: 'fecha de recepción'

        },
        {
          targets: 5,
          title: 'Estatus',
          visible: false
        },


        {
          responsivePriority: 1,
          targets: 3
        },
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="index.php?view=rptEntrada&id=' + full['id'] + '"  class="dropdown-item">' +
              feather.icons['eye'].toSvg({ class: 'font-small-4 me-50' }) +
              'Ver</a>' +             
              '</div>' +
              '</div>'
            );
          }
        },


        {

        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de la Entrada';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });


    // Delete Record
    $('.datatablesArticulos tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == '1') {
                Swal.fire({
                  icon: 'success',
                  text: 'Actículo Desactivado con éxito.'
                }),
                  cargarDataModelos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesArticulos tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activarà para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Actículo Activado con éxito.'
                }),
                  cargarDataModelos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });
  }

}
function cargarTablaArticulosSalidas(data) {
  var datatablesArticulosSalidas = $('.datatablesArticulosSalidas');

  if (datatablesArticulosSalidas.length) {
    datatablesArticulosSalidas.DataTable().destroy();
    var dt_basic = datatablesArticulosSalidas.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'codigoSalida' },//2
        { data: 'redi' },//3   
        { data: 'zodi' },//4  
        { data: 'brigada' },//5  
        { data: 'unidad' },//6  
        { data: 'dependencia' },//7   
        { data: 'fechaEmision' },//8 
        { data: 'estatus' },//9         
        { data: '' }     // 10

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Codigo salida'
        },

        {
          targets: 3,
          title: 'Redi',
          visible: false
        },
        {
          targets: 4,
          title: 'zodi',
          visible: false

        },
        {
          targets: 5,
          title: 'brigada',
          visible: false

        },
        {
          targets: 6,
          title: 'unidad'

        },
        {
          targets: 7,
          title: 'dependencia'

        },
        {
          targets: 8,
          title: 'fecha Emision'

        },

        {
          // Label
          targets: 9,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              1: { title: 'Realizada', class: 'badge-light-success' },
              2: { title: 'Devuelta', class: ' badge-light-warning' },
              0: { title: 'Inactiva', class: ' badge-light-danger' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },


        {
          responsivePriority: 1,
          targets: 3
        },
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="index.php?view=rptSalida&id=' + full['id'] + '"  class="dropdown-item">' +
              feather.icons['eye'].toSvg({ class: 'font-small-4 me-50' }) +
              'Ver</a>' +
             
              '</div>' +
              '</div>'
            );
          }
        },


        {

        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 7] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 7] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 7] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }

      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de la Salida';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });


    // Delete Record
    $('.datatablesArticulos tbody').on('click', '.delete-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Eliminar?',
        text: "Tenga en cuenta que solo deshabitará  para efectos de registo, no sera una eliminacion completa",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 4;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == '1') {
                Swal.fire({
                  icon: 'success',
                  text: 'Actículo Desactivado con éxito.'
                }),
                  cargarDataModelos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al desactivar.'
                })
              }

            }
          });


        }
      })



    });
    // Delete Record
    $('.datatablesArticulos tbody').on('click', '.activar-record', function (e) {
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Activar?',
        text: "Tenga en cuenta que Activarà para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 5;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Actículo Activado con éxito.'
                }),
                  cargarDataModelos('NO');
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Activar.'
                })
              }

            }
          });


        }
      })



    });
  }

}
function cargarTablaItems(data) {
  var datatablesVehiculos = $('.datatablesVehiculos');

  if (datatablesVehiculos.length) {
    datatablesVehiculos.DataTable().destroy();
    var dt_basic = datatablesVehiculos.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'placa' },//2
        { data: 'cliente' },//3    
        { data: 'tipo' },//4 
        { data: 'marca' },//5 
        { data: 'modelo' },//6
        { data: 'condicion' },//7             
        { data: '' }     // 8

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Código'
        },
        {
          targets: 3,
          title: 'Propietario'
        },
          {
          targets: 4,
          title: 'Tipo de Equipo'
        },
        {
          targets: 5,
          title: 'Marca'
        },
        {
          targets: 6,
          title: 'Modelo'
        },

       

        {
          // Label
          targets: 7,
          title: 'Condicion',
          width: '30px',
          render: function (data, type, full, meta) {
            //	1-DISPONIBLE 2-EN MANTENIMIENTO 3-EN DESCARTE 4-DE COMISIÓN
            var $opcion_estado = full['condicion'];
            var $estatus = {
              1: { title: 'EN FUNCIONAMIENTO', class: 'badge-light-success' },
              2: { title: 'EN MANTENIMIENTO', class: ' badge-light-warning' },
              3: { title: 'EN DESCARTE', class: ' badge-light-danger' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },
        {
          responsivePriority: 1,
          targets: 3
        },
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-flex">' +
              '<a href="index.php?view=item&id=' + full['id'] + '"   class="pe-1 dropdown-toggle hide-arrow text-primary" >' +
              feather.icons['eye'].toSvg({ class: 'font-small-8' }) +
              '</a>' +
                '<a href="index.php?view=ingreso&id=' + full['id'] + '"   class="pe-1 dropdown-toggle hide-arrow text-primary" >' +
              feather.icons['chevrons-right'].toSvg({ class: 'font-small-8' }) +
              '</a>' +

              '</div>'
            );
          }
        },


        {

        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4, 5,6] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
             exportOptions: { columns: [2, 3, 4, 5,6] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
             exportOptions: { columns: [2, 3, 4, 5,6] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar nuevo',
          className: 'create-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '.modalAddVehiculo'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles del Vehiculo';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



  }

}
function cargarTablaAsignaciones(data) {
  var datatablesAsignaciones = $('.datatablesAsignaciones');

  if (datatablesAsignaciones.length) {
    datatablesAsignaciones.DataTable().destroy();
    var dt_basic = datatablesAsignaciones.DataTable({
      data: data,
      columns: [

        { data: 'responsive_id' },//0
        { data: 'idAsignacion' },   //1    
        { data: 'placa' },//2
        { data: 'redi' },//3  
        { data: 'zodi' },//4
        { data: 'brigada' },//5  
        { data: 'unidad' },//6
        { data: 'dependencia' },//7 
        { data: 'fechaAsignacion' },//8                   
        { data: 'fechaDevolucion' },//9   
        { data: 'estatus' },//10   

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Placa'
        },
        {
          targets: 3,
          title: 'REdi'
        },
        {
          targets: 4,
          title: 'ZODI'
        },
        {
          targets: 5,
          title: 'BRIGADA'
        },

        {
          targets: 6,
          title: 'UNIDAD'
        },
        {
          targets: 7,
          title: 'DEPENDENCIA'
        },
        {
          targets: 8,
          title: 'FECHA DE ASIGNACION'
        },
        {
          targets: 9,
          title: 'FECHA DE DEVOLUCION'
        },
        {
          responsivePriority: 1,
          targets: 3
        },

        {
          // Label
          targets: 10,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              1: { title: 'ACTIVA', class: 'badge-light-success' },
              2: { title: 'CANCELADA', class: ' badge-light-danger' },
              0: { title: 'ELIMINADA', class: ' badge-light-info' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },
        {

        }
      ],
      order: [[1, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [4, 5, 6, 12] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [4, 5, 6, 12] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [4, 5, 6, 12] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de la asignación';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });



  }

}
function cargarTablaOrdenes(data) {
  var datatablesOrdenes = $('.datatablesOrdenes')
    invoicePreview = 'index.php?view=orden&id=';
  if (datatablesOrdenes.length) {
    datatablesOrdenes.DataTable().destroy();
    var dt_basic = datatablesOrdenes.DataTable({
      data: data,
      columns: [


        { data: 'responsive_id' },//0
        { data: 'codigo' },   //1    
        { data: 'idItem' },//2
        { data: 'idPersonal' },//3  
        { data: 'idUbicacion' },//4
        { data: 'fechaIngreso' },//5
        { data: 'fechaSalida' },//6     
        { data: 'estatus' },//7 
        { data: 'condicion' },//8       
        { data: 'idOrden' },//9      
        { data: '' },//10
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          title: 'Codigo orden'
        },
        {
          targets: 2,
          visible: false
        
        },
        {
          targets: 3,
         visible: false
        },
        {
          targets: 4,
         visible: false
        },
        {
          targets: 5,
          title: 'Fecha de ingreso'
        },
        {
          targets: 6,
          title: 'Fecha de salida'
        },
       {
          targets: 9,
          visible: false
        },

        {
          responsivePriority: 1,
          targets: 3
        },

        {
          // Label
          targets: 7,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              1: { title: 'EN CURSO', class: 'badge-light-warning' },
              2: { title: 'COMPLETADA', class: ' badge-light-success' },
              0: { title: 'ELIMINADA', class: ' badge-light-danger' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },
        {
          // Label
          targets: 8,
          title: 'Condicion',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['condicion'];
            var $estatus = {
              1: { title: 'EN ESPERA DE ASIGNACION', class: 'badge-light-danger' },
              2: { title: 'COMPLETADA', class: ' badge-light-info' },
              3: { title: 'EN PROCESO', class: ' badge-light-warning' },
              4: { title: 'A DESTIEMPO', class: ' badge-light-danger' }


            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },
       
        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          width: '30px',
          render: function (data, type, full, meta) {
          var invoiceId = full['codigo'];
             var id = full['idOrden'];
            return (
              '<div class="d-flex align-items-center col-actions">' +
              '<a class="me-1" href="' + invoicePreview +id + '" data-bs-toggle="tooltip" data-bs-placement="top" title="Enviar a cliente">' +
              feather.icons['send'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +
              '<a class="me-25"  href="' + invoicePreview +id + '" data-bs-toggle="tooltip" data-bs-placement="top" title=Ver orden">' +
              feather.icons['eye'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +           
              '</div>'
            );
           
          }
        },
        {
          /*  '<a href="index.php?view=rptOrden&id=' + full['idOrden'] + '"  class="dropdown-item">' +
              feather.icons['eye'].toSvg({ class: 'font-small-4 me-50' }) +
              'Ver</a>' +*/
        }
      ],
      order: [[1, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2,5,7,8,9] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2,5,7,8,9] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2,5,7,8,9] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de la Orden';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });

    $('.datatablesOrdenes tbody').on('click', '.activar-record', function (e) {

      let idOrden = e.target.classList[0];
    
      var res = idOrden.split("*");
      //console.log(res);
      let idVehiculo =res[0];

     /* console.log(e.target.classList);
      console.log(idOrden);
      console.log(idVehiculo);*/
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas cerrar la orden?',
        text: "Tenga en cuenta que Cerrará la orden, indicando que el vehiculo ha regresado, esta acción sera tomada en cuenta para futuros reportes",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 8;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=vehiculos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, idOrden: idOrden, idVehiculo: idVehiculo },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Orden  cerrada con éxito.'
                }),
                  cargarDataOrdenes(0, 0);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al cerrar.'
                })
              }

            }
          });


        }
      })



    });

  }

}
function cargarTablaOrdenesTrabajos(data) {
  var datatablesOrdenesTrabajo = $('.datatablesOrdenesTrabajo');

  if (datatablesOrdenesTrabajo.length) {
    datatablesOrdenesTrabajo.DataTable().destroy();
    var dt_basic = datatablesOrdenesTrabajo.DataTable({
      data: data,
      columns: [
       
        { data: 'responsive_id' },//0
        { data: 'id' },   //1    
        { data: 'codigo' },//2
        { data: 'fechaIngreso' },//3  
        { data: 'placa' },//4
        { data: 'cedula' },//5  
        { data: 'nombreCompleto' },//6
        { data: 'ubicacion' },//7 
        { data: 'personal' }, //8        
        { data: 'estatus' },//9  
        { data: '' },//10 

      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          responsivePriority: 2,
          targets: 0
        },

        {
          targets: 1,
          visible: false
        },
        {
          targets: 2,
          title: 'Código'
        },
        {
          targets: 3,
          title: 'Fecha de ingreso'
        },
        {
          targets: 4,
          title: 'Codigo item'
        },
        {
          targets: 5,
          title: 'Documento cliente'
        },
 {
          targets: 6,
          title: 'Nombre completo'
        },


      

        {
          responsivePriority: 1,
          targets: 3
        },
       {
          // Label
           targets: 7,
            title: 'Ubicación',
          render: function (data, type, full, meta) {
            var $status_number = full['ubicacion'];                 
           if($status_number=='0'){
            return (
              '<span class="badge rounded-pill badge-light-danger  ">No asignada</span>'
            );
           }else{
            return (
                '<a href="javascript:;" class="' + full['id'] + ' dropdown-item">' +
              '<span class="badge rounded-pill badge-light-success  ">'+$status_number+'</span></a>'
          
            );
           }
           
          }
        },

           {
           targets: 8,
            title: 'Personal a cargo ',
          render: function (data, type, full, meta) {
            var $status_number = full['personal'];                 
           if($status_number=='0'){
            return (
              '<span class="badge rounded-pill badge-light-danger  ">No asignado</span>'
            );
           }else{
            return (
               '<a href="javascript:;" class="' + full['id'] + ' dropdown-item">' +
              '<span class="badge rounded-pill badge-light-info  ">'+$status_number+'</span></a>'
            );
           }
           
          }
        },
      
        {
          // Label
          targets: 9,
          title: 'Estatus',
          width: '30px',
          render: function (data, type, full, meta) {
            var $opcion_estado = full['estatus'];
            var $estatus = {
              1: { title: 'ACTIV0', class: 'badge-light-success' },
              2: { title: 'EJECUTADO', class: ' badge-light-danger' }



            };
            if (typeof $estatus[$opcion_estado] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $estatus[$opcion_estado].class +
              '">' +
              $estatus[$opcion_estado].title +
              '</span>'
            );
          }
        },

        

        {   // Actions
          targets: -1,
          title: 'Acciones',
          orderable: false,
          width: '30px',
          render: function (data, type, full, meta) {
          let invoicePreview = 'index.php?view=orden&id=';
          let id = full['id'];
            return (
              '<div class="d-flex align-items-center col-actions">' +
              '<a class="me-1" href="' + invoicePreview +id + '" data-bs-toggle="tooltip" data-bs-placement="top" title="Enviar a cliente">' +
              feather.icons['send'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +
              '<a class="me-25"  href="' + invoicePreview +id + '" data-bs-toggle="tooltip" data-bs-placement="top" title=Ver orden">' +
              feather.icons['eye'].toSvg({ class: 'font-medium-2 text-body' }) +
              '</a>' +           
              '</div>'
            );


           
          }
        },
        {

        }
      ],
      order: [[1, 'desc']],
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 7,
      lengthMenu: [7, 10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Exportar',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Imprimir',
              className: 'dropdown-item',
              exportOptions: { columns: [2,3,5, 6,7, 8,9] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
               exportOptions: { columns: [2,3,5, 6,7, 8,9] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
               exportOptions: { columns: [2,3,5, 6,7, 8,9] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }

        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de la orden de trabajo';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ resultados",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
        "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
      }


    });

    $('.datatablesMantenimientos tbody').on('click', '.activar-record', function (e) {
      let idVehiculo = $('.idVehiculo').val()
      let id = e.target.classList[0];
      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas cerrar?',
        text: "Tenga en cuenta que Cerrará el proceso de mantenimiento que se esta realizando al vehiculo para efectos de registo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 7;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=vehiculos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, id: id, idVehiculo: idVehiculo },
            success: function (response) {
              //alert(response);
              if (response == 1) {
                Swal.fire({
                  icon: 'success',
                  text: 'Mantenimiento cerrado con éxito.'
                }),
                  cargarDataMantenimientos(idVehiculo);
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al cerrar.'
                })
              }

            }
          });


        }
      })



    });

  }

}

$(function () {
  'use strict';


  
   // Phone Number
   if ($('.pm2').length) {
  let  phoneMask = $('.pm2')

    new Cleave(phoneMask, {
      phone: true,
      phoneRegionCode: 'US'
    });
  }

     // Phone Number
     if ($('.pm').length) {
      let  phoneMask = $('.pm')
    
        new Cleave(phoneMask, {
          phone: true,
          phoneRegionCode: 'US'
        });
      }

  cargarDataClientes('NO');
  cargarDataUsers();
  
  cargarDataCargos('NO');
  cargarDataTipos('NO');
  cargarDataMarcas('NO');
  cargarDataModelos('NO');

  cargarDataPersonal('NO');
  cargarDataItems('NO');
  cargarDataUbicaciones('NO');
  cargarDataArticulos('NO');
  cargarDataArticulosEntradas('NO');
  cargarDataArticulosSalidas('NO');



  var sourceItem = $('.source-item'),
    date = new Date(),
    datepicker = $('.date-picker'),
    dueDate = $('.due-date-picker'),
    btnAddNewItem = $('.btn-add-new ')
if ($('.dataCorreo').length) {
  cargarDataCorreo();

}


$('#imagen_edit').change(function(e) {
  var file = this.files[0];
  
  // Validar que sea una imagen
  if (!file.type.match('image.*')) {
      alert('Por favor selecciona un archivo de imagen');
      return;
  }
  
  // Validar tamaño máximo (ejemplo: 2MB)
  if (file.size > 2 * 1024 * 1024) {
      alert('La imagen es demasiado grande (máximo 2MB)');
      return;
  }
  
  var reader = new FileReader();
  reader.onload = function(e) {
      $('#preview_image_edit').attr('src', e.target.result);
      
      // Opcional: puedes hacer más cosas con la imagen aquí
      // Por ejemplo, redimensionarla o aplicar filtros
  }
  reader.readAsDataURL(file);
  $('.image_edit_p').val('1');
});

$('.enviarCorreo').on('click', function (e) {
  let media ='';
  let correo='';
  e.preventDefault();
  Swal.fire({
    title: '¿Deseas enviar?',
    text: "Esta es una prueba de envio de correo electronico.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
     let timerInterval
     Swal.fire({
       title: 'Enviando',
       html: 'Por favor, espere unos segundo mientras se esta enviando el correo, el tiempo de respuesta dependera de la velocidad de su conexión.',
       timer: 3000,
       timerProgressBar: true,
       didOpen: () => {
         Swal.showLoading()
         timerInterval = setInterval(() => {
         
         }, 100)
       },
       willClose: () => {
         clearInterval(timerInterval)
       }
     }).then((result) => {
       /* Read more about handling dismissals below */
       if (result.dismiss === Swal.DismissReason.timer) {
        // console.log('I was closed by the timer')
       }
     })

       //  pagar();
      
       enviarCorreo(media,correo);
      
   
    }
  })
});

$('.btnGenerarPDFOrden').on('click', function (e) {

  generarPDFDesdeDivs('#devDetallesOrden', '.pagina-pdf', 'documento-generado.pdf', {
    orientation: 'landscape', // opcional
    format: 'letter' // opcional
});
});


$('.btnCorreoEditar').on('click', function () {

  var $text = $('.text').val(),
    $smtp = $('.smtp').val(),
    $password = $('.password').val(),
    $host = $('.host').val(),
    $port = $('.port').val()


  if (($text != '') && ($smtp!='') && ($password!='')  && ($host!='') && ($port!='') ) { 

       //console.log('Guardare 2');
        var tipo = 1;
        var accion = 3;
        var datos =1;
            $.ajax({
                url: '../admin/index.php?action=empresa', 
                type:'POST',
                data:{text:$text,smtp:$smtp,password:$password,host:$host,port:$port,tipo:tipo,accion:accion,datos:datos},
                success:function(response){
               //alert(response);
                  var i = 0;
                  var tope =response.length;   
                //  console.log(tope);                 
                    if(tope == 1){ 
                         
                      Swal.fire({
                        icon: 'success',
                        title: 'Bien...',
                        text: 'Los datos para el uso del correo fueron editados exitosamente.'
                      
                      }),                                     
                      
                      cargarDataCorreo();
                    } 
                    if(tope == 2){
                  
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ha ocurrido un error en la edición de los datos!'
                      
                      })
                      // console.log(response)
                   
                    }
                   
                }
            });
         
          
 
   
  
  }else{
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'
    
    })
  }
});

if ($('.clientesRegistrados').length) {
  cargarEstadisticas('.cantidadClientesRegistrados','clientes');      //
}
  if ($('.itemsRegistrados').length) {
       cargarEstadisticas('.cantidadItemsRegistrados','items');
    //
  }

  if ($('.personalRegistrados').length) {
  
    cargarEstadisticas('.cantidadPersonalRegistrados','personal');
    //
  }

  if ($('.ordenesCompletadas').length) {
   
    cargarEstadisticasOrdenes('.cantidadOrdenesCompletadas','items',2);
    //
  }

  if ($('.ordenesEnEspera').length) {
   
    cargarEstadisticasOrdenes('.cantidadOrdenesEnEspera','items',1);
    //
  }

  if ($('.ordenesEnProceso').length) {
   
    cargarEstadisticasOrdenes('.cantidadOrdenesEnProceso','items',3);
    //
  }

   if ($('.ordenesADestiempo').length) {
    
    cargarEstadisticasOrdenes('.cantidadOrdenesADestiempo','items',4);
    //
  }

if ($('.dataEmpresa').length) {
  cargarDataEmpresa();

}

  if ($('.dataApp').length) {
  cargarDataEmpresa();

}

  // init date picker
  if (datepicker.length) {
    datepicker.each(function () {
      $(this).flatpickr({
        defaultDate: date
      });
    });
  }
  if (dueDate.length) {
    dueDate.flatpickr({
      defaultDate: new Date(date.getFullYear(), date.getMonth(), date.getDate()+3)
    });
  }
  if ($('.rptEntrada').length) {
    var $id = $('#idEntrada').val();
    cargarDataEntrada($id);
    // cargarDataCarrito();

  }

  if ($('.rptSalida').length) {
    var $id = $('#idSalida').val();
    cargarDataSalida($id);
    // cargarDataCarrito();

  }

  if ($('.tableAddArticulosEntrada').length) {
    cargarDataCarrito();

  }
  if ($('.tableAddArticulosSalida').length) {
    cargarDataCarritoSalida();

  }

  
  

  if ($('.txtAddOrden_codigoSalida').length) {   
   // console.log('Orden de salida');
    cargarUltimaOrden();
  }

  
  if ($('.txtAddEntrada_codigoEntrada').length) {   
    // console.log('Orden de salida');
    cargarUltimaSalida();
   }


  

  if ($('#buscarDataVehiculo').length) {
    var $id = $('#idVehiculo').val();
    cargarDataVehiculo($id);
  }


  if ($('#buscarDataPersona').length) {
    var $id = $('#idPersona').val();
    cargarDataPersona($id);
  }

    if ($('#buscarDataCliente').length) {
    var $id = $('#idPersona').val();
    cargarDataCliente($id);
  }

  if ($('#buscarDataVehiculoAsignaciones').length) {
    var $id = $('#idVehiculo').val();
    cargarDataAsignaciones($id);
  }

  if ($('#buscarDataOrdenes').length) {
    var $id = $('#idVehiculo').val();
    cargarDataOrdenes($id, 0);
  }

    if ($('#dataDasboardOrdenes').length) {
   
    cargarDataDashboardOrdenes(0);
  }

  if ($('#buscarDataOrdenesTrabajos').length) {
    var $filtro = $('#filtro').val();
    cargarDataOrdenesTrabajo($filtro);
  }



  if ($('#buscarDataOrden').length) {
    var $filtro = $('#idOrden').val();
    cargarDataOrdenTrabajo($filtro);
  }



  if ($('#cmbAddAsignarVehiculo_idPersonal').length) {
    cargarPersonalCargo('.cmbAddAsignarVehiculo_idPersonal', 1);
  }


  if ($('#cmbAddOrden_idVehiculo').length) {
    cargarVehiculos('.cmbAddOrden_idVehiculo', 1);
  }

  if ($('#cmbAddOrden_idPersonal').length) {
    cargarPersonalCargo('.cmbAddOrden_idPersonal', 1);
  }

  if ($('#cmbAddOrden_idPersonalACargo').length) {
    cargarPersonalCargo('.cmbAddOrden_idPersonalACargo', 1);
  }


if ($('#cmbAddOrden_idPersonal').length) {
    cargarPersonal('.cmbAddOrden_idPersonal', 1);
  }
  
if ($('#cmbAddOrden_idUbicacion').length) {
    cargarUbicaciones('.cmbAddOrden_idUbicacion', 1);
  }



  if ($('#cmbAddEntrada_idArticulo').length) {
    cargarArticulos('.cmbAddEntrada_idArticulo', 2);
  }


  if ($('#cmbAddVehiculo_idTipo').length) {
    cargarTipos('.cmbAddVehiculo_idTipo', 2);
  }

  if ($('#cmbAddArticulo_idTipo').length) {
    cargarTipos('.cmbAddArticulo_idTipo', 1);
  }

  if ($('#cmbEditArticulo_idTipo').length) {
    cargarTipos('.cmbEditArticulo_idTipo', 1);
  }


  if ($('#cmbEditVehiculo_idTipo').length) {
    cargarTipos('.cmbEditVehiculo_idTipo', 2);
  }






  if ($('#cmbEditPersona_idEstado').length) {
    cargarEstados('.cmbEditPersona_idEstado', 0);
  }
  if ($('#cmbAddCliente_idEstado').length) {
    cargarEstados('.cmbAddCliente_idEstado', 0);
  }

  if ($('#cmbAddPersona_idEstado').length) {
    cargarEstados('.cmbAddPersona_idEstado', 0);
  }
 
  if ($('#cmbAddPersona_idCargo').length) {
    cargarCargos('.cmbAddPersona_idCargo', 0);
  }

  if ($('#cmbAddIngreso_idCliente').length) {
    cargarClientes('.cmbAddIngreso_idCliente', 0);
  }
  
  if ($('#cmbAddOrden_idCliente').length) {
    cargarClientes('.cmbAddOrden_idCliente', 0);
  }

  

 if ($('#cmbAddVehiculo_idCliente').length) {
    cargarClientes('.cmbAddVehiculo_idCliente', 0);
  }
  $("#cmbAddVehiculo_idCliente").on('change', function () {
   
  var start = 10000;
  var end = 99999;
  var difference = Math.abs(start - end);
  $("#txtAddVehiculoPlaca").val(Math.round(Math.random() * difference + start)); });
  

  if ($('#cmbEditPersona_idCargo').length) {
    cargarCargos('.cmbEditPersona_idCargo', 0);
  }

  $(".cmbAddOrden_idCliente").on('change', function () {
    $(".cmbAddOrden_idCliente option:selected").each(function () {
      let elegido = $(this).val();    
          if (elegido == 0) {
        $('#cmbAddIngreso_idEquipo').empty();
        $('#cmbAddIngreso_idEquipo').prop('disabled', true);
        $('#cmbAddIngreso_idEquipo').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbAddIngreso_idEquipo').empty();
        cargarEquipos(".cmbAddIngreso_idEquipo", elegido);
        $('#cmbAddIngreso_idEquipo').html('<option value="0">Seleccione</option>');
        $('#cmbAddIngreso_idEquipo').prop('disabled', false);
      }
     
    });
  });

   $(".cmbAddIngreso_idEquipo").on('change', function () {
    $(".cmbClienteEquipo option:selected").each(function () {
      let elegido = $(this).val();    
     
     $('.idItem').val(elegido)
    });
  });

  


  $("#cmbAddMarcaCondicion").on('change', function () {
    $("#cmbAddMarcaCondicion option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbAddMarca_idTipo').empty();
        $('#cmbAddMarca_idTipo').prop('disabled', true);
        $('#cmbAddMarca_idTipo').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbAddMarca_idTipo').empty();
        cargarTipos(".cmbAddMarca_idTipo", elegido);
        $('#cmbAddMarca_idTipo').html('<option value="0">Seleccione</option>');
        $('#cmbAddMarca_idTipo').prop('disabled', false);
      }

    });
  });
  $("#cmbEditMarcaCondicion").on('change', function () {
    $("#cmbEditMarcaCondicion option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbEditMarca_idTipo').empty();
        $('#cmbEditMarca_idTipo').prop('disabled', true);
        $('#cmbEditMarca_idTipo').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbEditMarca_idTipo').empty();
        cargarTipos(".cmbEditMarca_idTipo", elegido);
        $('#cmbEditMarca_idTipo').html('<option value="0">Seleccione</option>');
        $('#cmbEditMarca_idTipo').prop('disabled', false);
      }

    });
  });


  $("#cmbEditModeloCondicion").on('change', function () {
    $("#cmbEditModeloCondicion option:selected").each(function () {
      let elegido = $(this).val();

      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbEditModelo_idTipo').empty();
        $('#cmbEditModelo_idTipo').prop('disabled', true);
        $('#cmbEditModelo_idTipo').html('<option value="0">Seleccione</option>');


        $('#cmbEditModelo_idMarca').empty();
        $('#cmbEditModelo_idMarca').prop('disabled', true);
        $('#cmbEditModelo_idMarca').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbEditModelo_idTipo').empty();
        cargarTipos(".cmbEditModelo_idTipo", elegido);
        $('#cmbEditModelo_idTipo').html('<option value="0">Seleccione</option>');
        $('#cmbEditModelo_idTipo').prop('disabled', false);
      }

    });
  });
  $("#cmbEditModelo_idTipo").on('change', function () {
    $("#cmbEditModelo_idTipo option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbEditModelo_idMarca').empty();
        $('#cmbEditModelo_idMarca').prop('disabled', true);
        $('#cmbEditModelo_idMarca').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbEditModelo_idMarca').empty();
        cargarMarcas(".cmbEditModelo_idMarca", elegido);
        $('#cmbEditModelo_idMarca').html('<option value="0">Seleccione</option>');
        $('#cmbEditModelo_idMarca').prop('disabled', false);
      }

    });
  });


  $("#cmbAddModeloCondicion").on('change', function () {
    $("#cmbAddModeloCondicion option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbAddModelo_idTipo').empty();
        $('#cmbAddModelo_idTipo').prop('disabled', true);
        $('#cmbAddModelo_idTipo').html('<option value="0">Seleccione</option>');


        $('#cmbAddModelo_idMarca').empty();
        $('#cmbAddModelo_idMarca').prop('disabled', true);
        $('#cmbAddModelo_idMarca').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbAddModelo_idTipo').empty();
        cargarTipos(".cmbAddModelo_idTipo", elegido);
        $('#cmbAddModelo_idTipo').html('<option value="0">Seleccione</option>');
        $('#cmbAddModelo_idTipo').prop('disabled', false);
      }

    });
  });
  $("#cmbAddModelo_idTipo").on('change', function () {
    $("#cmbAddModelo_idTipo option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbAddModelo_idMarca').empty();
        $('#cmbAddModelo_idMarca').prop('disabled', true);
        $('#cmbAddModelo_idMarca').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbAddModelo_idMarca').empty();
        cargarMarcas(".cmbAddModelo_idMarca", elegido);
        $('#cmbAddModelo_idMarca').html('<option value="0">Seleccione</option>');
        $('#cmbAddModelo_idMarca').prop('disabled', false);
      }

    });
  });

  $("#cmbAddVehiculo_idTipo").on('change', function () {
    $("#cmbAddVehiculo_idTipo option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbAddVehiculo_idMarca').empty();
        $('#cmbAddVehiculo_idMarca').prop('disabled', true);
        $('#cmbAddVehiculo_idMarca').html('<option value="0">Seleccione</option>');

        $('#cmbAddVehiculo_idModelo').empty();
        $('#cmbAddVehiculo_idModelo').prop('disabled', true);
        $('#cmbAddVehiculo_idModelo').html('<option value="0">Seleccione</option>');


      } else {
          if (elegido == 999) {
            $('.modalAddVehiculo').modal('hide');
            $('.modalAddTipo').modal('show');
          }else{
            $('#cmbAddVehiculo_idMarca').empty();
            cargarMarcas(".cmbAddVehiculo_idMarca", elegido);
            $('#cmbAddVehiculo_idMarca').html('<option value="0">Seleccione</option>');
            $('#cmbAddVehiculo_idMarca').prop('disabled', false);
          }
       
      }
   

    });
  });
  $("#cmbAddVehiculo_idMarca").on('change', function () {
    $("#cmbAddVehiculo_idMarca option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbAddVehiculo_idModelo').empty();
        $('#cmbAddVehiculo_idModelo').prop('disabled', true);
        $('#cmbAddVehiculo_idModelo').html('<option value="0">Seleccione</option>');



      } else {

            if (elegido == 999) {
            $('.modalAddVehiculo').modal('hide');
            $('.modalAddMarca').modal('show');
           }else{
            $('#cmbAddVehiculo_idModelo').empty();
            cargarModelos(".cmbAddVehiculo_idModelo", elegido);
            $('#cmbAddVehiculo_idModelo').html('<option value="0">Seleccione</option>');
            $('#cmbAddVehiculo_idModelo').prop('disabled', false);
          }
    }

    });
  });

  $("#cmbEditVehiculo_idTipo").on('change', function () {
    $("#cmbEditVehiculo_idTipo option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbEditVehiculo_idMarca').empty();
        $('#cmbEditVehiculo_idMarca').prop('disabled', true);
        $('#cmbEditVehiculo_idMarca').html('<option value="0">Seleccione</option>');

        $('#cmbEditVehiculo_idModelo').empty();
        $('#cmbEditVehiculo_idModelo').prop('disabled', true);
        $('#cmbEditVehiculo_idModelo').html('<option value="0">Seleccione</option>');


      } else {
        $('#cmbEditVehiculo_idMarca').empty();
        cargarMarcas(".cmbEditVehiculo_idMarca", elegido);
        $('#cmbEditVehiculo_idMarca').html('<option value="0">Seleccione</option>');
        $('#cmbEditVehiculo_idMarca').prop('disabled', false);
      }

    });
  });
  $("#cmbEditVehiculo_idMarca").on('change', function () {
    $("#cmbEditVehiculo_idMarca option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbEditVehiculo_idModelo').empty();
        $('#cmbEditVehiculo_idModelo').prop('disabled', true);
        $('#cmbEditVehiculo_idModelo').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbEditVehiculo_idModelo').empty();
        cargarModelos(".cmbEditVehiculo_idModelo", elegido);
        $('#cmbEditVehiculo_idModelo').html('<option value="0">Seleccione</option>');
        $('#cmbEditVehiculo_idModelo').prop('disabled', false);
      }

    });
  });


  $("#cmbAddArticulo_idTipo").on('change', function () {
    $("#cmbAddArticulo_idTipo option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbAddArticulo_idMarca').empty();
        $('#cmbAddArticulo_idMarca').prop('disabled', true);
        $('#cmbAddArticulo_idMarca').html('<option value="0">Seleccione</option>');

        $('#cmbAddArticulo_idModelo').empty();
        $('#cmbAddArticulo_idModelo').prop('disabled', true);
        $('#cmbAddArticulo_idModelo').html('<option value="0">Seleccione</option>');


      } else {
        $('#cmbAddArticulo_idMarca').empty();
        cargarMarcas(".cmbAddArticulo_idMarca", elegido);
        $('#cmbAddArticulo_idMarca').html('<option value="0">Seleccione</option>');
        $('#cmbAddArticulo_idMarca').prop('disabled', false);
      }

    });
  });
  $("#cmbAddArticulo_idMarca").on('change', function () {
    $("#cmbAddArticulo_idMarca option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbAddArticulo_idModelo').empty();
        $('#cmbAddArticulo_idModelo').prop('disabled', true);
        $('#cmbAddArticulo_idModelo').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbAddArticulo_idModelo').empty();
        cargarModelos(".cmbAddArticulo_idModelo", elegido);
        $('#cmbAddArticulo_idModelo').html('<option value="0">Seleccione</option>');
        $('#cmbAddArticulo_idModelo').prop('disabled', false);
      }

    });
  });


  $("#cmbEditArticulo_idTipo").on('change', function () {
    $("#cmbEditArticulo_idTipo option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbEditArticulo_idMarca').empty();
        $('#cmbEditArticulo_idMarca').prop('disabled', true);
        $('#cmbEditArticulo_idMarca').html('<option value="0">Seleccione</option>');

        $('#cmbEditArticulo_idModelo').empty();
        $('#cmbEditArticulo_idModelo').prop('disabled', true);
        $('#cmbEditArticulo_idModelo').html('<option value="0">Seleccione</option>');


      } else {
        $('#cmbEditArticulo_idMarca').empty();
        cargarMarcas(".cmbEditArticulo_idMarca", elegido);
        $('#cmbEditArticulo_idMarca').html('<option value="0">Seleccione</option>');
        $('#cmbEditArticulo_idMarca').prop('disabled', false);
      }

    });
  });
  $("#cmbEditArticulo_idMarca").on('change', function () {
    $("#cmbEditArticulo_idMarca option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {


        $('#cmbEditArticulo_idModelo').empty();
        $('#cmbEditArticulo_idModelo').prop('disabled', true);
        $('#cmbEditArticulo_idModelo').html('<option value="0">Seleccione</option>');



      } else {
        $('#cmbEditArticulo_idModelo').empty();
        cargarModelos(".cmbEditArticulo_idModelo", elegido);
        $('#cmbEditArticulo_idModelo').html('<option value="0">Seleccione</option>');
        $('#cmbEditArticulo_idModelo').prop('disabled', false);
      }

    });
  });

  $("#cmbAddVehiculo_idModelo").on('change', function () {
    $("#cmbAddVehiculo_idModelo option:selected").each(function () {
      let elegido = $(this).val();
   
          if (elegido == 999) {
            $('.modalAddVehiculo').modal('hide');
            $('.modalAddModelo').modal('show');
          }
       
   
   

    });
  });




  $("#cmbAddPersona_idEstado").on('change', function () {
    $("#cmbAddPersona_idEstado option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbAddPersona_idMunicipio').empty();
        $('#cmbAddPersona_idMunicipio').prop('disabled', true);
        $('#cmbAddPersona_idMunicipio').html('<option value="0">Seleccione</option>');

        $('#cmbAddPersona_idParroquia').empty();
        $('#cmbAddPersona_idParroquia').prop('disabled', true);
        $('#cmbAddPersona_idParroquia').html('<option value="0">Seleccione</option>');
      } else {
        $('#cmbAddPersona_idMunicipio').empty();
        cargarMunicipios(".cmbAddPersona_idMunicipio", elegido);
        $('#cmbAddPersona_idMunicipio').html('<option value="0">Seleccione</option>');
        $('#cmbAddPersona_idMunicipio').prop('disabled', false);

        $('#cmbAddPersona_idParroquia').empty();
        $('#cmbAddPersona_idParroquia').prop('disabled', true);
        $('#cmbAddPersona_idParroquia').html('<option value="0">Seleccione</option>');
      }

    });
  });

  $("#cmbAddPersona_idMunicipio").on('change', function () {
    $("#cmbAddPersona_idMunicipio option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbAddPersona_idParroquia').empty();
        $('#cmbAddPersona_idParroquia').prop('disabled', true);
        $('#cmbAddPersona_idParroquia').html('<option value="0">Seleccione</option>');

      } else {
        $('#cmbAddPersona_idParroquia').empty();
        cargarParroquias(".cmbAddPersona_idParroquia", elegido);
        $('#cmbAddPersona_idParroquia').html('<option value="0">Seleccione</option>');
        $('#cmbAddPersona_idParroquia').prop('disabled', false);
      }

    });
  });

  $("#cmbEditPersona_idEstado").on('change', function () {
    $("#cmbEditPersona_idEstado option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbEditPersona_idMunicipio').empty();
        $('#cmbEditPersona_idMunicipio').prop('disabled', true);
        $('#cmbEditPersona_idMunicipio').html('<option value="0">Seleccione</option>');

        $('#cmbEditPersona_idParroquia').empty();
        $('#cmbEditPersona_idParroquia').prop('disabled', true);
        $('#cmbEditPersona_idParroquia').html('<option value="0">Seleccione</option>');
      } else {
        $('#cmbEditPersona_idMunicipio').empty();
        cargarMunicipios(".cmbEditPersona_idMunicipio", elegido);
        $('#cmbEditPersona_idMunicipio').html('<option value="0">Seleccione</option>');
        $('#cmbEditPersona_idMunicipio').prop('disabled', false);

        $('#cmbEditPersona_idParroquia').empty();
        $('#cmbEditPersona_idParroquia').prop('disabled', true);
        $('#cmbEditPersona_idParroquia').html('<option value="0">Seleccione</option>');
      }

    });
  });

  $("#cmbEditPersona_idMunicipio").on('change', function () {
    $("#cmbEditPersona_idMunicipio option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbEditPersona_idParroquia').empty();
        $('#cmbEditPersona_idParroquia').prop('disabled', true);
        $('#cmbEditPersona_idParroquia').html('<option value="0">Seleccione</option>');

      } else {
        $('#cmbEditPersona_idParroquia').empty();
        cargarParroquias(".cmbEditPersona_idParroquia", elegido);
        $('#cmbEditPersona_idParroquia').html('<option value="0">Seleccione</option>');
        $('#cmbEditPersona_idParroquia').prop('disabled', false);
      }

    });
  });



  $("#cmbAddCliente_idEstado").on('change', function () {
    $("#cmbAddCliente_idEstado option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbAddCliente_idMunicipio').empty();
        $('#cmbAddCliente_idMunicipio').prop('disabled', true);
        $('#cmbAddCliente_idMunicipio').html('<option value="0">Seleccione</option>');

        $('#cmbAddCliente_idParroquia').empty();
        $('#cmbAddCliente_idParroquia').prop('disabled', true);
        $('#cmbAddCliente_idParroquia').html('<option value="0">Seleccione</option>');
      } else {
        $('#cmbAddv_idMunicipio').empty();
        cargarMunicipios(".cmbAddCliente_idMunicipio", elegido);
        $('#cmbAddCliente_idMunicipio').html('<option value="0">Seleccione</option>');
        $('#cmbAddCliente_idMunicipio').prop('disabled', false);

        $('#cmbAddCliente_idParroquia').empty();
        $('#cmbAddCliente_idParroquia').prop('disabled', true);
        $('#cmbAddCliente_idParroquia').html('<option value="0">Seleccione</option>');
      }

    });
  });

  $("#cmbAddCliente_idMunicipio").on('change', function () {
    $("#cmbAddCliente_idMunicipio option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbAddCliente_idParroquia').empty();
        $('#cmbAddCliente_idParroquia').prop('disabled', true);
        $('#cmbAddCliente_idParroquia').html('<option value="0">Seleccione</option>');

      } else {
        $('#cmbAddCliente_idParroquia').empty();
        cargarParroquias(".cmbAddCliente_idParroquia", elegido);
        $('#cmbAddCliente_idParroquia').html('<option value="0">Seleccione</option>');
        $('#cmbAddCliente_idParroquia').prop('disabled', false);
      }

    });
  });

  $("#cmbEditCliente_idEstado").on('change', function () {
    $("#cmbEditCliente_idEstado option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbEditCliente_idMunicipio').empty();
        $('#cmbEditCliente_idMunicipio').prop('disabled', true);
        $('#cmbEditCliente_idMunicipio').html('<option value="0">Seleccione</option>');

        $('#cmbEditCliente_idParroquia').empty();
        $('#cmbEditCliente_idParroquia').prop('disabled', true);
        $('#cmbEditCliente_idParroquia').html('<option value="0">Seleccione</option>');
      } else {
        $('#cmbEditCliente_idMunicipio').empty();
        cargarMunicipios(".cmbEditCliente_idMunicipio", elegido);
        $('#cmbEditCliente_idMunicipio').html('<option value="0">Seleccione</option>');
        $('#cmbEditCliente_idMunicipio').prop('disabled', false);

        $('#cmbEditCliente_idParroquia').empty();
        $('#cmbEditCliente_idParroquia').prop('disabled', true);
        $('#cmbEditCliente_idParroquia').html('<option value="0">Seleccione</option>');
      }

    });
  });

  $("#cmbEdiCliente_idMunicipio").on('change', function () {
    $("#cmbEditCliente_idMunicipio option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#cmbEditCliente_idParroquia').empty();
        $('#cmbEditCliente_idParroquia').prop('disabled', true);
        $('#cmbEditPCliente_idParroquia').html('<option value="0">Seleccione</option>');

      } else {
        $('#cmbEditCliente_idParroquia').empty();
        cargarParroquias(".cmbEditCliente_idParroquia", elegido);
        $('#cmbEditCliente_idParroquia').html('<option value="0">Seleccione</option>');
        $('#cmbEditCliente_idParroquia').prop('disabled', false);
      }

    });
  });


  $("#cmbAddIngreso_idCliente").on('change', function () {
    $("#cmbAddIngreso_idCliente option:selected").each(function () {
      let elegido = $(this).val();    
      cargarDatosCliente(elegido);
    });
  });

  $("#cmbAddIngreso_idVehiculo").on('change', function () {
    $("#cmbAddIngreso_idVehiculo option:selected").each(function () {
      let elegido = $(this).val();
    
      cargarDatosItem(elegido);
      
  

    });
  });

  


  //////////////////////////////////////

  $("#tipo").on('change', function () {
    $("#tipo option:selected").each(function () {
      let elegido = $(this).val();
      ////console.log(elegido);
      if (elegido == 0) {
        $('#marca').empty();
        $('#marca').html('<option>Seleccione</option>');
        $('#marca').prop('disabled', true);
        $('#modelo').empty();
        $('#modelo').html('<option>Seleccione</option>');
        $('#modelo').prop('disabled', true);
      } else {
        $('#marca').empty();
        cargarMarca(elegido);
        $('#marca').prop('disabled', false);
      }

    });
  });

  $("#marca").on('change', function () {
    $("#marca option:selected").each(function () {
      let elegido = $(this).val();
      // //console.log(elegido);
      $('#modelo').empty();
      cargarModelo(elegido);
      $('#modelo').prop('disabled', false);
    });
  });

  if ($('#dashboard').length) {
    $('#dashboard').ready(function () {
      var isRtl = $('html').attr('data-textdirection') === 'rtl';

      // On load Toast
      setTimeout(function () {
        toastr['success'](
          'JGFixPro - Sistema de gestion de ordenes de trabajo!',
          '👋 Bienvenido de nuevo!',
          {
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          }
        );
      }, 2000);


    });
  } else {
  }


  $('#salir').on('click', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Deseas Salir?',
      text: "No podras detener la operación una ves iniciada!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        let timerInterval
        Swal.fire({
          title: 'Saliendo ...!',
          html: 'Hasta pronto.',
          timer: 3000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
              const content = Swal.getContent()
              if (content) {
                const b = content.querySelector('b')
                if (b) {
                  b.textContent = Swal.getTimerLeft()
                }
              }
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            //console.log('I was closed by the timer')
          }
        })
        //  pagar();
        salir();
      }
    })
  });

  $('#btnRespaldarBase').on('click', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Deseas Respaldar?',
      text: "No podras detener la operación una ves iniciada!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        let timerInterval
        Swal.fire({
          title: 'Respaldando Base ...!',
          html: 'Se esta respaldando la base de datos, esto puede tardar algunos mminutos.',
          timer: 6000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {

            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            //console.log('I was closed by the timer')
          }
        })
        //  pagar();
        respaldarBase();
      }
    })
  });

 $('.btnEditarEmpresa').on('click', function () {
  //console.log('guardare');
  
  var formData = new FormData();
  var $name = $('.update-record-empresa .name').val(),
    $email = $('.update-record-empresa .email').val(),
    $telefonos = $('.update-record-empresa .telefonos').val(),
    $rif = $('.update-record-empresa .rif').val(),
   
    $direccion = $('.update-record-empresa .direccion').val(),
    $op2 = $('.image_edit_p').val()
    var op =0;
    var files1 = $('#imagen_edit')[0].files[0];

  if (($name != '') && ($email!='') && ($telefonos!='')  && ($rif!='') && ($direccion!='')) { 

       //console.log('Guardare 2');
        formData.append('file1', files1);
        var tipo = 1;
        var accion = 2;
        var datos =1;
            $.ajax({
                url: '../admin/index.php?action=empresa&$op2='+$op2+'&name='+$name+'&email='+$email+'&telefonos='+$telefonos+'&rif='+$rif+'&direccion='+$direccion+'&tipo='+tipo+'&accion='+accion+'&datos='+datos, 
                type:'POST',
                data: formData,
                contentType: false,
                processData: false,
              
                success:function(response){
               //alert(response);
                  var i = 0;
                  var tope =response.length;   
                //  console.log(tope);                 
                    if(response == 1){ 
                         
                     let timerInterval
                  Swal.fire({
                    title: 'Actualizacion exitosa!',
                    html: 'Saliendo del sistema, Deberá ingresar nuevamente.',
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading()
                      timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                          const b = content.querySelector('b')
                          if (b) {
                            b.textContent = Swal.getTimerLeft()
                          }
                        }
                      }, 100)
                    },
                    willClose: () => {
                      clearInterval(timerInterval)
                    }
                  }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                      salir();
                    }
                  })
                    } 
                    if(response == 2){
                  
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ha ocurrido un error en la edición de los datos!'
                      
                      })
                      // console.log(response)
                   
                    }
                   
                }
            });
         
          
 
   
  
  }else{
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'
    
    })
  }
});


  ////////////////////////////////////////////////////////
  $('.btnAddUbicacion').on('click', function () {
    var $ubicacion = $('.frmAddUbicacion .txtAddUbicacion').val();
    var $descripcion = $('.frmAddUbicacion .txtAddDescripcion').val();

    if (($ubicacion != '') && ($descripcion != '')) {

      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=ubicaciones',
        type: 'POST',
        data: { ubicacion: $ubicacion, descripcion: $descripcion, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.frmAddUbicacion .txtAddUbicacion').val('');
            $('.frmAddUbicacion .txtAddDescripcion').val('');
            //count++;
            $('.modalAddUbicacion').modal('hide');

            cargarDataUbicaciones('NO');

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre de la Ubicacion que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });
  $('.btnEditUbicacion').on('click', function (e) {
    let $ubicacion = $('.frmEditUbicacion .txtEditUbicacion').val(),
      $descripcion = $('.frmEditUbicacion .txtEditDescripcion').val(),
      $id = $('.frmEditUbicacion .txtEditIdUbicacion').val()
    //console.log($redi);

    if (($ubicacion != '') && ($descripcion != '')) {

      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=ubicaciones',
        type: 'POST',
        data: { id: $id, ubicacion: $ubicacion, descripcion: $descripcion, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {
          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha actualizado correctamente'
            }),
              $('.frmEditUbicacion .txtEditUbicacion').val('');
            $('.frmEditUbicacion .txtEditDescripcion').val('');
            $('.frmEditUbicacion .txtEditIdUbicacion').val('');
            //count++;
            $('.modalEditUbicacion').modal('hide');

            cargarDataUbicaciones('NO');

          }
          if (response == '2') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre de la Ubicación que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }
          if (response == '3') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'error.! Hubo un problema al guardar'

            })
            // console.log(response)

          }

        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

  $('.btnAddCargo').on('click', function () {
    var $cargo = $('.frmAddCargo .txtAddCargo').val()

    if ($cargo != '') {

      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=cargos',
        type: 'POST',
        data: { cargo: $cargo, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.frmAddCargo .txtAddCargo').val('');
            //count++;
            $('.modalAddCargo').modal('hide');

            cargarDataCargos('NO');

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del CARGO que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnEditCargo').on('click', function (e) {
    let $cargo = $('.frmEditCargo .txtEditCargo').val(),
      $id = $('.frmEditCargo .txtEditIdCargo').val()
    //console.log($redi);

    if ($cargo != '') {

      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=cargos',
        type: 'POST',
        data: { id: $id, cargo: $cargo, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {
          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha actualizado correctamente'
            }),
              $('.frmEditCargo .txtEditCargo').val('');
            $('.frmEditCargo .txtEditIdCargo').val('');
            //count++;
            $('.modalEditCargo').modal('hide');

            cargarDataCargos('NO');

          }
          if (response == '2') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del  Cargo que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }
          if (response == '3') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'error.! Hubo un problema al guardar'

            })
            // console.log(response)

          }

        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////

  $('.btnAddTipo').on('click', function () {
    //alert('add tipo');
    var $caracteristica = $('.txtAddTipo').val(),
      $condicion = $('.cmbAddTipoCondicion').val()
    //frmAddTipo txtAddTipo cmbAddTipoCondicion btnAddTipo
    if (($caracteristica != '') && ($condicion != '')) {

      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=tipos',
        type: 'POST',
        data: { caracteristica: $caracteristica, condicion: $condicion, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.txtAddTipo').val('');
            //count++;
            $('.modalAddTipo').modal('hide');
            
            if ($('.cmbAddVehiculo_idTipo').length) {   
                 $('#cmbEditVehiculo_idMarca').empty();
                  $('#cmbEditVehiculo_idMarca').prop('disabled', true);
                  $('#cmbEditVehiculo_idMarca').html('<option value="0">Seleccione</option>');

                $('#cmbEditVehiculo_idModelo').empty();
                $('#cmbEditVehiculo_idModelo').prop('disabled', true);
                $('#cmbEditVehiculo_idModelo').html('<option value="0">Seleccione</option>');

               cargarTipos('.cmbAddVehiculo_idTipo', 2);    
              }
            
            cargarDataTipos('NO');

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del Tipo que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnEditTipo').on('click', function (e) {
    var $caracteristica = $('.frmEditTipo .txtEditTipo').val(),
      $condicion = $('.frmEditTipo .cmbEditTipoCondicion').val(),
      $id = $('.frmEditTipo .txtEditIdTipo').val()
    //console.log($redi);

    if (($caracteristica != '') && ($condicion != '')) {

      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=tipos',
        type: 'POST',
        data: { id: $id, caracteristica: $caracteristica, condicion: $condicion, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {
          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha actualizado correctamente'
            }),
              $('.frmEditTipo .txtEditTipo').val('');
            $('.frmEditTipo .txtEditIdTipo').val('');
            //count++;
            $('.modalEditTipo').modal('hide');

            cargarDataTipos('NO');

          }
          if (response == '2') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del  TIPO que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }
          if (response == '3') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'error.! Hubo un problema al guardar'

            })
            // console.log(response)

          }

        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  $('.btnAddMarca').on('click', function () {
    var $marca = $('.txtAddMarca').val(),
      $idTipo = $('.cmbAddMarca_idTipo').val()
    //frmAddTipo txtAddTipo cmbAddTipoCondicion btnAddTipo
    if (($marca != '') && ($idTipo != '')) {

      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=marcas',
        type: 'POST',
        data: { marca: $marca, idTipo: $idTipo, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.frmAddMarca .txtAddMarca').val('');
            //count++;
            $('.modalAddMarca').modal('hide');
   
            if ($('.cmbAddVehiculo_idTipo').length) {   
                  $('#cmbEditVehiculo_idMarca').empty();
                  $('#cmbEditVehiculo_idMarca').prop('disabled', true);
                  $('#cmbEditVehiculo_idMarca').html('<option value="0">Seleccione</option>');

                $('#cmbEditVehiculo_idModelo').empty();
                $('#cmbEditVehiculo_idModelo').prop('disabled', true);
                $('#cmbEditVehiculo_idModelo').html('<option value="0">Seleccione</option>');

               cargarTipos('.cmbAddVehiculo_idTipo', 2);   

              }
            
            cargarDataMarcas('NO');

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre de la MARCA que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });


  $('.btnEditMarca').on('click', function (e) {
    var $marca = $('.frmEditMarca .txtEditMarca').val(),
      $idTipo = $('.frmEditMarca .cmbEditMarca_idTipo').val(),
      $id = $('.frmEditMarca .txtEditIdMarca').val()
    //console.log($redi);

    if (($marca != '') && ($idTipo != '')) {

      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=marcas',
        type: 'POST',
        data: { id: $id, idTipo: $idTipo, marca: $marca, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {
          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha actualizado correctamente'
            }),
              $('.frmEditMarca .txtEditMarca').val('');
            $('.frmEditMarca .txtEditIdMarca').val('');
            //count++;
            $('.modalEditMarca').modal('hide');

            cargarDataMarcas('NO');

          }
          if (response == '2') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre de la MARCA que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }
          if (response == '3') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'error.! Hubo un problema al guardar'

            })
            // console.log(response)

          }

        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });
  //////////////////////////////////////////////////////////////////////////////////////////////////

  $('.btnAddModelo').on('click', function () {
    var $modelo = $('.txtAddModelo').val(),
      $idMarca = $('.cmbAddModelo_idMarca').val()
    //frmAddTipo txtAddTipo cmbAddTipoCondicion btnAddTipo
    if (($modelo != '') && ($idMarca != '')) {

      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=modelos',
        type: 'POST',
        data: { modelo: $modelo, idMarca: $idMarca, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.frmAddModelo .txtAddModelo').val('');

            //count++;
            $('.modalAddModelo').modal('hide');
            

              if ($('.cmbAddVehiculo_idTipo').length) {   
                  $('#cmbAddVehiculo_idMarca').empty();
                  $('#cmbAddVehiculo_idMarca').prop('disabled', true);
                  $('#cmbAddVehiculo_idMarca').html('<option value="0">Seleccione</option>');

                $('#cmbAddVehiculo_idModelo').empty();
                $('#cmbAddVehiculo_idModelo').prop('disabled', true);
                $('#cmbAddVehiculo_idModelo').html('<option value="0">Seleccione</option>');

               cargarTipos('.cmbAddVehiculo_idTipo', 2);   

              }
            
            cargarDataModelos('NO');

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del MODELO que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });


  $('.btnEditModelo').on('click', function (e) {
    var $modelo = $('.frmEditModelo .txtEditModelo').val(),
      $idMarca = $('.frmEditModelo .cmbEditModelo_idMarca').val(),
      $id = $('.frmEditModelo .txtEditIdModelo').val()
    //console.log($redi);

    if (($modelo != '') && ($idMarca != '0')) {

      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=modelos',
        type: 'POST',
        data: { id: $id, idMarca: $idMarca, modelo: $modelo, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {
          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha actualizado correctamente'
            }),
              $('.frmEditModelo .txtEditModelo').val('');
            $('.frmEditModelo .txtEditIdModelo').val('');
            //count++;
            $('.modalEditModelo').modal('hide');

            cargarDataModelos('NO');

          }
          if (response == '2') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del MODELO que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }
          if (response == '3') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'error.! Hubo un problema al guardar'

            })
            // console.log(response)

          }

        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////


  $('.btnAddVehiculo').on('click', function () {
    var formData = new FormData();
    var
    $idCliente = $('.frmAddVehiculo .cmbAddVehiculo_idCliente').val(),
     $placa = $('.frmAddVehiculo .txtAddVehiculoPlaca').val(),
      $idModelo = $('.frmAddVehiculo .cmbAddVehiculo_idModelo').val(),
      $ano = $('.frmAddVehiculo .txtAddVehiculoAno').val(),
      $color = $('.frmAddVehiculo .txtAddVehiculoColor').val(),
      $serialChasis = $('.frmAddVehiculo .txtAddVehiculoSerialChasis').val(),
      $serialMotor = $('.frmAddVehiculo .txtAddVehiculoSerialMotor').val(),
      $condicion = $('.frmAddVehiculo .cmbAddVehiculoCondicion').val()
    var files = $('#fileAddVehiculoArchivo')[0].files[0];
    //frmAddTipo txtAddTipo cmbAddTipoCondicion btnAddTipo
    if (($placa != '') && ($idCliente != '0') && ($idModelo != '0') && 
    ($ano != '') && ($color != '') && ($serialChasis != '') && ($serialMotor != '') && ($condicion != '')) {
      if (typeof files !== 'undefined') {
        formData.append('file', files);

        $.ajax({
          url: '../admin/index.php?action=items&idCliente='+$idCliente+'&serialMotor=' + $serialMotor + '&serialChasis=' +
            $serialChasis + '&color=' + $color + '&ano=' + $ano + '&placa=' + $placa + '&idModelo=' + $idModelo + '&condicion=' + $condicion + '&tipo=1&accion=1&datos=1',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {

            if (response == '1') {
              Swal.fire({
                icon: 'success',
                title: 'Bien',
                text: 'Se ha Guardado correctamente'
              }),
                $('.frmAddVehiculo .txtAddVehiculoAno').val('');
              $('.frmAddVehiculo .txtAddVehiculoColor').val('');
              $('.frmAddVehiculo .txtAddVehiculoSerialChasis').val('');
              $('.frmAddVehiculo .txtAddVehiculoSerialMotor').val('');
              $('.frmAddVehiculo .fileAddVehiculoArchivo').val('');
              //count++;
              $('.modalAddVehiculo').modal('hide');

              cargarDataItems('NO');

            }
            if (response == 4) {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El codigo que desea registrar, ya esta asociado a otro registro!'

              })
              // console.log(response)

            }


          }
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Debes elegir una imagen del articulo para subir'

        })
      }

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnEditVehiculo').on('click', function () {
    var formData = new FormData();
    formData = '';


  

    var $placa = $('.frmEditVehiculo .txtEditVehiculoPlaca').val(),
      $idModelo = $('.frmEditVehiculo .cmbEditVehiculo_idModelo').val(),
      $ano = $('.frmEditVehiculo .txtEditVehiculoAno').val(),
      $color = $('.frmEditVehiculo .txtEditVehiculoColor').val(),
      $serialChasis = $('.frmEditVehiculo .txtEditVehiculoSerialChasis').val(),

      $condicion = $('.frmEditVehiculo .cmbEditVehiculoCondicion').val(),
      $id = $('.idVehiculo').val()
    //console.log($placa, $idModelo, $ano, $color, $serialChasis, $condicion);
   
    if (($placa != '') && ($idModelo != '') && ($ano != '') && ($color != '') 
      && ($serialChasis != '') && ($condicion != '')) {

      $.ajax({
        url: '../admin/index.php?action=items&serialChasis=' +
          $serialChasis + '&color=' + $color + '&ano=' + $ano + '&placa=' + $placa + '&idModelo=' + $idModelo + '&condicion=' + $condicion + '&id=' + $id + '&tipo=1&accion=3&datos=1',
        type: 'POST',
        data: formData,

        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.frmEditVehiculo .txtEditVehiculoPlaca').val('');
            $('.frmEditVehiculo .txtEditVehiculoAno').val('');
            $('.frmEditVehiculo .txtEditVehiculoColor').val('');
            $('.frmEditVehiculo .txtEditVehiculoSerialChasis').val('');
            $('.frmEditVehiculo .txtEditVehiculoSerialMotor').val('');
            //count++;
            $('.modalDatosVehiculo').modal('hide');

            cargarDataVehiculo($id);

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El CODIGO que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnEditarDatosVehiculo').on('click', function () {

    var $id = $('.idVehiculo').val()
    editarVehiculo($id);

  });
  $('.btnAsignarVehiculo').on('click', function (e) {


    let $idDependencia = $('.cmbAddAsignarVehiculo_idDependencia').val(),
      $id = $('.idVehiculo').val(),
      $fechaAsignacion = $('.txtcmbAddAsignarVehiculoFechaAsignacion').val(),
      $observacion = $('.textAreaAddAsignarVehiculoObservacion').val()
    if (($idDependencia != '0') && ($id != '') && ($fechaAsignacion != '') && ($observacion != '')) {
      var tipo = 1;
      var accion = 1;
      var datos = 2;
      $.ajax({
        url: '../admin/index.php?action=vehiculos',
        type: 'POST',
        data: { id: $id, idDependencia: $idDependencia, fechaAsignacion: $fechaAsignacion, observacion: $observacion, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se asignado el vehiculo   correctamente'
            }),

              $('.modalAsignarVehiculo').modal('hide');
            $('.vehiculoSinAsignacion').attr("style", "display:none");
            cargarDataVehiculo($id);

          }


          if (response == '2') {
            Swal.fire({
              icon: 'danger',
              title: 'Error',
              text: 'El vehiculo que desea asignar, tiene activa una asignación, debe reasigar primero'
            })
          }

        }
      });

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }

  });

  $('.btnAsignarVehiculoMantenimiento').on('click', function (e) {


    let $idPersonal = $('.cmbAddAsignarVehiculo_idPersonal').val(),
      $id = $('.idVehiculo').val(),
      $tipoMantenimiento = $('.cmbAddAsignarVehiculoTipoMantenimiento').val(),
      $fechaMantenimiento = $('.txtcmbAddAsignarVehiculoFechaMantenimiento').val(),
      $tiempoEstimado = $('.txtcmbAddAsignarVehiculoTiempoEstimado').val(),
      $fechaProximoMantenimiento = $('.txtcmbAddAsignarVehiculoFechaProximoMantenimiento').val(),
      $observacion = $('.textAreaAddAsignarVehiculoObservacion').val()
    if (($idPersonal != '0') && ($id != '') && ($tipoMantenimiento != '') && ($fechaMantenimiento != '') && ($tiempoEstimado != '') && ($observacion != '')) {
      var tipo = 1;
      var accion = 1;
      var datos = 3;
      $.ajax({
        url: '../admin/index.php?action=vehiculos',
        type: 'POST',
        data: {
          id: $id, idPersonal: $idPersonal, tipoMantenimiento: $tipoMantenimiento, fechaProximoMantenimiento: $fechaProximoMantenimiento,
          tiempoEstimado: $tiempoEstimado, fechaMantenimiento: $fechaMantenimiento, observacion: $observacion, tipo: tipo, accion: accion, datos: datos
        },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se realizo el registro de mantenimiento  correctamente'
            }),
              $('.modalAddVehiculoMantenimiento').modal('hide');
            cargarDataMantenimientos($id);

          } else {

            Swal.fire({
              icon: 'info',
              title: 'Error',
              text: 'Hubo un error en el registro'
            })
          }


        }
      });

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }

  });
  $('.btnReasignarVehiculo').on('click', function (e) {
    var $id = $('.idVehiculo').val(),
      $idAsignacion = $('.dataAsignacion_idAsignacion').html()
    //console.log(id);
    e.preventDefault();
    Swal.fire({
      title: '¿Deseas Reasignar?',
      text: "Tenga en cuenta que reasignara el presente vehiculo a una nueva dependencia, este cambio dejara constancia de movimiento para futuros reportes",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        //  pagar();
        var tipo = 1;
        var accion = 6;
        var datos = 1;
        $.ajax({
          url: '../admin/index.php?action=vehiculos',
          type: 'post',
          data: { tipo: tipo, accion: accion, datos: datos, id: $id, idAsignacion: $idAsignacion },
          success: function (response) {
            //alert(response);
            if (response == '1') {
              Swal.fire({
                icon: 'success',
                text: 'Vehiculo liberado, ya es posible reasignarlo  con éxito.'
              }),
                cargarDataVehiculo($id);
              $('.vehiculoAsignado').attr("style", "display:none");
              $('.modalAsignarVehiculo').modal('show');

            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al Reasignar.'
              })
            }

          }
        });


      }
    })



  });

    
  $('.btnEditUsuario').on('click', function () {
    var $nombre = $('.frmEditUsuario .txtEditUsuarioNombre').val().toUpperCase(),
      $nombreUsuario = $('.frmEditUsuario .txtEditUsuarioNombreUsuario').val().toUpperCase(),
      $confirmContrasena = $('.frmEditUsuario .txtEditUsuarioReContrasena').val(),   
      $contrasena = $('.frmEditUsuario .txtEditUsuarioContrasena').val(),
      $id = $('.frmEditUsuario .txtEditUsuarioIdUsuario').val()
   
    if (($nombreUsuario != '') && ($nombre != '') ) {
      if(($confirmContrasena == '') || ($contrasena == '')){
        $confirmContrasena=0;
             //console.log('Guardare');
             var tipo = 1;
             var accion = 2;
             var datos = 1;
             $.ajax({
               url: '../admin/index.php?action=user',
               type: 'POST',
               data: { id:$id,nombre: $nombre, nombreUsuario: $nombreUsuario, confirmContrasena: $confirmContrasena, tipo: tipo, accion: accion, datos: datos },
               success: function (response) {
                
                 if (response == 1) {
                  let timerInterval
                  Swal.fire({
                    title: 'Actualizacion exitosa!',
                    html: 'Saliendo del sistema, Deberá ingresar nuevamente con sus datos.',
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading()
                      timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                          const b = content.querySelector('b')
                          if (b) {
                            b.textContent = Swal.getTimerLeft()
                          }
                        }
                      }, 100)
                    },
                    willClose: () => {
                      clearInterval(timerInterval)
                    }
                  }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                      salir();
                    }
                  })
                  
                 }
                 if (response == 2) {
                   Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: 'El nombre de usuario que esta intentando registrar, ya esta asociado a otro registro!'
     
                   })
                   // //console.log(response)
     
                 }
     
               }
             });
      }else{
      if ($contrasena == $confirmContrasena) {
        //console.log('Guardare');
        var tipo = 1;
        var accion = 2;
        var datos = 1;
        $.ajax({
          url: '../admin/index.php?action=user',
          type: 'POST',
          data: { id:$id,nombre: $nombre, nombreUsuario: $nombreUsuario, confirmContrasena: $confirmContrasena, tipo: tipo, accion: accion, datos: datos },
          success: function (response) {
           
            if (response == 1) {
                   
                  let timerInterval
                  Swal.fire({
                    title: 'Actualizacion exitosa!',
                    html: 'Saliendo del sistema, Deberá ingresar nuevamente con sus datos.',
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading()
                      timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                          const b = content.querySelector('b')
                          if (b) {
                            b.textContent = Swal.getTimerLeft()
                          }
                        }
                      }, 100)
                    },
                    willClose: () => {
                      clearInterval(timerInterval)
                    }
                  }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                      salir();
                    }
                  })
                
               
                
             
            }
            if (response == 2) {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El nombre de usuario que esta intentando registrar, ya esta asociado a otro registro!'

              })
              // //console.log(response)

            }

          }
        });
      } else {

        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Las contraseñas deben ser iguales'

        })
      }
    }


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $('.btnAddArticulo').on('click', function () {

    var $idModelo = $('.frmAddArticulo .cmbAddArticulo_idModelo').val(),
      $nombre = $('.frmAddArticulo .txtAddArticuloNombre').val(),
      $descripcion = $('.frmAddArticulo .textAreaAddArticuloDescripcion').val(),
      $medida = $('.frmAddArticulo .cmbAddArticuloMedida').val()
    //frmAddTipo txtAddTipo cmbAddTipoCondicion btnAddTipo
    if (($idModelo != '0') && ($nombre != '') && ($descripcion != '')) {

      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=articulos',
        type: 'POST',
        data: { medida: $medida, idModelo: $idModelo, nombre: $nombre, descripcion: $descripcion, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.frmAddArticulo .txtAddArticuloNombre').val('');
            $('.frmAddArticulo .textAreaAddArticuloDescripcion').val('');
            //count++;
            $('.modalAddArticulo').modal('hide');

            cargarDataArticulos('NO');

          }
          if (response == '2') {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del Articulo que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnEditArticulo').on('click', function () {

    var $idModelo = $('.frmEditArticulo .cmbEditArticulo_idModelo').val(),
      $nombre = $('.frmEditArticulo .txtEditArticuloNombre').val(),
      $id = $('.frmEditArticulo .txtEditArticuloId').val(),
      $descripcion = $('.frmEditArticulo .textAreaEditArticuloDescripcion').val(),
      $medida = $('.frmEditArticulo .cmbEditArticuloMedida').val()
    //frmAddTipo txtAddTipo cmbAddTipoCondicion btnAddTipo
    if (($idModelo != '0') && ($nombre != '') && ($descripcion != '') && ($medida != '0')) {

      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=articulos',
        type: 'POST',
        data: { id: $id, medida: $medida, idModelo: $idModelo, nombre: $nombre, descripcion: $descripcion, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              $('.frmEditArticulo .txtEditArticuloNombre').val('');
            $('.frmEditArticulo .textAreaEditArticuloDescripcion').val('');
            //count++;
            $('.modalEditArticulo').modal('hide');

            cargarDataArticulos('NO');

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El nombre del Articulo que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnAddEntrada_addArticulo').on('click', function () {
    let idArticulo = $(".cmbAddEntrada_idArticulo").val(),
      nombre = $('select[name="cmbAddEntrada_idArticulo"] option:selected').text(),
      cantidad = $(".txtAddEntradaCantidad").val(),
      precio = $(".txtAddEntradaPrecio").val()
    addArticuloEntrada(idArticulo, nombre, cantidad, precio);

  });
  $('.btnAddSalida_addArticulo').on('click', function () {
    let idArticulo = $(".cmbAddEntrada_idArticulo").val(),
      nombre = $('select[name="cmbAddEntrada_idArticulo"] option:selected').text(),
      cantidad = $(".txtAddEntradaCantidad").val()
    addArticuloSalida(idArticulo, nombre, cantidad, 1);

  });

  $('.anularAddEntrada').on('click', function (e) {
    anularAddEntrada();
  });

  $('.anularAddSalida').on('click', function (e) {
    anularAddSalida();
  });


  $('.btnAddEntrada').on('click', function (e) {

    let $fechaEmision = $(".txtAddEntradaFechaEmision").val(),
      $fechaRecepcion = $(".txtAddEntradaFechaRecepcion").val(),
      $observacion = $(".textAreaAddEntradaObservacion").val(),
      $codigoEntrada = $(".txtAddEntrada_codigoEntrada").val()
    if (($fechaEmision != '') && ($fechaRecepcion != '') && ($observacion != '') && ($codigoEntrada != '')) {

      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Registrar?',
        text: "Tenga en cuenta que esta llenando el inventario y agregando articulos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 12;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, fechaEmision: $fechaEmision, fechaRecepcion: $fechaRecepcion, observacion: $observacion, codigoEntrada: $codigoEntrada },
            success: function (response) {
              //alert(response);
              if (response == '1') {
                Swal.fire({
                  icon: 'success',
                  text: 'Registro de entrada registrada con éxito.'
                }),

                  window.location = 'index.php?view=entradas';
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Registrar entrada.'
                })
              }

            }
          });


        }
      })

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnAddSalida').on('click', function (e) {

    let $fechaEmision = $(".txtAddEntradaFechaEmision").val(),
      $observacion = $(".textAreaAddEntradaObservacion").val(),
      $codigoSalida = $(".txtAddEntrada_codigoEntrada").val(),
      $idDependencia = $(".cmbAddSalida_idDependencia").val()
    if (($fechaEmision != '') && ($observacion != '') && ($codigoSalida != '') && ($idDependencia != '0')) {

      //console.log(id);
      e.preventDefault();
      Swal.fire({
        title: '¿Deseas Registrar?',
        text: "Tenga en cuenta que esta generando una salida en el inventario",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          //  pagar();
          var tipo = 1;
          var accion = 14;
          var datos = 1;
          $.ajax({
            url: '../admin/index.php?action=articulos',
            type: 'post',
            data: { tipo: tipo, accion: accion, datos: datos, fechaEmision: $fechaEmision, idDependencia: $idDependencia, observacion: $observacion, codigoSalida: $codigoSalida },
            success: function (response) {
              //alert(response);
              if (response == '1') {
                Swal.fire({
                  icon: 'success',
                  text: 'Registro de Salida registrada con éxito.'
                }),


                  window.location = 'index.php?view=salidas';
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Hubo un error al Registrar la salida.'
                })
              }

            }
          });


        }
      })

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }
  });

  $('.btnAddDevolucion').on('click', function (e) {



    let $idSalida = $(".idSalida").val()

    //console.log(id);
    e.preventDefault();
    Swal.fire({
      title: '¿Deseas Registrar?',
      text: "Tenga en cuenta que esta generando una Devolución en el inventario",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        //  pagar();
        var tipo = 1;
        var accion = 15;
        var datos = 1;
        $.ajax({
          url: '../admin/index.php?action=articulos',
          type: 'post',
          data: { tipo: tipo, accion: accion, datos: datos, idSalida: $idSalida },
          success: function (response) {
            //alert(response);
            if (response == '1') {
              Swal.fire({
                icon: 'success',
                text: 'Registro de Devolución registrado con éxito.'
              }),

                window.location = 'index.php?view=salidas';
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al Registrar la Devolución.'
              })
            }

          }
        });


      }
    })

  });





  ///////////////////////////////////////////////////
  $('.btnBuscarPersonal').on('click', function () {
    var $nacionalidad = $('#cmbPersonaNacionalidad').val();
    var $cedula = $('#txtAddPersonaCedula').val();
    if (($nacionalidad != "0") &&  ($cedula != "")) {
      var $documento = $nacionalidad + $cedula;
      var tipo = 1;
      var accion = 6;
      var datos = 1;

      $.ajax({
        url: '../admin/index.php?action=personal',
        type: 'POST',
        data: { documento: $documento, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {
          // alert(response);
          var i = 0;
          var tope = response.length;

          if (tope >= 1) {
            var contenido = "";
            for (var i = 0; i < tope; i++) {

              if (response[i].id == 'no') {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'El numero de cedula que intenta registrar, ya esta asociado a otra persona'

                });
                //$('#nacionalidad-cliente').focus();
              } else {

                contenido += '<p id="' + response[i].id + '">Contrato N° <a href="index.php?view=tipo&id=' + response[i].id + '">: ' + response[i].contrato + '</a></p>';

                $('#datosAsociados').html(contenido);
                $('.modalAddPersonal').modal('hide');
                $('#modalBuscarPersonal').modal('show');
              }


            }


          }
          if (tope == 0) {

            $("#datos").attr("style", "display:");
            // $("#datos").css({'display':''});
          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Debes seleccionar el tipo de documento que vas a registrar!'

      });
      //$('#nacionalidad-cliente').focus();

    }
    // alert("Pulsaste la tecla dentro del campo de texto con código: "+e.which);

  });

  $('.btnBuscarCliente').on('click', function () {
    var $nacionalidad = $('#cmbClienteNacionalidad').val();
    var $cedula = $('#txtAddClienteCedula').val();
    if (($nacionalidad != "0") &&  ($cedula != "")) {
      var $documento = $nacionalidad + $cedula;
      var tipo = 1;
      var accion = 6;
      var datos = 1;

      $.ajax({
        url: '../admin/index.php?action=clientes',
        type: 'POST',
        data: { documento: $documento, tipo: tipo, accion: accion, datos: datos },
        success: function (response) {
          // alert(response);
          var i = 0;
          var tope = response.length;

          if (tope >= 1) {
            var contenido = "";
            for (var i = 0; i < tope; i++) {

              if (response[i].id == 'no') {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'El numero de cedula que intenta registrar, ya esta asociado a otra persona'

                });
                //$('#nacionalidad-cliente').focus();
              } else {

                contenido += '<p id="' + response[i].id + '">Contrato N° <a href="index.php?view=tipo&id=' + response[i].id + '">: ' + response[i].contrato + '</a></p>';

                $('#datosAsociados').html(contenido);
                $('.modalAddPersonal').modal('hide');
                $('#modalBuscarPersonal').modal('show');
              }


            }


          }
          if (tope == 0) {

            $("#datos").attr("style", "display:");
            // $("#datos").css({'display':''});
          }


        }
      });


    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Debes seleccionar el tipo de documento que vas a registrar!'

      });
      //$('#nacionalidad-cliente').focus();

    }
    // alert("Pulsaste la tecla dentro del campo de texto con código: "+e.which);

  });


  $('.btnAddPersonal').on('click', function (e) {
    let nacionalidad = $('.cmbPersonaNacionalidad').val(),
      txtAddPersonaCedula = $('.txtAddPersonaCedula').val(),
      txtAddPersonaNombreCompleto = $('.txtAddPersonaNombreCompleto').val(),
      cmbPersonaGenero = $('.cmbPersonaGenero').val(),
      txtAddPersonaTelefono = $('.txtAddPersonaTelefono').val(),

      txtAddPersonaCorreo = $('.txtAddPersonaCorreo').val(),
      cmbAddPersona_idParroquia = $('.cmbAddPersona_idParroquia').val(),
      cmbAddPersona_idCargo = $('.cmbAddPersona_idCargo').val(),
      textAreaAddPersonaDireccion = $('.textAreaAddPersonaDireccion').val();

    if ((nacionalidad != '') && (txtAddPersonaCedula != '') && (txtAddPersonaNombreCompleto != '') && (txtAddPersonaTelefono != '')
       && (txtAddPersonaCorreo != '') && (cmbAddPersona_idParroquia != '0') && (cmbPersonaGenero != '0') && (textAreaAddPersonaDireccion != '')  && (cmbAddPersona_idCargo != '0')) {
      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=personal',
        type: 'POST',
        data: {
          cedula: nacionalidad + txtAddPersonaCedula, genero: cmbPersonaGenero, nombreCompleto: txtAddPersonaNombreCompleto, telefono: txtAddPersonaTelefono, correo: txtAddPersonaCorreo,
          idParroquia: cmbAddPersona_idParroquia, direccion: textAreaAddPersonaDireccion,idCargo:cmbAddPersona_idCargo, tipo: tipo, accion: accion, datos: datos
        },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se han registrado los datos del Personal correctamente'
            }),
          
              
            $('.modalAddPersonal').modal('hide')
            $("#cmbPersonaNacionalidad option[value=0]").attr("selected",true)

            $('.txtAddPersonaCedula').val('')
            $('.txtAddPersonaNombreCompleto').val('')
            $("#cmbPersonaGenero option[value=0]").attr("selected",true)
         
            $('.txtAddPersonaTelefono').val('')
            $('.txtAddPersonaCorreo').val('')
          
            $('.textAreaAddPersonaDireccion').val('');
  
            $("#cmbAddPersona_idEstado option[value=0]").attr("selected",true)
            $("#cmbAddPersona_idMunicipio option[value=0]").attr("selected",true)
            $("#cmbAddPersona_idParroquia option[value=0]").attr("selected",true)

            $("#cmbAddPersona_idCargo option[value=0]").attr("selected",true)
            $("#datos").attr("style", "display: none;");

            cargarDataPersonal('NO');
           // window.location ='index.php?view=dashboard';
          }


        }
      });

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }

  });
  $('.btnEditPersonal').on('click', function (e) {
    let idPersonal = $('.idPersona').val(),
      txtEditPersonaNombreCompleto = $('.txtEditPersonaNombreCompleto').val(),
      cmbEditPersonaGenero = $('.cmbEditPersonaGenero').val(),
      txtEditPersonaTelefono = $('.txtEditPersonaTelefono').val(),
      txtEditPersonaFechaNacimiento = $('.txtEditPersonaFechaNacimiento').val(),
      txtEditPersonaCorreo = $('.txtEditPersonaCorreo').val(),
      cmbEditPersona_idParroquia = $('.cmbEditPersona_idParroquia').val(),
      textAreaEditPersonaDireccion = $('.textAreaEditPersonaDireccion').val();
    if ((txtEditPersonaNombreCompleto != '') && (txtEditPersonaTelefono != '') && (txtEditPersonaFechaNacimiento != '') && (txtEditPersonaCorreo != '') && (cmbEditPersona_idParroquia != '0') && (cmbEditPersonaGenero != '0') && (textAreaEditPersonaDireccion != '')) {
      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=personal',
        type: 'POST',
        data: {
          idPersonal: idPersonal, nombreCompleto: txtEditPersonaNombreCompleto, genero: cmbEditPersonaGenero, telefono: txtEditPersonaTelefono, correo: txtEditPersonaCorreo,
          idParroquia: cmbEditPersona_idParroquia, direccion: textAreaEditPersonaDireccion,
          fechaNacimiento: txtEditPersonaFechaNacimiento, tipo: tipo, accion: accion, datos: datos
        },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se han editado los datos  Personales correctamente'
            }),

              $('.modalEditPersonal').modal('hide');

              

            cargarDataPersona(idPersonal);

          }


        }
      });

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }

  });

  $('.btnAddCliente').on('click', function (e) {
    let nacionalidad = $('.cmbClienteNacionalidad').val(),
    txtAddClienteCedula = $('.txtAddClienteCedula').val(),
    txtAddClienteNombreCompleto = $('.txtAddClienteNombreCompleto').val(),
    cmbClienteGenero = $('.cmbClienteGenero').val(),
    txtAddClienteTelefono = $('.txtAddClienteTelefono').val(),

    txtAddClienteCorreo = $('.txtAddClienteCorreo').val(),
    cmbAddCliente_idParroquia = $('.cmbAddCliente_idParroquia').val(),     
    textAreaAddClienteDireccion = $('.textAreaAddClienteDireccion').val();

    if ((nacionalidad != '') && (txtAddClienteCedula != '') && (txtAddClienteNombreCompleto != '') && (cmbClienteGenero != '0')
       && (txtAddClienteTelefono != '') && (txtAddClienteTelefono != '') && (txtAddClienteCorreo != '') && (cmbAddCliente_idParroquia != '0') && (textAreaAddClienteDireccion != '')) {
      var tipo = 1;
      var accion = 1;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=clientes',
        type: 'POST',
        data: {
          cedula: nacionalidad + txtAddClienteCedula, genero: cmbClienteGenero, nombreCompleto: txtAddClienteNombreCompleto, telefono: txtAddClienteTelefono, correo: txtAddClienteCorreo,
          idParroquia: cmbAddCliente_idParroquia, direccion: textAreaAddClienteDireccion, tipo: tipo, accion: accion, datos: datos
        },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se han registrado los datos del cliente correctamente'
            }),
    
                $('.modalAddCliente').modal('hide')
                $("#cmbClienteNacionalidad option[value=0]").attr("selected",true)

                $('.txtAddClienteCedula').val('')
                $('.txtAddClienteNombreCompleto').val('')
                $("#cmbClienteGenero option[value=0]").attr("selected",true)
             
                $('.txtAddClienteTelefono').val('')
                $('.txtAddClienteCorreo').val('')
              
                $('.textAreaAddClienteDireccion').val('');
      
                $("#cmbAddCliente_idEstado option[value=0]").attr("selected",true)
                $("#cmbAddCliente_idMunicipio option[value=0]").attr("selected",true)
                $("#cmbAddCliente_idParroquia option[value=0]").attr("selected",true)
             
                if ($('.cmbAddVehiculo_idCliente').length) {
                  $('.cmbAddVehiculo_idCliente').empty();


                  cargarClientes('.cmbAddVehiculo_idCliente', 0);
                }

                if ($('.cmbAddOrden_idCliente').length) {
                  $('.cmbAddOrden_idCliente').empty();
                  cargarClientes('.cmbAddOrden_idCliente', 0);
                }

                cargarDataClientes('NO');
           // window.location ='index.php?view=dashboard';
          }

          if(response =='2'){
           /* Swal.fire({
              title: "<strong>HTML <u>example</u></strong>",
              icon: "info",
              html: `
                You can use <b>bold text</b>,
                <a href="#" autofocus>links</a>,
                and other HTML tags
              `,
              showCloseButton: true,
              showCancelButton: true,
              focusConfirm: false,
              confirmButtonText: `
                <i class="fa fa-thumbs-up"></i> Great!
              `,
              confirmButtonAriaLabel: "Thumbs up, great!",
              cancelButtonText: `
                <i class="fa fa-thumbs-down"></i>
              `,
              cancelButtonAriaLabel: "Thumbs down"
            });
            */
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              html: `
              El número de cedula que esta intentando registrar, ya pertenece a otro cliente <br>
               <b>Siga el link para verficarlo</b><br>,
              <a href="index.php?view=cliente&d=`+nacionalidad + txtAddClienteCedula+`" autofocus>`+nacionalidad + txtAddClienteCedula+`</a>,`
            
            })
          }

        }
      });

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }

  });
  $('.btnEditPersonal').on('click', function (e) {
    let idPersonal = $('.idPersona').val(),
      txtEditPersonaNombreCompleto = $('.txtEditPersonaNombreCompleto').val(),
      cmbEditPersonaGenero = $('.cmbEditPersonaGenero').val(),
      txtEditPersonaTelefono = $('.txtEditPersonaTelefono').val(),
      txtEditPersonaFechaNacimiento = $('.txtEditPersonaFechaNacimiento').val(),
      txtEditPersonaCorreo = $('.txtEditPersonaCorreo').val(),
      cmbEditPersona_idParroquia = $('.cmbEditPersona_idParroquia').val(),
      textAreaEditPersonaDireccion = $('.textAreaEditPersonaDireccion').val();
    if ((txtEditPersonaNombreCompleto != '') && (txtEditPersonaTelefono != '') && (txtEditPersonaFechaNacimiento != '') && (txtEditPersonaCorreo != '') && (cmbEditPersona_idParroquia != '0') && (cmbEditPersonaGenero != '0') && (textAreaEditPersonaDireccion != '')) {
      var tipo = 1;
      var accion = 3;
      var datos = 1;
      $.ajax({
        url: '../admin/index.php?action=personal',
        type: 'POST',
        data: {
          idPersonal: idPersonal, nombreCompleto: txtEditPersonaNombreCompleto, genero: cmbEditPersonaGenero, telefono: txtEditPersonaTelefono, correo: txtEditPersonaCorreo,
          idParroquia: cmbEditPersona_idParroquia, direccion: textAreaEditPersonaDireccion,
          fechaNacimiento: txtEditPersonaFechaNacimiento, tipo: tipo, accion: accion, datos: datos
        },
        success: function (response) {

          if (response == '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se han editado los datos  Personales correctamente'
            }),

              $('.modalEditPersonal').modal('hide');

            cargarDataPersona(idPersonal);

          }


        }
      });

    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })
    }

  });



$('.addIngreso').on('click', function (e) {

  var $idItem = $('.idItem').val(),
      $note = $('.note').val() ,
      $fechaIngreso = $('.fechaIngreso').val(),     
      $fechaSalida = $('.fechaSalida').val(); 

    let detallesItem = $('#source-item').repeaterVal();  
    var imagenesInput  = $('#imagenesItem').prop('files');

     if (($note != '') && ($fechaIngreso != '') && ($fechaSalida != '') && (imagenesInput.length != 0)) {   

     const datos = {
      arreglo1: JSON.stringify(detallesItem), 
      otrosDatos: {
          idItem: $idItem,
          note: $note,
          fechaIngreso: $fechaIngreso,
          fechaSalida: $fechaSalida      
      }
    };
   const formData = new FormData();
// Convertir objeto a FormData
    Object.entries(datos).forEach(([key, value]) => {
        if (Array.isArray(value)) {
            value.forEach((item, index) => {
                formData.append(`${key}[${index}]`, item);
            });
        } else if (typeof value === 'object') {
            Object.entries(value).forEach(([subKey, subValue]) => {
                formData.append(`${key}[${subKey}]`, subValue);
            });
        } else {
            formData.append(key, value);
        }
    });
     $.each(imagenesInput, function(i, imagen) {
   
        formData.append('imagenesItem[]', imagen);
    });



    /*if (detallesItem.length == 0) {
        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No ha elegido ningun componente perteneciente al item!'

              })
      }else{ */
     
      $.ajax({
        url: '../admin/index.php?action=items&note='+$note+'&fechaSalida='+$fechaSalida+'&fechaIngreso='+$fechaIngreso+'&note = '+$note+'&idItem=' + $idItem + '&tipo=1&accion=1&datos=4',
        type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function() {
              let timerInterval
                      Swal.fire({
                        title: 'Subiendo',
                        html: 'Guardando ingreso de item.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                          Swal.showLoading();
                   
                        },
                        willClose: () => {
                          clearInterval(timerInterval)
                        }
                      }).then((result) => {
                        /* Read more about handling dismissals below */
                        
                      })
         },
        success: function (response) {

          if (response >= '1') {
            Swal.fire({
              icon: 'success',
              title: 'Bien',
              text: 'Se ha Guardado correctamente'
            }),
              // window.location = 'index.php?view=ordenes&id='+response;
              window.location = 'index.php?view=ordenesTrabajo&filtro=0';
              

          }
          if (response == 2) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El CODIGO que desea registrar, ya esta asociado a otro registro!'

            })
            // console.log(response)

          }

          }
        
      });

      }else{

      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Existe un error en los datos suministrados, verifiquelos e intente nuevamente!'

      })    
      }

});



 $('.btnAsignarPersonalUbicacion').on('click', function (e) {

    let $idPersonal = $(".cmbAddOrden_idPersonal").val();
    let $personal = $('#cmbAddOrden_idPersonal option:selected').text();
     let $placa = $('#lblCodigoItem').text();
    
    let $idOrden = $(".idOrden").val();
    let $idUbicacion= $(".cmbAddOrden_idUbicacion").val();
    let $ubicacion = $('#cmbAddOrden_idUbicacion option:selected').text();
  if  (($idPersonal!=0) && ($idUbicacion!=0)){


    e.preventDefault();
        Swal.fire({
          title: '¿Deseas asignar?',
          html:
          'Tenga en cuenta que esta generando una asignacion de orden de trabajo con los siguientes datos <br> ' +
          'Personal encargado<br><b>' + $personal + '</b> <br>'+ 
          'Ubicacion seleccionada <br><b>' + $ubicacion + '</b> <br>',         
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.isConfirmed) {
            //  pagar();
            var tipo = 1;
            var accion = 7;
            var datos = 1;
            $.ajax({
              url: '../admin/index.php?action=items',            
              type: 'post',
              data: { tipo: tipo, accion: accion, datos: datos, idOrden: $idOrden,placa:$placa,
              idPersonal: $idPersonal,idUbicacion : $idUbicacion },
              success: function (response) {
                //alert(response);
                if (response == '1') {
                  Swal.fire({
                    icon: 'success',
                    text: 'Registro asignacion de personal y ubicación registrado con éxito.'
                  }),

                    window.location = 'index.php?view=orden&id='+$idOrden;
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un error al Registrar la asignacion.'
                  })
                }

              }
            });


          }
        })

  }else{
              Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe elegir correctamente el personal a cargo de la reparación y la ubicación del equipo.'
                  })


  }


  });

  $('.btnCerrarOrden').on('click', function () {

   // var $nacionalidad = $('#cmbClienteNacionalidad').val();
   // var $cedula = $('#txtAddClienteCedula').val();
 
         $('#modalCerrarOrden').modal('show');

  

    
    // alert("Pulsaste la tecla dentro del campo de texto con código: "+e.which);

  });

  
  $('.btnCerrarOrdenTrabajo').on('click', function (e) {  


      let $placa = $('#lblCodigoItem').text();    
      let $nombrecompleto = $('#lblNameCliente').text();    
      let $idOrden = $(".idOrden").val();   

  let $tipoM = $(".cmbTipoMantenimiento").val();  
  let $tiempo = $(".txtTempoMantenimiento").val(); 
  let $procedimiento = $(".txtDescripcionProcedimiento").val(); 
  let $fechaProximo = $(".txtFechaProximo").val();        
  let $recomendacion = $(".txtRecomendacion").val();  
  let $fechaMantenimiento = $(".txtFechaMantenimiento").val();  

  if  (($tipoM!=0) && ($tiempo!='') && ($procedimiento!='') && ($fechaProximo!='') && ($recomendacion!='') && ($fechaMantenimiento!='')){
   
   e.preventDefault();
        Swal.fire({
          title: '¿Deseas cerrar ordden de trabajo?',
          html:
          'Tenga en cuenta que esta CERRANDO LA ORDEN DE TRABAJO del eqiupo <br> ' +
          'Cliente <br><b>' + $nombrecompleto + '</b> <br>'+ 
          'Equipo reparado <br><b>' + $placa + '</b> <br>',         
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.isConfirmed) {
            //  pagar();
            var tipo = 1;
            var accion = 88;
            var datos = 1;
            $.ajax({
              url: '../admin/index.php?action=items',            
              type: 'post',
              data: { fechaMantenimiento:$fechaMantenimiento,tipoM:$tipoM,tiempo:$tiempo,procedimiento:$procedimiento,fechaProximo:$fechaProximo,recomendacion:$recomendacion,
                tipo: tipo, accion: accion, datos: datos, idOrden: $idOrden,placa:$placa},
              success: function (response) {
                //alert(response);
                if (response == '1') {
                  Swal.fire({
                    icon: 'success',
                    text: 'Registro asignacion de personal y ubicación registrado con éxito.'
                  }),

                    window.location = 'index.php?view=orden&id='+$idOrden;
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un error al Registrar la asignacion.'
                  })
                }

              }
            });


          }
        })

        }else{
              Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Existe un error en los datos suministrados, por favor verifique e intente nuevamente.'
                  })


  }


  });




  
  $('#btnEliminarOrden').on('click', function (e) {
      let $id = $(".idOrden").val();
       let $codigo = $(".codigoOrden").val();
    e.preventDefault();
    //console.log(Swal.version);
    Swal.fire({
      title: 'Deseas eliminar?',
      text: "Tenga en cuenta que eliminara completamente todos los datos pertenecientes a esta orden de trabajo.!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        let timerInterval
        Swal.fire({
          title: 'Eliminando ...!',
          html: '...................',
          timer: 3000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
              
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            //console.log('I was closed by the timer')
          }
        })
        //  pagar();
        eliminarOrdenTrabajo($id,$codigo);
      }
    })
  });

});





// FUNCIONES PARA LOS DATATABLES
function cargarDataUsers() {
  if ($('#dataUsers').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=combos&c=UserData&a=1&t=user',
    }).done(function (bancos) {
      var cadena = JSON.stringify(bancos);
      $('.dataUsers').attr("value", cadena);
      cargarTablaUsers();

    });
  }
}



function cargarDataCargos($filtro) {
  if ($('#data').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=cargos&tipo=1&accion=2&datos=1&c=CargoData&a=1&t=cargo',
    }).done(function (data) {

      cargarTablaCargos(data);

    });
  }
}

function cargarDataTipos($filtro) {
  if ($('#dataTipos').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=tipos&tipo=1&accion=2&datos=1&c=TipoData&a=1&t=tipo',
    }).done(function (data) {
      cargarTablaTipos(data);

    });
  }
}

function cargarDataModelos($filtro) {
  if ($('#dataModelos').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=modelos&tipo=1&accion=2&datos=1&c=ModeloData&a=1&t=modelo',
    }).done(function (data) {
      cargarTablaModelos(data);

    });
  }
}


function cargarDataUbicaciones($filtro) {
  if ($('#data').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=ubicaciones&tipo=1&accion=2&datos=1&c=UbicacionData&a=1&t=ubicacion',
    }).done(function (data) {

      cargarTablaUbicaciones(data);

    });
  }
}



function cargarDataMarcas($filtro) {
  if ($('#dataMarcas').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=marcas&tipo=1&accion=2&datos=1&c=MarcaData&a=1&t=marca',
    }).done(function (data) {

      cargarTablaMarcas(data);

    });
  }
}



function cargarDataPersonal($filtro) {
  if ($('#dataPersonal').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=personal&tipo=1&accion=2&datos=2&c=PersonalData&a=1&t=personal',
    }).done(function (data) {

      cargarTablaPersonal(data);

    });
  }
}


function cargarDataClientes($filtro) {
  if ($('#dataClientes').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=clientes&tipo=1&accion=2&datos=2&c=PersonalData&a=1&t=clientes',
    }).done(function (data) {

      cargarTablaClientes(data);

    });
  }
}

function cargarDataItems($filtro) {
  if ($('#dataVehiculos').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=items&tipo=1&accion=2&datos=2&c=ItemData&a=1&t=item',
    }).done(function (data) {

      cargarTablaItems(data);

    });
  }
}

function cargarDataAsignaciones($filtro) {
  if ($('#dataVehiculoAsignaciones').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=vehiculos&tipo=1&accion=2&datos=5&c=ItemData&a=1&t=vehiculo&d=' + $filtro,
    }).done(function (data) {

      cargarTablaAsignaciones(data);

    });
  }
}

function cargarDataOrdenes($filtro, $estatus) {
  if ($('#buscarDataOrdenes').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=items&tipo=1&accion=2&datos=7&c=ItemData&a=1&t=vehiculo&d=' + $filtro + '&s=' + $estatus,
    }).done(function (data) {

      cargarTablaOrdenes(data);

    });
  }
}

function cargarDataOrdenesTrabajo($filtro) {
  if ($('#dataOrdenesTrabajo').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=items&tipo=1&accion=2&datos=6&c=ItemData&a=1&t=item&d=' + $filtro,
    }).done(function (data) {
      //console.log(data);
      cargarTablaOrdenesTrabajos(data);

    });
  }
}


function cargarDataDashboardOrdenes($filtro) {
  if ($('#dataDasboardOrdenes').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=items&tipo=1&accion=2&datos=6&c=ItemData&a=1&t=item&d=' + $filtro,
    }).done(function (data) {
      //console.log(data);
      cargarTablaDashboardOrdenes(data);

    });
  }
}




function cargarDataArticulos($filtro) {
  if ($('#dataArticulos').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=articulos&tipo=1&accion=2&datos=1&c=ArticuloData&a=1&t=articulo',
    }).done(function (data) {

      cargarTablaArticulos(data);

    });
  }
}
function cargarDataArticulosEntradas($filtro) {
  if ($('#dataArticulosEntradas').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=articulos&tipo=1&accion=2&datos=5&c=ArticuloData&a=1&t=entrada',
    }).done(function (data) {

      cargarTablaArticulosEntradas(data);

    });
  }
}
function cargarDataArticulosSalidas($filtro) {
  if ($('#dataArticulosSalidas').length) {
    $.ajax({
      type: "GET",
      url: '../admin/index.php?action=articulos&tipo=1&accion=2&datos=6&c=ArticuloData&a=1&t=salida&filtro=' + $filtro,
    }).done(function (data) {

      cargarTablaArticulosSalidas(data);

    });
  }
}
// FUNCIONES PARA LOS DATATABLES
///////////////////////////////////////////////////////////////// FUNCIONES PARA ABRIR MODALES Y BOTONES DE EDITAR/////////////////////////////



function editarCargo($id) {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=cargos&tipo=1&accion=2&datos=2&c=CargoData&a=1&t=cargo&d=' + $id,
  }).done(function (cargo) {
    //console.log(redi);
    var i = 0;
    var tope = cargo.length;
    for (var i = 0; i < tope; i++) {
      cargo = cargo[i].cargo;
      $('.frmEditCargo .txtEditCargo').val(cargo),
        $('.frmEditCargo .txtEditIdCargo').val($id)
    }

    $(".modalEditCargo").modal("show");
  });

}
function editarTipo($id) {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=tipos&tipo=1&accion=2&datos=2&c=TipoData&a=1&t=tipo&d=' + $id,
  }).done(function (tipo) {
    // console.log(tipo);
    var i = 0;
    var tope = tipo.length;
    var caracteristica = '0';
    var tipos = '';
    for (var i = 0; i < tope; i++) {
      tipos = tipo[i].tipo;
      caracteristica = tipo[i].condicion;
      console.log(caracteristica);
      $('.frmEditTipo .txtEditTipo').val(tipos),
        $('.frmEditTipo .txtEditIdTipo').val($id)
      if (caracteristica == '1') {
        $('.cmbEditTipoCondicion> option[value="1"]').attr('selected', 'selected');
      } else {
        $('.cmbEditTipoCondicion> option[value="2"]').attr('selected', 'selected');
      }
      // $('.frmEditTipo .txtEditIdTipo').val($id)
    }

    $(".modalEditTipo").modal("show");
  });

}
function editarMarca($id) {
  $('#cmbEditMarca_idTipo').empty();
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=marcas&tipo=1&accion=2&datos=2&c=MarcaData&a=1&t=marca&d=' + $id,
  }).done(function (marca) {
    console.log(marca);
    var i = 0;
    var tope = marca.length;
    var caracteristica = '0';
    var tipos = '';
    for (var i = 0; i < tope; i++) {
      marcas = marca[i].marca;
      caracteristica = marca[i].condicion;
      //console.log(caracteristica);  
      $('.frmEditMarca .txtEditMarca').val(marcas),
        $('.frmEditMarca .txtEditIdMarca').val($id)
      if (caracteristica == '1') {
        $('.cmbEditMarcaCondicion> option[value="1"]').attr('selected', 'selected');
      } else {
        $('.cmbEditMarcaCondicion> option[value="2"]').attr('selected', 'selected');
      }
      $('.cmbEditMarca_idTipo').append('<option selected value = ' + marca[i].idTipo + '>' + marca[i].tipo + '</option>');
      // $('.frmEditTipo .txtEditIdTipo').val($id)
    }

    $(".modalEditMarca").modal("show");
  });

}

function editarModelo($id) {
  $('#cmbEditModelo_idTipo').empty();
  $('#cmbEditModelo_idMarca').empty();

  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=modelos&tipo=1&accion=2&datos=2&c=ModeloData&a=1&t=modelo&d=' + $id,
  }).done(function (modelo) {
    console.log(modelo);
    var i = 0;
    var tope = modelo.length;
    var caracteristica = '0';
    var modelos = '';
    for (var i = 0; i < tope; i++) {
      modelos = modelo[i].modelo;
      caracteristica = modelo[i].condicion;
      //console.log(caracteristica);  
      $('.frmEditModelo .txtEditModelo').val(modelos),
        $('.frmEditModelo .txtEditIdModelo').val($id)
      if (caracteristica == '1') {
        $('.cmbEditModeloCondicion> option[value="1"]').attr('selected', 'selected');
      } else {
        $('.cmbEditModeloCondicion> option[value="2"]').attr('selected', 'selected');
      }
      $('.cmbEditModelo_idTipo').append('<option selected value = ' + modelo[i].idTipo + '>' + modelo[i].tipo + '</option>');
      $('.cmbEditModelo_idMarca').append('<option selected value = ' + modelo[i].idMarca + '>' + modelo[i].marca + '</option>');
      // $('.frmEditTipo .txtEditIdTipo').val($id)
    }

    $(".modalEditModelo").modal("show");
  });

}

function editarUbicacion($id) {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=ubicaciones&tipo=1&accion=2&datos=2&c=UbicacionData&a=1&t=ubicacion&d=' + $id,
  }).done(function (ubicacion) {
    console.log(ubicacion);
    var i = 0;
    var tope = ubicacion.length;
    for (var i = 0; i < tope; i++) {
      lugar = ubicacion[i].ubicacion;
      descripcion = ubicacion[i].descripcion;
      $('.frmEditUbicacion .txtEditUbicacion').val(lugar),
        $('.frmEditUbicacion .txtEditDescripcion').val(descripcion),
        $('.frmEditUbicacion .txtEditIdUbicacion').val($id)
    }

    $(".modalEditUbicacion").modal("show");
  });

}

function editarArticulo($id) {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=articulos&tipo=1&accion=2&datos=9&c=ArticuloData&a=1&t=articulo&d=' + $id,
  }).done(function (articulo) {
    // console.log(articulo);
    var i = 0;
    var tope = articulo.length;
    var idUnidadMedida = 0;

    for (var i = 0; i < tope; i++) {

      idUnidadMedida = articulo[i].idUnidadMedida;
      $('.cmbEditArticulo_idTipo').append('<option selected value = ' + articulo[i].idTipo + '>' + articulo[i].tipo + '</option>');
      $('.cmbEditArticulo_idMarca').append('<option selected value = ' + articulo[i].idMarca + '>' + articulo[i].marca + '</option>');
      $('.cmbEditArticulo_idModelo').append('<option selected value = ' + articulo[i].idModelo + '>' + articulo[i].modelo + '</option>');

      $('.frmEditArticulo .txtEditArticuloId').val($id),
        $('.frmEditArticulo .txtEditArticuloNombre').val(articulo[i].nombre),
        $('.frmEditArticulo .textAreaEditArticuloDescripcion').html(articulo[i].descripcion)
      switch (idUnidadMedida) {
        case "1":
          $('.cmbEditArticuloMedida> option[value="1"]').attr('selected', 'selected');
          break;
        case "2":
          $('.cmbEditArticuloMedida> option[value="2"]').attr('selected', 'selected');
          break;
        case "3":
          $('.cmbEditArticuloMedida> option[value="3"]').attr('selected', 'selected');
          break;
        case "4":
          $('.cmbEditArticuloMedida> option[value="4"]').attr('selected', 'selected');
          break;
        case "5":
          $('.cmbEditArticuloMedida> option[value="5"]').attr('selected', 'selected');
          break;
        case "6":
          $('.cmbEditArticuloMedida> option[value="6"]').attr('selected', 'selected');
          break;
        case "7":
          $('.cmbEditArticuloMedida> option[value="7"]').attr('selected', 'selected');
          break;
      }


    }

    $(".modalEditArticulo").modal("show");
  });

}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function cargarDataVehiculo($id) {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=items&tipo=1&accion=2&datos=3&c=ItemData&a=1&t=item&d=' + $id,
  }).done(function (vehiculo) {
    // console.log(vehiculo);
    var i = 0;
    var tope = vehiculo.length;
    if (tope == 1) {

      for (var i = 0; i < tope; i++) {
        var placa = vehiculo[i].placa,
          marca = vehiculo[i].marca,
          modelo = vehiculo[i].modelo,
          color = vehiculo[i].color,
          ano = vehiculo[i].ano,
          condicion = vehiculo[i].condicion,
          media = vehiculo[i].media,
          tipo = vehiculo[i].tipo;

    

        if (condicion == '1') {
          $('.dataVehiculo_condicion').html('OPERATIVO');

        } else {
          $('.dataVehiculo_condicion').html('INOPERATIVO');
        }

        $('.dataVehiculo_imagen').prop('src', media);
        $('.dataVehiculo_placa').html(placa);
        $('.dataVehiculo_placa2').html(placa);
        $('.dataVehiculo_tipo').html(tipo);
        $('.dataVehiculo_tipo2').html(tipo);
        $('.dataVehiculo_marca').html(marca);
        $('.dataVehiculo_modelo').html(modelo);
        $('.dataVehiculo_color').html(color);
        $('.dataVehiculo_ano').html(ano);
     

      }
    }



  });

}
function editarVehiculo($id) {

  //console.log($id);

  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=items&tipo=1&accion=2&datos=3&c=ItemData&a=1&t=item&d=' + $id,
  }).done(function (data) {
    console.log(data);
    var i = 0;
    var tope = data.length;
    if (tope == 1) {

      for (var i = 0; i < tope; i++) {
        var placa = data[i].placa,
          marca = data[i].marca,
          modelo = data[i].modelo,
          color = data[i].color,
          ano = data[i].ano,
          condicion = data[i].condicion,
          media = data[i].media,
          tipo = data[i].tipo;
        idTipo = data[i].idTipo;
        idMarca = data[i].idMarca;
        idModelo = data[i].idModelo;
       
        serialChasis = data[i].serialChasis;

        if (condicion == '1') {
          $('.cmbEditVehiculoCondicion> option[value="1"]').attr('selected', 'selected');
        } else {
          $('.cmbEditVehiculoCondicion> option[value="2"]').attr('selected', 'selected');
        }

        $('.cmbEditVehiculo_idTipo').append('<option selected value = ' + idTipo + '>' + tipo + '</option>');

        $('.cmbEditVehiculo_idMarca').append('<option selected value = ' + idMarca + '>' + marca + '</option>');
        $('.cmbEditVehiculo_idModelo').append('<option selected value = ' + idModelo + '>' + modelo + '</option>');

        $('.txtEditVehiculoPlaca').val(placa);
        $('.txtEditVehiculoAno').val(ano);
        $('.txtEditVehiculoColor').val(color);
        $('.txtEditVehiculoSerialChasis').val(serialChasis);
       

      }
    }
    $(".modalDatosVehiculo").modal("show");


  });

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
function addArticuloEntrada(idArticulo, nombre, cantidad, precio) {

  if ((cantidad == 0) || (idArticulo == 0) || (precio == 0.00)) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Debes elegir o escribir el numero de articulos que deseas pedir!'

    })

  } else {

    var tipo = 1;
    var accion = 6;
    var datos = 1;
    $.ajax({
      url: '../admin/index.php?action=articulos',
      type: 'POST',
      data: { precio: precio, cantidad: cantidad, idArticulo: idArticulo, nombre: nombre, tipo: tipo, accion: accion, datos: datos },
      success: function (response) {

        if (response == 1) {
          toastr['success']('', 'Articulo agregado 🛒', {
            closeButton: true,
            positionClass: 'toast-top-right',
            tapToDismiss: false
          });
          $('.txtAddEntradaCantidad').val('0');
          $('.modalArticulo').modal('hide');
          $('.tableAddArticulosEntrada').empty();
          cargarDataCarrito();

        }


      }
    });

  }





}

function addArticuloSalida(idArticulo, nombre, cantidad, precio) {

  if ((cantidad == 0) || (idArticulo == 0)) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Debes elegir o escribir el numero de articulos que deseas darle Salida!'

    })

  } else {

    var tipo = 1;
    var accion = 13;
    var datos = 1;
    $.ajax({
      url: '../admin/index.php?action=articulos',
      type: 'POST',
      data: { precio: precio, cantidad: cantidad, idArticulo: idArticulo, nombre: nombre, tipo: tipo, accion: accion, datos: datos },
      success: function (response) {

        if (response == 1) {
          toastr['success']('', 'Articulo agregado 🛒', {
            closeButton: true,
            positionClass: 'toast-top-right',
            tapToDismiss: false
          });
          $('.txtAddEntradaCantidad').val('0');
          $('.modalArticulo').modal('hide');
          $('.tableAddArticulosSalida').empty();
          cargarDataCarritoSalida();

        }
        if (response == 2) {

          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No puedes darle salida a este articulo, ya que no cuenta con exitencia dentro del inventario!'

          })
          $('.txtAddEntradaCantidad').val('0');
        }


      }
    });

  }





}

function cargarDataCarrito() {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=articulos&&clase=CarritoData&t=carrtito&tipo=1&accion=7&datos=1',
  }).done(function (data) {
    //console.log(data)
    var i = 0;
    var tope = data.length;
    //console.log(tope)
    var contenido = ""
    var art_des = "";
    var rowid = "";
    var qty = "";

    //console.log(tope);
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {
        nombre = data[i].nombre;
        rowid = data[i].rowid;
        cantidad = data[i].cantidad;
        idArticulo = data[i].idArticulo;
        precio = data[i].precio;

        contenido = `<div class="row">
    <div class="col-12 d-flex product-details-border position-relative pe-0">
        <div class="row w-100 pe-lg-0 pe-1 py-2">
            <div class="col-lg-6 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                <p class="card-text mb-0">${nombre}</p>
                <input type="hidden" id="${rowid}" value ="${rowid}">
            </div>
            <div class="col-lg-2 col-12 my-lg-0 my-2">
                <input type="number" class="form-control ${idArticulo} ${rowid}"  id="${idArticulo}" name="${idArticulo}"  value="${cantidad}" placeholder="1"/>
            </div>
            <div class="col-lg-2 col-12 my-lg-0 my-2">              
            <input type="number" class="form-control ${idArticulo}precio ${rowid}"  id="${idArticulo}precio" name="${idArticulo}precio"  value="${precio}" placeholder="1"/>
            </div>
            <div class="col-lg-2 col-12 my-lg-0 my-2">
              
            <button type="button" class="btn btn-danger btn-sm  w-100 mb-75 "id="removeCard${rowid}" onClick="remover('${rowid}')" >  <span class="align-middle">Borrar</span>   </button>
            <button type="button" class="btn btn-info btn-sm  w-100 mb-75 " id="actualizarCard${rowid}" onClick="actualizar('${rowid}','${idArticulo}')"><span class="align-middle">Edit</span></button>
           
        </div>          
        </div>      
    </div>
</div>  `;


        $('.tableAddArticulosEntrada').append(contenido);

      }

    } else {

    }

  });
}

function cargarDataEntrada($id) {


  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=articulos&&c=ArticuloData&t=articulo&tipo=1&accion=2&a=1&datos=7&d=' + $id,
  }).done(function (data) {
    //console.log(data)
    var i = 0;
    var tope = data.length;
    //console.log(tope)
    var contenido = ""
    var art_des = "";
    var rowid = "";
    var qty = "";
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {

        $('.txtAddEntrada_codigoEntrada').val(data[i].codigoEntrada)
        $('.txtAddEntradaFechaEmision').val(data[i].fechaEmision)
        $('.txtAddEntradaFechaRecepcion').val(data[i].fechaRecepcion)
        $('.textAreaAddEntradaObservacion').val(data[i].observacion)

        if ((data[i].estatus == '0') || (data[i].estatus == '2')) {
          alert("esta eliminada o devuelta");

        }
        var j = 0;
        var tope2 = data[i].objeto.length
        //console.log(tope2)
        for (var j = 0; j < tope2; j++) {

          nombre = data[i].objeto[j].nombre;
          cantidad = data[i].objeto[j].cantidad;
          precio = data[i].objeto[j].precio;


          contenido = `<div class="row">
            <div class="col-12 d-flex product-details-border position-relative pe-0">
                <div class="row w-100 pe-lg-0 pe-1 py-2">
                    <div class="col-lg-6 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                        <p class="card-text mb-0">${nombre}</p>
                     
                    </div>
                    <div class="col-lg-2 col-12 my-lg-0 my-2">
                    <p class="card-text mb-0">${cantidad}</p>
                    </div>
                    <div class="col-lg-2 col-12 my-lg-0 my-2">              
                    <p class="card-text mb-0">${precio}</p> 
                    </div>
                   
                </div>      
            </div>
        </div>  `;


          $('.tableArticulosEntrada').append(contenido);
        }


      }

    } else {

    }
   
  });
}

function cargarDataSalida($id) {


  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=articulos&&c=ArticuloData&t=articulo&tipo=1&accion=2&a=1&datos=8&d=' + $id,
  }).done(function (data) {
    //console.log(data)
    var i = 0;
    var tope = data.length;
    //console.log(tope)
    var contenido = ""
    var art_des = "";
    var rowid = "";
    var qty = "";
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {


        if ((data[i].estatus == '0') || (data[i].estatus == '2')) {

          $('.btnAddDevolucion').attr("style", "display:none");
        }

        $('.txtAddEntrada_codigoEntrada').val(data[i].codigoSalida)
        $('.txtAddEntradaFechaEmision').val(data[i].fechaEmision)
        $('.textAreaAddEntradaObservacion').val(data[i].observacion)


        $('.cmbAddSalida_idRedi').append('<option selected value = ' + data[i].redi + '>' + data[i].redi + '</option>');
        $('.cmbAddSalida_idZodi').append('<option selected value = ' + data[i].zodi + '>' + data[i].zodi + '</option>');
        $('.cmbAddSalida_idBrigada').append('<option selected value = ' + data[i].brigada + '>' + data[i].brigada + '</option>');
        $('.cmbAddSalida_idUnidad').append('<option selected value = ' + data[i].unidad + '>' + data[i].unidad + '</option>');
        $('.cmbAddSalida_idDependencia').append('<option selected value = ' + data[i].dependencia + '>' + data[i].dependencia + '</option>');






        var j = 0;
        var tope2 = data[i].objeto.length
        // console.log(tope2)
        for (var j = 0; j < tope2; j++) {

          nombre = data[i].objeto[j].nombre;
          cantidad = data[i].objeto[j].cantidad;
          precio = data[i].objeto[j].precio;


          contenido = `<div class="row">
            <div class="col-12 d-flex product-details-border position-relative pe-0">
                <div class="row w-100 pe-lg-0 pe-1 py-2">
                    <div class="col-lg-6 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                        <p class="card-text mb-0">${nombre}</p>
                     
                    </div>
                    <div class="col-lg-6 col-12 my-lg-0 my-2">
                    <p class="card-text mb-0">${cantidad}</p>
                    </div>
                   
                   
                </div>      
            </div>
        </div>  `;


          $('.tableArticulosEntrada').append(contenido);
        }


      }

    } else {

    }
   
  });
}

function cargarDataCarritoSalida() {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=articulos&&clase=CarritoData&t=carrtito&tipo=1&accion=7&datos=1',
  }).done(function (data) {
    //console.log(data)
    var i = 0;
    var tope = data.length;
    //console.log(tope)
    var contenido = ""
    var art_des = "";
    var rowid = "";
    var qty = "";

    //console.log(tope);
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {
        nombre = data[i].nombre;
        rowid = data[i].rowid;
        cantidad = data[i].cantidad;
        idArticulo = data[i].idArticulo;


        contenido = `<div class="row">
    <div class="col-12 d-flex product-details-border position-relative pe-0">
        <div class="row w-100 pe-lg-0 pe-1 py-2">
            <div class="col-lg-6 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                <p class="card-text mb-0">${nombre}</p>
                <input type="hidden" id="${rowid}" value ="${rowid}">
            </div>
            <div class="col-lg-3 col-12 my-lg-0 my-2">
                <input type="number" class="form-control ${idArticulo} ${rowid}"  id="${idArticulo}" name="${idArticulo}"  value="${cantidad}" placeholder="1"/>
            </div>
          
            <div class="col-lg-3 col-12 my-lg-0 my-2">
              
            <button type="button" class="btn btn-danger btn-sm  w-100 mb-75 "id="removeCard${rowid}" onClick="removerSalida('${rowid}')" >  <span class="align-middle">Borrar</span>   </button>
            <button type="button" class="btn btn-info btn-sm  w-100 mb-75 " id="actualizarCard${rowid}" onClick="actualizarSalida('${rowid}','${idArticulo}')"><span class="align-middle">Edit</span></button>
           
        </div>


          
        </div>
      
    </div>
</div>  `;


        $('.tableAddArticulosSalida').append(contenido);

      }

    } else {

    }

  });
}
function remover($rowId,) {
  removerAddEntrada($rowId);

  $('.' + $rowId + '').remove();
  toastr['error']('', 'Articulo Removido 🗑️', {
    closeButton: true,
    tapToDismiss: false
  });
  $('.tableAddArticulosEntrada').empty();
  cargarDataCarrito();


}
function removerSalida($rowId,) {
  removerAddEntrada($rowId);

  $('.' + $rowId + '').remove();
  toastr['error']('', 'Articulo Removido 🗑️', {
    closeButton: true,
    tapToDismiss: false
  });
  $('.tableAddArticulosSalida').empty();
  cargarDataCarritoSalida();


}
function anularAddEntrada() {
  var tipo = 1;
  var accion = 9;
  var datos = 1;
  $.ajax({
    url: '../admin/index.php?action=articulos',
    type: 'POST',
    data: { tipo: tipo, accion: accion, datos: datos },
    success: function (response) {
      if (response == '1') {
        Swal.fire({
          icon: 'success',
          title: 'Bien..',
          text: 'Se ha anulado la Entrada por completo!'

        });
        $('.tableAddArticulosEntrada').empty();
        cargarDataCarrito();


      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'No hemos podido eliminar la Entrada , verifique e intente nuevamente!'

        })
      }

    }
  });
}

function anularAddSalida() {
  var tipo = 1;
  var accion = 9;
  var datos = 1;
  $.ajax({
    url: '../admin/index.php?action=articulos',
    type: 'POST',
    data: { tipo: tipo, accion: accion, datos: datos },
    success: function (response) {
      if (response == '1') {
        Swal.fire({
          icon: 'success',
          title: 'Bien..',
          text: 'Se ha anulado la Entrada por completo!'

        });
        $('.tableAddArticulosSalida').empty();
        cargarDataCarritoSalida();


      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'No hemos podido eliminar la Entrada , verifique e intente nuevamente!'

        })
      }

    }
  });
}

function removerAddEntrada($rowId) {

  var tipo = 1;
  var accion = 8;
  var datos = 1;
  $.ajax({
    url: '../admin/index.php?action=articulos',
    type: 'POST',
    data: { id: $rowId, tipo: tipo, accion: accion, datos: datos },
    success: function (response) {
    }
  });
}

function actualizar($rowId, $idArticulo) {
  $cantidad = $('.' + $idArticulo + '').val();
  $precio = $('.' + $idArticulo + 'precio' + '').val();
  //console.log($precio);
  actualizarAddEntradaCantidad($rowId, $cantidad, $idArticulo, $precio);

}
function actualizarSalida($rowId, $idArticulo) {
  $cantidad = $('.' + $idArticulo + '').val();
  $precio = 1;
  //console.log($precio);
  actualizarAddSalidaCantidad($rowId, $cantidad, $idArticulo, $precio);

}
function actualizarAddEntradaCantidad($rowId, $cantidad, $idArticulo, $precio) {



  var tipo = 1;
  var accion = 10;
  var datos = 1;
  $.ajax({
    url: '../admin/index.php?action=articulos',
    type: 'POST',
    data: { idArticulo: $idArticulo, rowId: $rowId, cantidad: $cantidad, precio: $precio, tipo: tipo, accion: accion, datos: datos },
    success: function (response) {

      if (response == 1) {
        toastr['warning']('', 'Cantidad atualizada 🛒', {
          closeButton: true,
          positionClass: 'toast-top-right',
          tapToDismiss: false
        });
        $('.tableAddArticulosEntrada').empty();
        cargarDataCarrito();

      }

    }
  });

}
function actualizarAddSalidaCantidad($rowId, $cantidad, $idArticulo, $precio) {



  var tipo = 1;
  var accion = 11
  var datos = 1;
  $.ajax({
    url: '../admin/index.php?action=articulos',
    type: 'POST',
    data: { idArticulo: $idArticulo, rowId: $rowId, cantidad: $cantidad, precio: $precio, tipo: tipo, accion: accion, datos: datos },
    success: function (response) {

      if (response == 1) {

        toastr['warning']('', 'Cantidad atualizada 🛒', {
          closeButton: true,
          positionClass: 'toast-top-right',
          tapToDismiss: false
        });
        $('.tableAddArticulosSalida').empty();
        cargarDataCarritoSalida();

      } else {

        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'La cantidad a pedir no existe dentro de nuestro inventario!'

        })

        $('.' + $rowId + '').val(response);
      }

    }
  });

}


function cargarUltimaOrden() {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=items&c=ItemData&t=ordenes&tipo=1&accion=2&a=1&datos=9',
  }).done(function (data) {
//console.log(data);
    var i = 0;
    var tope = data.length;
    var ultimaOrden = 99;    
    for (var i = 0; i < tope; i++) {      
        ultimaOrden=data[i].ultimaOrden
        $('.txtAddOrden_codigoSalida').val(ultimaOrden)       
    }
    
  });
}

function cargarUltimaSalida() {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=articulos&c=ArticuloData&t=salida&tipo=1&accion=2&a=1&datos=10',
  }).done(function (data) {
//console.log(data);
    var i = 0;
    var tope = data.length;
    var ultimaOrden = 99;    
    for (var i = 0; i < tope; i++) {      
      ultimaSalida=data[i].ultimaOrdenSalida
        $('.txtAddEntrada_codigoEntrada').val(ultimaSalida)       
    }
    
  });
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function cargarDataPersona($id) {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=personal&tipo=1&accion=2&datos=3&c=PersonalData&a=1&t=personal&d=' + $id,
  }).done(function (personal) {
    // console.log(vehiculo);
    var i = 0;
    var tope = personal.length;
    if (tope == 1) {


      for (var i = 0; i < tope; i++) {
        var cedula = personal[i].cedula,
          nombreCompleto = personal[i].nombreCompleto,
          fechaNacimiento = personal[i].fechaNacimiento,
          telefono = personal[i].telefono,
          correo = personal[i].correo,
          estado = personal[i].estado,
          municipio = personal[i].municipio,
          parroquia = personal[i].parroquia,
          direccion = personal[i].direccion;  


        $('.dataPersona_cedula').html(cedula);
        $('.dataPersona_nombreCompleto').html(nombreCompleto);
        $('.dataPersona_fechaNacimiento').html(fechaNacimiento);
        $('.dataPersona_telefono').html(telefono);
        $('.dataPersona_correo').html(correo);
        $('.dataPersona_estado').html(estado);

        $('.dataPersona_municipio').html(municipio);
        $('.dataPersona_parroquia').html(parroquia);
        $('.dataPersona_direccion').html(direccion);
    

      }
    }



  });

}

function cargarDataCliente($id) {
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=clientes&tipo=1&accion=2&datos=3&c=ClienteData&a=1&t=cliente&d=' + $id,
  }).done(function (personal) {
    // console.log(vehiculo);
    var i = 0;
    var tope = personal.length;
    if (tope == 1) {


      for (var i = 0; i < tope; i++) {
        var cedula = personal[i].cedula,
          nombreCompleto = personal[i].nombreCompleto,
          fechaNacimiento = personal[i].fechaNacimiento,
          telefono = personal[i].telefono,
          correo = personal[i].correo,
          estado = personal[i].estado,
          municipio = personal[i].municipio,
          parroquia = personal[i].parroquia,
          direccion = personal[i].direccion;  


        $('.dataPersona_cedula').html(cedula);
        $('.dataPersona_nombreCompleto').html(nombreCompleto);
        $('.dataPersona_fechaNacimiento').html(fechaNacimiento);
        $('.dataPersona_telefono').html(telefono);
        $('.dataPersona_correo').html(correo);
        $('.dataPersona_estado').html(estado);

        $('.dataPersona_municipio').html(municipio);
        $('.dataPersona_parroquia').html(parroquia);
        $('.dataPersona_direccion').html(direccion);
    

      }
    }



  });

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function salir() {
  $.ajax({
    url: '../admin/index.php?action=desloguear',
    type: 'post',
    data: {},
    success: function (response) {
      //alert(response);
      if (response == 1) {
        window.location = "../"
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hubo un error al desloguear!'
        })
      }

    }
  });
}
function respaldarBase() {
  $.ajax({
    url: '../admin/index.php?action=base',
    type: 'post',
    data: {},
    success: function (response) {
      // alert(response);
      if (response == 1) {
        Swal.fire({
          icon: 'success',
          title: 'Bien...',
          text: 'Se ha respaldado la base de datos exitosamente en la siguiente ubicacion: admin/storage/'
        })
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hubo un error al desloguear!'
        })
      }

    }
  });
}
function borrarUser(id) {
  var tipo = 1;
  var accion = 3;
  var datos = 1;
  $.ajax({
    url: '../admin/index.php?action=user',
    type: 'post',
    data: { tipo: tipo, accion: accion, datos: datos, id: id },
    success: function (response) {
      //alert(response);
      if (response == 1) {
        Swal.fire({
          icon: 'success',
          text: 'Usuario desactivado con éxito.'
        })
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hubo un error al desactivar.'
        })
      }

    }
  });
}
/////////////////////// FUNCIONES PARA CARGAR LOS COMBOS //////////////////////////

function cargarEstados($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=estados&tipo=1&accion=2&datos=1&c=EstadoData&a=1&t=estados',
  }).done(function (redis) {
    var i = 0;
    var tope = redis.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + redis[i].id_estado + '>' + redis[i].estado + '</option>');

    }

  });
}

function cargarMunicipios($combo, filtro) {
  var id = filtro;
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=municipios&tipo=1&accion=2&datos=3&c=MunicipioData&a=1&t=municipios&d=' + id + '&cp=m.id_estado',
  }).done(function (municipios) {

    $($combo).html('<option value = "0">Seleccione</option>');
    //console.log(categorias);
    var i = 0;
    var tope = municipios.length;
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {
        $($combo).append('<option value = ' + municipios[i].id_municipio + '>' + municipios[i].municipio + '</option>');
      }
    } else {
      $($combo).html('<option value = "0">No existen Municipios asociados a ese Estado</option>');
    }
    //alert(tope);
  });
}
function cargarParroquias($combo, filtro) {
  var id = filtro;
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=parroquias&tipo=1&accion=2&datos=3&c=ParroquiaData&a=1&t=parroquias&d=' + id + '&cp=p.id_municipio',
  }).done(function (parroquias) {

    $($combo).html('<option value = "0">Seleccione</option>');
    //console.log(categorias);
    var i = 0;
    var tope = parroquias.length;
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {
        $($combo).append('<option value = ' + parroquias[i].id_parroquia + '>' + parroquias[i].parroquia + '</option>');
      }
    } else {
      $($combo).html('<option value = "0">No existen Parroquias asociados a ese Municipio</option>');
    }
    //alert(tope);
  });
}

function cargarComponentes($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=componentes&tipo=1&accion=2&datos=1&c=ComponenteData&a=1&t=componente',
  }).done(function (componentes) {
    var i = 0;
    var tope = componentes.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + componentes[i].id + '>' + componentes[i].componente + '</option>');

    }

  });
}
function cargarGrados($combo, filtro) {
  var id = filtro;
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=grados&tipo=1&accion=2&datos=3&c=GradoData&a=1&t=grado&d=' + id + '&cp=idComponente',
  }).done(function (grados) {

    $($combo).html('<option value = "0">Seleccione</option>');
    //console.log(categorias);
    var i = 0;
    var tope = grados.length;
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {


        $($combo).append('<option value = ' + grados[i].id + '>' + grados[i].grado + '</option>');

      }
    } else {
      $($combo).html('<option value = "0">No existen Grados asociados a ese Componente</option>');
    }
    //alert(tope);
  });
}
function cargarCargos($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=cargos&tipo=1&accion=2&datos=1&c=CargoData&a=1&t=cargo',
  }).done(function (cargos) {
    $($combo).html('<option value = "0">Seleccione</option>');
    var i = 0;
    var tope = cargos.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + cargos[i].id + '>' + cargos[i].cargo + '</option>');

    }

  });
}

function cargarClientes($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=clientes&tipo=1&accion=2&datos=1&c=ClienteData&a=1&t=cliente',
  }).done(function (data) {
    $($combo).html('<option value = "0">Seleccione</option>');
    var i = 0;
    var tope = data.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + data[i].id + '>' + data[i].nombreCompleto + '</option>');

    }

  });
}

function cargarTipos($combo, filtro) {
  var id = filtro;
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=tipos&tipo=1&accion=2&datos=3&c=TipoData&a=1&t=tipo&d=' + id + '&cp=condicion',
  }).done(function (tipos) {

    $($combo).html('<option value = "0">Seleccione</option>');
    //console.log(categorias);
    var i = 0;
    var tope = tipos.length;
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {


        $($combo).append('<option value = ' + tipos[i].id + '>' + tipos[i].tipo + '</option>');

      }
       $($combo).append('<option value = "999">Agregar Tipos</option>');
    } else {
      $($combo).html('<option value = "999">Agregar Tipos</option>');
    }
    //alert(tope);
  });
}


function cargarMarcas($combo, filtro) {
  var id = filtro;
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=marcas&tipo=1&accion=2&datos=3&c=MarcaData&a=1&t=marca&d=' + id + '&cp=idTipo',
  }).done(function (marcas) {

    $($combo).html('<option value = "0">Seleccione</option>');
    //console.log(categorias);
    var i = 0;
    var tope = marcas.length;
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {


        $($combo).append('<option value = ' + marcas[i].id + '>' + marcas[i].marca + '</option>');

      }
         $($combo).append('<option value = "999">Agregar Marcas</option>');
    } else {
      $($combo).append('<option value = "999">Agregar Marcas</option>');
    }
    //alert(tope);
  });
}
function cargarModelos($combo, filtro) {
  var id = filtro;
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=modelos&tipo=1&accion=2&datos=3&c=ModeloData&a=1&t=modelo&d=' + id + '&cp=m.idMarca',
  }).done(function (modelos) {

    $($combo).html('<option value = "0">Seleccione</option>');
    //console.log(categorias);
    var i = 0;
    var tope = modelos.length;
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {


        $($combo).append('<option value = ' + modelos[i].id + '>' + modelos[i].modelo + '</option>');

      }
        $($combo).append('<option value = "999">Agregar Modelos</option>');
    } else {
      $($combo).append('<option value = "999">Agregar Modelos</option>');
    }
    //alert(tope);
  });
}



function cargarPersonal($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=personal&tipo=1&accion=2&datos=1&c=PersonalData&a=1&t=personal',
  }).done(function (personal) {
    $($combo).html('<option value = "0">Seleccione</option>');
    var i = 0;
    var tope = personal.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + personal[i].id + '>' + personal[i].cedula + '-' + personal[i].nombreCompleto + '</option>');

    }

  });
}
function cargarPersonalCargo($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=personal&tipo=1&accion=2&datos=4&c=PersonalData&a=1&t=personal',
  }).done(function (personal) {
    $($combo).html('<option value = "0">Seleccione</option>');
    var i = 0;
    var tope = personal.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + personal[i].id + '>' + personal[i].cedula + '-' + personal[i].nombreCompleto + '</option>');

    }

  });
}


function cargarUbicaciones($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=ubicaciones&tipo=1&accion=2&datos=1&c=UbicacionData&a=1&t=ubicacion',
  }).done(function (data) {
    $($combo).html('<option value = "0">Seleccione</option>');
    var i = 0;
    var tope = data.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + data[i].id + '>' + data[i].ubicacion +'</option>');

    }

  });
}

function cargarArticulos($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=articulos&tipo=1&accion=2&datos=1&c=ArticuloData&a=1&t=articulo',
  }).done(function (articulos) {
    $($combo).html('<option value = "0">Seleccione</option>');
    var i = 0;
    var tope = articulos.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + articulos[i].id + '>' + articulos[i].tipo + '-' + articulos[i].unidadMedida + '-' + articulos[i].nombre + '</option>');

    }

  });
}

function cargarVehiculos($combo, $filtro) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=vehiculos&tipo=1&accion=2&datos=8&c=ItemData&a=1&t=vehiculo',
  }).done(function (vehiculos) {
    console.log(vehiculos);
    $($combo).html('<option value = "0">Seleccione</option>');
    var i = 0;
    var tope = vehiculos.length;
    for (var i = 0; i < tope; i++) {
      $($combo).append('<option value = ' + vehiculos[i].id + '>' + vehiculos[i].placa + '-' + vehiculos[i].marca + '-' + vehiculos[i].modelo + '</option>');

    }

  });
}

function cargarEquipos($combo, filtro) {
  var id = filtro;
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=items&tipo=1&accion=2&datos=33&c=ItemData&a=1&t=item&d=' + id + '&cp=t.idCliente',
  }).done(function (data) {

    $($combo).html('<option value = "0">Seleccione</option>');
    //console.log(categorias);
    var i = 0;
    var tope = data.length;
    if (tope >= 1) {
      for (var i = 0; i < tope; i++) {
        $($combo).append('<option value = ' + data[i].id + '>' + data[i].codigo +'-'+ data[i].tipo  +'-'+data[i].marca +'-'+data[i].modelo+'</option>');
      }
    } else {
      $($combo).html('<option value = "0">No existen equipos asociados a ese cliente</option>');
    }
    //alert(tope);
  });
}


function cargarEstadisticas($label,$data) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action='+$data+'&tipo=1&accion=2&datos=99'
  }).done(function (estadisticas) { 
      $($label).html(estadisticas[0].numeros);

  });
}

function cargarEstadisticasOrdenes($label,$data,$sta) {
  //console.log($combo);
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action='+$data+'&tipo=1&accion=2&datos=98&d='+$sta
  }).done(function (estadisticas) { 
      $($label).html(estadisticas[0].numeros);

  });
}


function cargarDataEmpresa(){
  
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=combos&a=1&c=EmpresaData&t=empresa', 
}).done(function(empresa) {  
  var i = 0;
  var tope =empresa.length;
  var src='';
  if(tope>=1){   
    for (var i = 0; i < tope; i++) { 
    $('#name').val(empresa[i].name);
    $('#name_label').html(empresa[i].name);
    $('#email').val(empresa[i].email);
    $('#email_ventas').val(empresa[i].email_ventas);
    $('#email_cobros').val(empresa[i].email_cobros);
    $('#telefonos').val(empresa[i].telefonos);
    $('#rif').val(empresa[i].rif);
    $('#direccion').html(empresa[i].dir);
    src= " ../admin/storage/logo/"+empresa[i].image;
    //console.log(src);
    $('.image_edit').attr("src",src); 
    
    }  
  }else{
  }
  //alert(tope);
});
}

function cargarDatosCliente($elegido) {
 
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=clientes&tipo=1&accion=2&datos=3&c=ClienteData&a=1&t=cliente&d='+$elegido,
  }).done(function (data) {
    var i = 0;
    var j=0;
    var tope = data.length;
    let tope2 =0;
    for (var i = 0; i < tope; i++) {
      $('.next1').val('1');
     
      //console.log(data);
      $('.nombre').val();
      $('.telefono').val();
      $('.correo').val();
     // $('.tableAddArticulosEntrada').empty();

     $('.nombre').val(data[i].nombreCompleto);
     $('.telefono').val(data[i].telefono);
     $('.correo').val(data[i].correo);


    let articulos = data[i].articulos;
     tope2 =  data[i].articulos.length;
    // console.log(data);
      $('.cmbAddIngreso_idVehiculo').empty();
      $('.cmbAddIngreso_idVehiculo').append('<option value = "0">Seleccione</option>');
     if(tope2 >= 1){
      
        for (var j = 0; j < tope2; j++) {
        $('.cmbAddIngreso_idVehiculo').append('<option value = ' + articulos[j].id + '>' + articulos[j].codigo + '</option>');
  
      }
  
     }else{
           $('.cmbAddIngreso_idVehiculo').empty();
           $('.cmbAddIngreso_idVehiculo').append('<option value = "0">Seleccione</option>');
     }


    }

  });
}


function cargarDatosItem($elegido) {
 
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=items&tipo=1&accion=2&datos=3&c=ItemData&a=1&t=item&d='+$elegido,
  }).done(function (data) {
    var i = 0;
    var j=0;
    var tope = data.length;
    let tope2 =0;
    for (var i = 0; i < tope; i++) {

      $('.serialChasis').val();
      $('.tipo').val();
      $('.marca').val();
      $('.modelo').val();
      $('.ano').val();
      $('.color').val();
     
      $('.btn-next').prop('disabled', false);

      $('.serialChasis').val(data[i].serialChasis);
      $('.tipo').val(data[i].tipo);
      $('.marca').val(data[i].marca);
      $('.modelo').val(data[i].modelo);
      $('.ano').val(data[i].ano);
      $('.color').val(data[i].color);

     // let src= " ../admin/storage/logo/items/"+;
    //console.log(src);
    $('.media').attr("src",data[i].media); 


   




    }

  });
}

function enviarCorreo(media,correo){
  var tipo = 1;
  var accion = 1;
  var datos =1;
  $.ajax({
    url: '../admin/index.php?action=enviar', 
    type:'post',
    data:{tipo:tipo,accion:accion,datos:datos,correo:correo,media:media},
    success:function(response){

      
        if(response == 1){  

          Swal.fire({
            icon: 'success',           
            text: 'Prueba de correo exitosa.'            
          })
          //window.location = "index.php?view=polizas"           

        }else{
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hubo un error al enviar.'            
          })
        }
       
    }
});
}

function cargarDataCorreo(){
  
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=combos&a=199&c=EmpresaData&t=empresa', 
  }).done(function(correo) {  
  var i = 0;
  var tope =correo.length;
  var src='';
  if(tope>=1){   	

    for (var i = 0; i < tope; i++) { 
    $('#text').html(correo[i].text);
    $('#smtp').val(correo[i].smtp);
    $('#password').val(correo[i].password);
    $('#host').val(correo[i].host);
    $('#port').val(correo[i].port);
    
    }  
  }else{
  }
  //alert(tope);
});
}


function cargarDataOrdenTrabajo($filtro) {
 
  $.ajax({
    type: "GET",
    url: '../admin/index.php?action=items&tipo=1&accion=2&datos=333&c=ItemData&a=1&t=item&d='+$filtro,
  }).done(function (data) {
   // console.log(data);
    var i = 0;
    var j=0;
    var tope = data.length;
    let tope2 =0;
    let condicion=0;
    let contenido=``;
    for (var i = 0; i < tope; i++) {

      let idpersonal = 0;
      let idUbicacion = 0;


      $('#lblCodigoOrden').html(data[i].codigo);
      $('#codigoOrden').val(data[i].codigo);
      $('#lblFechaIngreso').html(data[i].fechaIngreso);
      $('#lblFechaSalida').html(data[i].fechaSalida);
      $('#lblNameCliente').html(data[i].dato1);
      $('#lblCedulaCliente').html(data[i].dato2);
      $('#lblTelefonoCliente').html(data[i].dato3);
      $('#lblCorreoCliente').html(data[i].dato4);


       condicion = data[i].condicion;


      $('#lblCodigoItem').html(data[i].placa);
      $('#lblTipoItem').html(data[i].tipo);
      $('#lblMarcaItem').html(data[i].marca);
      $('#lblModeloItem').html(data[i].modelo);
      $('#lblDescripcionOrden').html(data[i].descripcion);

    idPersonal = data[i].idPersonal;
    idUbicacion = data[i].idUbicacion;

    if((idPersonal==0) || (idUbicacion==0) ){

      $('#noexiste').prop('hidden', false); 
      $('#existe').prop('hidden', true);
     



    }else{
    $('#noexiste').prop('hidden', true); 
      $('#existe').prop('hidden', false);
   
      $('#lblPersonalOrden').html(data[i].dato5);
      $('#lblUbicacionOrden').html(data[i].dato6);

    }

    if(condicion==2){
  $('#cerrarOrden').prop('hidden', true); 
  $('#estatusOrden').prop('hidden', false); 
    }

   

    let detalles = data[i].detalles;
     tope2 =  data[i].detalles.length;

      for (var i = 0; i < tope2; i++) {

              contenido=`<tr>
              <td class="py-1">
                <p class="card-text fw-bold mb-25">${detalles[i].nombre}</p>
             
               </td>
               <td class="py-1">
               <span class="fw-bold">${detalles[i].serial}</span>
                </td>
               </tr>`;   
                                            
   
  //console.log(contenido);
    $('#detallesOrden').append(contenido);   
      }


    }

  });
}


function eliminarOrdenTrabajo(id,codigo) {
  var tipo = 1;
  var accion = 4;
  var datos = 1;
  $.ajax({
    url: '../admin/index.php?action=items',
    type: 'post',
    data: { tipo: tipo, accion: accion, datos: datos, id: id,codigo:codigo },
    success: function (response) {
      //alert(response);
      if (response == 1) {
        Swal.fire({
          icon: 'success',
          text: 'Se ha eliminado correctamente la orden de trabajo.'
        }),
        window.location = 'index.php?view=ordenesTrabajo&filtro=0';
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hubo un error al eliminar.'
        })
      }

    }
  });
}
