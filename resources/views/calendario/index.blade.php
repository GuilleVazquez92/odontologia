
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div>
     <div id='calendar'></div>
</div>

<!-- Modal -->
<div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form action="" id="formulario">
{{ csrf_field() }}
   <div class="form-group">
    <label for="time">Titulo</label>
    <input type="text" class="form-control" id="title" name=title placeholder="">
  </div>
  <div class="form-group">
    <label for="paciente">Paciente</label>
    <input type="text" class="form-control" id="paciente" name="paciente" placeholder="">
  </div>
  <div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea class="form-control" id="descripcion"  name="descripcion" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="start">Inicio</label>
    <input type="text" class="form-control" id="start" name="start" placeholder="">
  </div>
  <div class="form-group">
    <label for="end">Fin</label>
    <input type="text" class="form-control" id="end" name="end" placeholder="">
  </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <script>

      document.addEventListener('DOMContentLoaded', function() {

        let formulario = document.querySelector('#formulario');


        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          
          locale: 'es',

          headerToolbar:{
          left: 'prev,next,today',
          center:'title',
          right: 'dayGridMonth,listWeek'

      },

      events : 'http://odontologia.local/calendario/mostrar', 

      dateClick:function(info){

        formulario.reset();
        formulario.start.value = info.dateStr;
        formulario.end.value = info.dateStr;
      	$('#evento').modal('show');
      },

      eventClick:function(info){

        var evento = info.event;
        console.log(evento.id);

        axios.post('http://odontologia.local/calendario/editar/'+info.event.id).
        then(
          (response) => 
          { 
            formulario.title.value = response.data[0].title;
            formulario.paciente.value = response.data[0].paciente;
            formulario.descripcion.value = response.data[0].descripcion;

            formulario.start.value = response.data[0].start;
            formulario.end.value = response.data[0].end;
            $('#evento').modal('show');
          }
          ).catch(
                error=>{
                  if(error.response){
                    console.log(error.response.data.message);
                  }
                }
          )
      }
        });
        calendar.render();


      document.getElementById('btnGuardar').addEventListener('click', function(){
        const datos = new FormData(formulario);
        

        axios.post('http://odontologia.local/calendario/agregar', datos).
        then(
          (response) => 
          { 
            calendar.refetchEvents();
            $('#evento').modal('hide');
          }
          ).catch(
                error=>{
                  if(error.response){
                    console.log(error.response.data.message);
                  }
                }
          )



      });
      });

    </script>
@stop

