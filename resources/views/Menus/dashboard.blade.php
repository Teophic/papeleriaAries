@extends('Partials/navbar')

@section('content')
<div class="container " >
    <div class=" container text-center mt-5" >

        <div class="row align-items-center ">
            <div class="col border border-3 border-black mx-3 rounded" >
                <span class="fs-3 fw-semibold font-monospace">Ventas de hoy:</span>
                <br>
                <span class="fs-3 fw-medium font-monospace">${{$todaySales}}</span>
            </div>
            <div class="col border border-3 border-black mx-3 rounded">
                <span class="fs-3 fw-semibold font-monospace">Ventas del mes:</span>
                <br>
                <span class="fs-3 fw-medium font-monospace">${{$monthlySales}}</span>
            </div>
        </div>

        <div class="row mt-5">
            <div class="container border border-black border-1 rounded" style="background-color: whitesmoke">
                <canvas id="ventasChart"></canvas>
            </div>
        </div>


    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctxYearSales = document.getElementById('ventasChart');

  new Chart(ctxYearSales, {
    type: 'line',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
        label: 'Ventas por mes ($)',
        data: @json(array_values($yearSales)),
        backgroundColor: 'rgba(54, 162, 235, 0.5)',//el punto
        borderColor: 'rgba(54, 162, 235, 1)',//la linea
        borderWidth: 2 //grosor de la linea
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>


@endsection
