<!DOCTYPE html>
<html>
<head>
    <title>LEMBAR KONTROL RETRY MESIN</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <br>
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>

    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('YYYY-MM-DD');
            var table = $('#products-table').DataTable({
                "order": [[0, "desc"]], // Order by the first column (No.) descending
                "paging": true,
                "searching": true,
                "columnDefs": [
                    { "targets": "_all", "orderable": true },
                ],
                "fnDrawCallback": function (oSettings) {
                    // Update the first column (No.) to start from 1 instead of 0
                    this.api().column(0).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            });

            $('#date-range-picker').daterangepicker();

            $('#date-range-picker').on('apply.daterangepicker', function(ev, picker) {
                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');

                table.columns(1).search(startDate + '|' + endDate, true, false).draw();
            });

            $('#export-filtered').on('click', function() {
                var filteredData = table.rows({ search: 'applied' }).data().toArray();
                var headers = table.columns().header().toArray().map(function(th) {
                    return $(th).text();
                });

                var actionsIndex = headers.indexOf("Actions");
                if (actionsIndex !== -1) {
                    // Remove the "Actions" column from the headers and the filtered data
                    headers.splice(actionsIndex, 1);
                    filteredData = filteredData.map(function(row) {
                        return row.filter(function(_, index) {
                            return index !== actionsIndex;
                        });
                    });
                }
                
                var exportData = [headers].concat(filteredData);

                var ws = XLSX.utils.aoa_to_sheet(exportData);

                // Auto-size all columns in the worksheet
                for (var i = 0; i < headers.length; i++) {
                    ws['!autofit'+String.fromCharCode(65+i)] = true; // 'A', 'B', 'C', ...
                }

                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "wow");

                var currentDate = new Date().toISOString().slice(0, 10);
                var filename = "LEMBAR KONTROL RETRY MESIN " + currentDate + ".xlsx";

                XLSX.writeFile(wb, filename);
            });
        });

        function confirmAction(action) {
            return confirm(`Apakah anda yakin ingin ${action} data?`);
        }
    </script>
</body>
</html>
