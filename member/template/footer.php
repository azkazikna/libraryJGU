<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
<!-- Swiper Slider -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.2/dist/chart.min.js"></script>
<!-- Select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<!-- Datatables JS -->
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<!-- Custom Javascript -->
<script src="../dist/js/dashboard.js"></script>
<script>
    const ctx = document.getElementById('booksChart').getContext('2d');
    const booksChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Family', 'Comedy', 'Fantasy', 'Fan Fiction', 'Horror', 'Romance'],
            datasets: [{
                label: 'Statistics',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: '#fff',
                borderColor: '#ED2024',
                borderWidth: 4,
                pointRadius: 5,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false,
                    }
                },
                x: {
                    grid: {
                        color: '#ED2024',
                    }
                },
            },
        }
    });
</script>
<script>
  $(document).ready( function () {
        $('#table_id').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 2, 3, 4, 5, 6]
                    }
                },
                'colvis'
        ]
        })
    });
</script>
<script type="text/javascript">
 $(document).ready(function() {
     $('#code_member').select2();
 });
 
 $(document).ready(function() {
     $('#code_book').select2();
 });
</script>
</body>
</html>