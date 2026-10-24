@extends('layouts.apps')
@section('content')
<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6">
  <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"><div><h1 class="text-2xl font-bold text-gray-800 dark:text-white">Archived Maintenance Requests</h1><p class="text-sm text-gray-500">Only completed or rejected requests can be archived. Restoring preserves the request's status and history.</p></div><a href="{{ auth()->user()->role->name === 'superadmin' ? route('superadminDashboard') : route('maintenanceRequest.admin') }}" class="rounded-lg border px-4 py-2 text-sm font-semibold">Back to requests</a></div>
  @if(session('success'))<div class="mb-4 rounded-lg bg-green-50 p-3 text-green-800">{{ session('success') }}</div>@endif
  <form method="GET" class="mb-4 flex flex-col gap-2 sm:flex-row"><input name="search" value="{{ request('search') }}" placeholder="Search ticket, title, or location" class="min-w-0 flex-1 rounded-lg border px-3 py-2"><button class="rounded-lg bg-gray-800 px-4 py-2 text-white">Search</button></form>
  <div class="overflow-x-auto rounded-xl bg-white shadow-sm dark:bg-gray-800"><table class="w-full text-left text-sm"><thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-700"><tr><th class="p-3">Ticket</th><th class="p-3">Request</th><th class="p-3">Location</th><th class="p-3">Status</th><th class="p-3">Archived</th><th class="p-3">Action</th></tr></thead><tbody class="divide-y dark:divide-gray-700">@forelse($requests as $item)<tr><td class="p-3 font-mono">{{ $item->ticket_number ?? ('#'.$item->id) }}</td><td class="p-3"><div class="font-semibold">{{ $item->title }}</div><div class="text-xs text-gray-500">{{ $item->user?->fname }} {{ $item->user?->lname }}</div></td><td class="p-3">{{ $item->location }}</td><td class="p-3">{{ ucfirst(str_replace('_',' ',$item->status)) }}</td><td class="p-3">{{ $item->deleted_at?->format('M d, Y') }}</td><td class="p-3"><button type="button" data-restore-request-action="{{ auth()->user()->role->name === 'superadmin' ? route('superadmin.archives.requests.restore', $item->id) : route('admin.archives.requests.restore', $item->id) }}" data-restore-request-name="{{ $item->ticket_number ?? ('#'.$item->id) }} — {{ $item->title }}" class="rounded-lg bg-green-700 px-3 py-2 text-xs font-semibold text-white hover:bg-green-800">Restore</button></td></tr>@empty<tr><td colspan="6" class="p-8 text-center text-gray-500">No archived requests found.</td></tr>@endforelse</tbody></table></div><div class="mt-4">{{ $requests->links() }}</div>
</div>

<dialog id="restoreRequestDialog" class="w-[min(92vw,28rem)] rounded-2xl p-0 shadow-2xl backdrop:bg-slate-950/50">
  <div class="p-6">
    <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-full bg-green-100 text-green-700"><svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12a9 9 0 1 0 3-6.7M3 4v5h5M12 7v5l3 2"/></svg></div>
    <h2 class="text-lg font-bold text-gray-900">Restore maintenance request?</h2>
    <p id="restoreRequestMessage" class="mt-2 text-sm text-gray-600">The request will return to active records with its existing status and history.</p>
    <form id="restoreRequestForm" method="POST" class="mt-6 flex justify-end gap-3">@csrf
      <button type="button" id="cancelRestoreRequest" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700">Cancel</button>
      <button type="submit" class="rounded-lg bg-green-700 px-4 py-2 text-sm font-semibold text-white hover:bg-green-800">Restore request</button>
    </form>
  </div>
</dialog>
<script>
(() => {
  const dialog = document.getElementById('restoreRequestDialog');
  const form = document.getElementById('restoreRequestForm');
  const message = document.getElementById('restoreRequestMessage');
  document.querySelectorAll('[data-restore-request-action]').forEach(button => button.addEventListener('click', () => {
    form.action = button.dataset.restoreRequestAction;
    message.textContent = `Restore ${button.dataset.restoreRequestName}? It will return to active records with its existing status and history.`;
    dialog.showModal();
  }));
  document.getElementById('cancelRestoreRequest').addEventListener('click', () => dialog.close());
  dialog.addEventListener('click', event => { if (event.target === dialog) dialog.close(); });
})();
</script>
@endsection
