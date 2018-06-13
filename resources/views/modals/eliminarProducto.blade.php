<!-- The Modal -->
  <div class="modal fade" id="eliminarProductoModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dark">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center">Confirmacion</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <h6>¿Esta seguro de querer eliminar el producto: {{$lista->PROD_NOMBRE}}?</h6>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer" >
          <form action="{{route('borrarPoducto', $lista->PROD_COD)}}" method="post"   >

            @csrf
            <button type="submit" class="btn btn-success" >SI</button>
          </form>
            <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
        </div>

      </div>
    </div>
  </div>
