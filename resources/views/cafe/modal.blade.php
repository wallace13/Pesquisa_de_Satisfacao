<!-- Modal -->
<form id="form_{{$c->id}}" method="post" action="{{ route('cafe.destroy', ['cafe' => $c->id]) }}">
    @method('DELETE')
    @csrf
    <div class="modal fade" id="deleteModal-{{ $c->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Confirmação</h5>
            </div>
            <div class="modal-body text-center">
                <h5>Excluir cardápio do dia {{ date('d/m/Y', strtotime($c->data))}}?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger" onclick="document.getElementById('form_{{$c->id}}').submit()">Deletar</a>
            </div>
        </div>
        </div>
    </div>
</form>