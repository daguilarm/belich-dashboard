{{-- Pagination --}}
@if($pagination = $request->results->links())
    <tfoot>
        <tr>
            <td colspan="{{ $request->total }}" class="text-center">{{ $pagination }}</td>
        </tr>
    </tfoot>
@endif
