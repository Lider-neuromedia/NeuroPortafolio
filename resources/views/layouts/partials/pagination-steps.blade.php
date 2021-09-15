<div class="btn-group bg-white ml-3">
    <button
        type="button"
        title="20 registros por página"
        class="btn btn-xs @if(session('paginate') == 20) btn-primary @else btn-outline-primary @endif"
        onclick="document.getElementById('pagination-form-20').submit();">20</button>
    <button
        type="button"
        title="50 registros por página"
        class="btn btn-xs @if(session('paginate') == 50) btn-primary @else btn-outline-primary @endif"
        onclick="document.getElementById('pagination-form-50').submit();">50</button>
    <button
        type="button"
        title="100 registros por página"
        class="btn btn-xs @if(session('paginate') == 100) btn-primary @else btn-outline-primary @endif"
        onclick="document.getElementById('pagination-form-100').submit();">100</button>
</div>

<form id="pagination-form-20" action="{{ route('config.paginate', 20) }}" method="POST" style="display: none;">@csrf</form>
<form id="pagination-form-50" action="{{ route('config.paginate', 50) }}" method="POST" style="display: none;">@csrf</form>
<form id="pagination-form-100" action="{{ route('config.paginate', 100) }}" method="POST" style="display: none;">@csrf</form>
